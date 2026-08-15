<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function setCookie(Request $request)
    {
        return response('Cookie saved successfully')->cookie('username', 'aliahmad', 60);
    }

    public function readCookie(Request $request)
    {
        $cname = $request->cookie('username');
    }

    public function deleteCookie(Request $request)
    {
        cookie::forget('username');
    }
}

