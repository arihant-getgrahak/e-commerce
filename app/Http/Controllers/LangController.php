<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use DB;
use File;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function changeLang(Request $request)
    {
        try {
            $lang = $request->lang;
            session()->put('lang', $lang);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function languageStore(AddLanguageRequest $request)
    {
        try {
            $data = [
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'code' => $request->code,
                'status' => $request->status,
                'rtl' => $request->rtl,
                'default' => $request->default,
            ];

            if ($data['default'] == 1) {
                Language::where('user_id', auth()->user()->id)->update(['default' => 0]);
            }

            $defaultLang = Language::where('user_id', auth()->user()->id)->where('default', 1)->first();

            $langCode = $data['code'];
            $langFolder = base_path('lang');

            $defaultLangFile = $langFolder.'/'.$defaultLang->code.'.json';
            $newLangFile = $langFolder.'/'.$langCode.'.json';

            if (File::exists($newLangFile)) {
                return back()->with('error', 'Language file already exists.');
            }

            File::copy($defaultLangFile, $newLangFile);

            DB::beginTransaction();
            Language::create($data);
            DB::commit();

            return back()->with('success', 'Language added successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function languageDelete($id)
    {
        try {
            $lang = Language::find($id);

            if ($lang->default) {
                return back()->with('error', 'Default language can not be deleted');
            }
            DB::beginTransaction();
            $lang->delete();
            DB::commit();

            return back()->with('success', 'Language deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function languageUpdate(UpdateLanguageRequest $request, $id)
    {
        try {
            $data = $request->only([
                'name',
                'code',
                'status',
                'rtl',
            ]);

            DB::beginTransaction();
            Language::where('id', $id)->update($data);
            DB::commit();

            return back()->with('success', 'Language updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function defaultLanguage(Request $request)
    {
        try {
            $lang = $request->lang;

            DB::beginTransaction();

            Language::where('user_id', auth()->user()->id)->update(['default' => 0]);
            Language::where('id', $lang)->update(['default' => 1]);

            DB::commit();

            return back()->with('success', 'Default Language Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getLanguageFile($id)
    {
        try {
            $lang = Language::find($id);
            $langFile = base_path('lang/'.$lang->code.'.json');
            if (! File::exists($langFile)) {
                return response()->json(['error' => 'Language file not found.'], 404);
            }

            $content = json_decode(File::get($langFile), true);

            return view('admin.setting.language-edit', compact('content', 'lang'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
