<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_settings')->only(['index', 'socialLinks', 'socialLogin']);

    }// end of __construct

    public function general()
    {
        return view('admin.settings.general');

    }// end of index


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'sometimes|nullable|email',
        ]);

        $data = $request->except(['_token', '_method']);

        if ($request->logo) {
            Storage::disk('local')->delete('public/uploads/' . setting('logo'));
            $request->logo->store('public/uploads');
            $data['logo'] = $request->logo->hashName();
        }

        if ($request->fav_icon) {
            Storage::disk('local')->delete('public/uploads/' . setting('fav_icon'));
            $request->fav_icon->store('public/uploads');
            $data['fav_icon'] = $request->fav_icon->hashName();
        }

        setting($data)->save();

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
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
