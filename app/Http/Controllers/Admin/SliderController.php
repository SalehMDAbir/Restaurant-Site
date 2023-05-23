<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliderView = Slider::all();
        return view('admin.slider.index',compact('sliderView'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image))
        {
            $imageDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$imageDate.'-'.'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploades/slider')){
                mkdir('uploades/slider', 077,true);
            }
            $image->move('uploades/slider',$imageName);
        }
        else{
            $imageName= 'default.png';
        }
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        $slider->save();
        return redirect()->route('slider.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sliderEdit = Slider::find($id);
        return view('admin.slider.edit',compact('sliderEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'sub_title' => 'required',
        ]);
        $slider = Slider::find($id);
        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image))
        {
            $imageDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$imageDate.'-'.'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploades/slider')){
                mkdir('uploades/slider', 077,true);
            }
            $image->move('uploades/slider',$imageName);
        }
        else{
            $imageName= $slider->image;
        }
       
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        $slider->save();
        return redirect()->route('slider.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);
        if(file_exists('uploades/slider/'.$slider->image)){

            unlink('uploades/slider/'.$slider->image);
        }
        $slider->delete();
        return redirect()->route('slider.index');
    }
}
