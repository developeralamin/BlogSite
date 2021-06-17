<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Suscriber;

class SuscriberController extends Controller
{
    public function store(Request $request)
    {
    	 $this->validate($request,[
            'email'       => 'required|email|unique:suscribers',
        ]);

    	 $suscriber = new Suscriber();
    	 $suscriber->email=$request->email;
         $suscriber->save();

         Toastr::success('Suscriber E-mail Successfully Send :)' ,'Success');
         return redirect()->back();

    }
}
