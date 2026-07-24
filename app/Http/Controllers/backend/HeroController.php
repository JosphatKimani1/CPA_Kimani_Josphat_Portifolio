<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class HeroController extends Controller
{
    public function HeroSection(){
        $hero = Hero::find(1);
        return view('backend.hero.hero_section', compact('hero'));

    }// End Method

    public function UpdateHeroSection(Request $request){
        if($request->hasFile('photo')){
            $photoOld = Hero::find(1);
            unlink($photoOld->photo);
            $file = $request->file('photo');
            $imageName = 'Hero-'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);
            $img = $img->resize(437,475);
            $img = $img->tojpeg(80)->save(base_path('public/uploads/hero/'.$imageName));
            $imagePath = 'uploads/hero/'.$imageName;


            Hero::find(1)->update([
                'name' => $request->name,
                'profession' => $request->profession,
                'short_description' => $request->short_description,
                'photo' => $imagePath,
                'twitter_url' => $request->twitter_url,
                'youtube_url' => $request->youtube_url,
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'YOE' => $request->YOE,
                'PC' => $request->PC,
                'HC' => $request->HC,
                'updated_at' => Carbon::now()



            ]);

              $notification = [
            'message' => 'Hero Section Updated with photo Succussfully!',
            'alert-type' => 'success'
            ];

            if(!$request->hasFile('resume')){
                return redirect()->back()->with($notification);

            } 
            
            }elseif($request->hasFile('resume')){
                $oldResume = Hero::find(1);
                unlink($oldResume->resume);
                $resume = $request->file('resume');
                $resumeNewName = 'Resume_'.hexdec(uniqid()).'.'.$resume->getClientOriginalExtension();
                $resume->move(public_path('uploads/resume'), $resumeNewName);
                $resumePath = 'uploads/resume/'.$resumeNewName;

                Hero::find(1)->update([
                'name' => $request->name,
                'profession' => $request->profession,
                'short_description' => $request->short_description,
                'resume' => $resumePath,
                'twitter_url' => $request->twitter_url,
                'youtube_url' => $request->youtube_url,
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'YOE' => $request->YOE,
                'PC' => $request->PC,
                'HC' => $request->HC,
                'updated_at' => Carbon::now()

            ]);

              $notification = [
            'message' => 'Hero Section Updated with Resume Succussfully!',
            'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);

            }

            Hero::find(1)->update([
                'name' => $request->name,
                'profession' => $request->profession,
                'short_description' => $request->short_description,
                'twitter_url' => $request->twitter_url,
                'youtube_url' => $request->youtube_url,
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'YOE' => $request->YOE,
                'PC' => $request->PC,
                'HC' => $request->HC,
                'updated_at' => Carbon::now()

            ]);

        $notification = [
            'message' => 'Hero Section Updated without photo or Resume Succussfully!',
            'alert-type' => 'success'

            ];

            return redirect()->back()->with($notification);

     }//End Method
}
