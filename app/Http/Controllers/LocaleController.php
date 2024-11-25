<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function setLocale(string $lang)
    {
        if(in_array($lang, ['en', 'idn'])) {
            App::setLocale($lang);
            session()->put('locale', $lang);
        }

        return redirect()->back();
    }
}
