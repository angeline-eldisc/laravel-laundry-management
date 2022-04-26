<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\User;
use Alert;
use Auth;

class OutletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = Outlet::first();
        $title = $outlet->name;
        return view('outlet.index', compact(['outlet', 'title']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlet = Outlet::findOrFail($id);
        $title = $outlet->name;
        
        return view('outlet.edit', compact(['outlet', 'title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_num' => 'required|numeric'
        ]);

        $outlet = Outlet::findOrFail($id);

        $outlet->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_num' => $request->phone_num
        ]);

        toastr()->success('Profile outlet has been updated.', 'Success!');
        return redirect()->route('outlet.index');
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'profile' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $outlet = Outlet::findOrFail($id);

        $file = $request->profile;
        if ($file) {
            $image_path = 'images/outlet/' . $outlet->profile;
            if($image_path && $outlet->profile != NULL) {
                unlink($image_path);
            }

            $dir = 'images/outlet';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = "laundry-logo-icon".$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $outlet->profile = $fileName;
            $outlet->save();
        }

        Alert::success('Success!', 'Profile has been changed.');
        return redirect()->back();
    }

    public function deleteProfile($id)
    {
        $outlet = Outlet::findOrFail($id);
        $image_path = 'images/outlet/' . $outlet->profile;
        if($image_path && $outlet->profile != NULL) {
            unlink($image_path);
            $outlet->profile = NULL;
            $outlet->save();
            Alert::success('Success!', 'Profile has been deleted.');
        } else if ($outlet->profile == NULL) {
            Alert::warning('Warning!', 'There is no profile that can be deleted.');
        } else {
            Alert::error('Error!', 'Profile can not be deleted.');
        }

        return redirect()->back();
    }
}
