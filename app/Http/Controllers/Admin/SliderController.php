<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    public function index()
    {
        return view('admin.sliders.index');
    }


    public function create()
    {
        return view('admin.sliders.create');
    }


    public function store(SliderRequest $request)
    {
        try {
            $data = $request->validated();
            $sliderData =[];
            if($request->has('slider')){
                $image = $request->file('slider');
                $request->slider['url']->store('public/sliders/');
                $sliderData =[
                    'title' => $request->slider['title'],
                    'alt' => $request->slider['alt'],
                    'url' => $request->slider['url']->hashName(),
                ];
                $data['slider'] = json_encode($sliderData,true);
            }
            Slider::create($data);
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('admin.sliders.index');
        }catch(\Exception $e){

            dd($e);

        }



    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
