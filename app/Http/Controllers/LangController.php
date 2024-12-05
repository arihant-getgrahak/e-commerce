<?php

namespace App\Http\Controllers;

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
}
