<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function MyExperience(){
        $experiences = Resume::where('resume_cat', 'experience')->get();
        return view('backend.resume.my_experience', compact('experiences'));
    } // End Method

    public function StoreExperince(Request $request){
        Resume::create([
            'resume_cat' => $request->resume_cat,
            'resume_title' => $request->resume_title,
            'institution' => $request->institution,
            'from_year' => $request->from_year,
            'to_year' => $request->to_year,

        ]);

        if($request->resume_cat == 'experience'){
            $notification = [
            'message' => 'Experince Added Succussfully!',
            'alert-type' => 'success'
            ];
        } else {
             $notification = [
            'message' => 'Education Added Succussfully!',
            'alert-type' => 'success'
            ];
        }

        return redirect()->back()->with($notification);

    } // End Method

    public function EditExperience($id){
        $experience = Resume::find($id);
        return response()->json($experience);

    } // End Method

    public function UpdateExperince(Request $request){
        $expData = [
            'resume_title' => $request->resume_title,
            'institution' => $request->institution,
            'from_year' => $request->from_year,
            'to_year' => $request->to_year,

        ];
        
        Resume::findOrFail($request->exp_id)->update($expData);

        if($request->resume_cat == 'experience'){
            $notification = [
            'message' => 'Experince Updated Succussfully!',
            'alert-type' => 'info'
            ];
        } else {
             $notification = [
            'message' => 'Education Update Succussfully!',
            'alert-type' => 'info'
            ];
        }

        return redirect()->back()->with($notification);

    }

    public function DeleteExperience($id){
        Resume::findOrFail($id)->delete();
         $notification = [
            'message' => 'Experience Deleted Succussfully!',
            'alert-type' => 'info'
            ];

             return redirect()->back()->with($notification);
        

    } // End Method
}
