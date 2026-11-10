<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Portifolio;
use App\Models\Services;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


class PortfolioController extends Controller
{
    public function AllRecentWorks(){
        $works = Portifolio::Latest()->get();
        return view('backend.portfolio.all_recent_works', compact('works'));

    } //End Method

    public function AddWork(){
        $services = Services::all();
        
        return view('backend.portfolio.add_work', compact('services'));


    } //End Method

    public function StoreWork(Request $request){
      //584*500
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $imageName = 'work-'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);
            $img = $img->resize(584,500);
            $img = $img->tojpeg(80)->save(base_path('public/uploads/portifolio/'.$imageName));
            $imagePath = 'uploads/portifolio/'.$imageName;

            $work = new Portifolio();
            $work->title = $request->title;
            $work->sub_title = $request->sub_title;
            $work->photo = $imagePath;
            $work->service_cat_id = $request->service_cat;
            $work->url = $request->url;
            $work->save();

            $notification = [
            'message' => 'Work Added with Photo Succussfully!',
            'alert-type' => 'success'
            ];

            return redirect()->route('all.recent.works')->with($notification);

        }

            $work = new Portifolio();
            $work->title = $request->title;
            $work->sub_title = $request->sub_title;
            $work->service_cat_id = $request->service_cat;
            $work->url = $request->url;
            $work->save();

            $notification = [
            'message' => 'Work Added without Photo Succussfully!',
            'alert-type' => 'success'
            ];

            return redirect()->route('all.recent.works')->with($notification);

    }// End Method

    public function EditWork($id){
            $work = Portifolio::find($id);
            $services = Services::all();
            return view('backend.portfolio.edit_work', compact('work', 'services'));

    }// End Method

    public function UpdateWork(Request $request){
            $work = Portifolio::findOrFail($request->work_id);
            if($request->hasFile('photo')){
                unlink($work->photo);
                $file = $request->file('photo');
                $imageName = 'work-'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $img = $manager->read($file);
                $img = $img->resize(584,500);
                $img = $img->tojpeg(80)->save(base_path('public/uploads/portifolio/'.$imageName));
                $imagePath = 'uploads/portifolio/'.$imageName;

                $work->title = $request->title;
                $work->sub_title = $request->sub_title;
                $work->photo = $imagePath;
                $work->service_cat_id = $request->service_cat;
                $work->url = $request->url;
                $work->save();

                $notification = [
                'message' => 'Work Updated with Photo Succussfully!',
                'alert-type' => 'info'
                ];

            return redirect()->route('all.recent.works')->with($notification);

        }

            $work->title = $request->title;
            $work->sub_title = $request->sub_title;
            $work->service_cat_id = $request->service_cat;
            $work->url = $request->url;
            $work->save();

            $notification = [
            'message' => 'Work updated without Photo Succussfully!',
            'alert-type' => 'info'
            ];

            return redirect()->route('all.recent.works')->with($notification);
    } //End Method

    public function DeleteWork($id){
        $work = Portifolio::findOrFail($id);
        unlink($work->photo);
        $work->delete();

        $notification = [
            'message' => 'Work deleted Photo Succussfully!',
            'alert-type' => 'info'
            ];

            return redirect()->route('all.recent.works')->with($notification);

    } //End Method

}
