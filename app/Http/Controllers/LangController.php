<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLanguageRequest;
use App\Http\Requests\UpdateForexRequest;
use App\Models\Language;
use DB;
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

            Language::where('user_id', auth()->user()->id)->update(['default' => 0]);

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

    public function languageUpdate(UpdateForexRequest $request, $id)
    {
        try {
            $data = $request->only([
                'name',
                'code',
                'status',
                'rtl',
                'default',
            ]);
            Language::where('user_id', auth()->user()->id)->update(['default' => 0]);
            DB::beginTransaction();
            Language::where('id', $id)->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
