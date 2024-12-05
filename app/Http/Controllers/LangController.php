<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLanguageRequest;
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
            ];

            DB::beginTransaction();
            Language::create($data);
            DB::commit();

            return redirect()->back()->with('success', 'Language added successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
