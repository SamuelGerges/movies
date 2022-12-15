<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(ProfileRequest $request)
    {
        $data = $request->validated();

        if ($request->image) {
            if (auth()->user()->hasImage()) {
                Storage::disk('local')->delete('public/uploads/profile' . auth()->user()->image);
            }

            $request->image->store('public/uploads/profile');
            $data['image'] = $request->image->hashName();

        }//end of if

        auth()->user()->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.home');

    }// end of postChangeData
}
