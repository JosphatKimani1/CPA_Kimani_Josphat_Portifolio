<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function AllServices(){

    $services = Services::latest()->get();
    return view('backend.services.all_services', compact('services'));

    }// End Method

    public function AddService(){
        return view('backend.services.add_service');

    }//End Method
}
