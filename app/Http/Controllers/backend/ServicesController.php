<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    public function AllServices(){

    $services = Services::latest()->get();
    return view('backend.services.all_services', compact('services'));

    }// End Method

    public function AddService(){
        return view('backend.services.add_service');

    }//End Method

    public function StoreService(Request $request){
            $service = new Services();
            $service->service_title = Str::replace('/','-',$request->service_title);
            $service->service_description = $request->service_description;
            $service->created_at = Carbon::now();
            $service->save();

              $notification = [
            'message' => 'Service added Succussfully!',
            'alert-type' => 'success'
            ];

            return redirect()->route('all.services')->with($notification);


    } //End method

    public function EditService($id){
            $service = Services::findOrFail($id);
            return view('backend.services.edit_service', compact('service'));
    }// End Method

    public function UpdateService(Request $request){
        $service_id = $request->service_id;
        $service = Services::findOrFail($service_id);
            $service->service_title = Str::replace('/','-',$request->service_title);
            $service->service_description = $request->service_description;
            $service->updated_at = Carbon::now();
            $service->save();

              $notification = [
            'message' => 'Service Updated Succussfully!',
            'alert-type' => 'info'
            ];

            return redirect()->route('all.services')->with($notification);
    }//End Method

    public function DeleteService($id){
        Services::findOrFail($id)->delete();
          $notification = [
            'message' => 'Service Deleted Succussfully!',
            'alert-type' => 'info'
            ];

    return redirect()->back()->with($notification);
        
    }// End Method
}
