<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $details = [
            'title'=>'Email verifikasi',
            'body'=>'hello world',
        ];

        Mail::to('muhamadnizar@smkwikrama.sch.id')->send(new MyTestMail($details));
        dd('email terkirim');
    }
}
