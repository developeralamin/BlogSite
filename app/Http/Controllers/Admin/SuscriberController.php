<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Suscriber;

class SuscriberController extends Controller
{
    public function index()
    {
    	$this->data['suscribebers'] = Suscriber::latest()->get();
    	return view('admin.suscribe.index',$this->data);
    }

    public function destroy ($id)
    {
    	$suscriber = Suscriber::findOrFail($id);
    	$suscriber->delete();
        Toastr::success('Suscriber Successfully Deleted :)','Success');
        return redirect()->back();

    }
}
