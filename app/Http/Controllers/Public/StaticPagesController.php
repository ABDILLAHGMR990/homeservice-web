<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function about()       { return view('public.static.about'); }
    public function howItWorks()  { return view('public.static.how-it-works'); }
    public function faq()         { return view('public.static.faq'); }
    public function contact()     { return view('public.static.contact'); }
    public function terms()       { return view('public.static.terms'); }
    public function privacy()     { return view('public.static.privacy'); }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        return back()->with('success', 'Pesan Anda telah dikirim. Kami akan merespons dalam 1x24 jam.');
    }
}
