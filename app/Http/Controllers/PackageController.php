<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Outlet;
use Alert;
use Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = Outlet::first();
        $title = $outlet->name;

        $packages = Package::all();
        return view('package.index', compact(['packages', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = Outlet::first();
        $title = $outlet->name;

        return view('package.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'package_name' => 'required|string',
            'price' => 'required|numeric'
        ]);

        Package::create([
            'type' => $request->type,
            'package_name' => $request->package_name,
            'price' => $request->price
        ]);

        toastr()->success('Package has been added.', 'Success!');
        return redirect()->route('packages.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlet = Outlet::first();
        $title = $outlet->name;

        $package = Package::findOrFail($id);
        return view('package.edit', compact(['package', 'title']));
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
            'type' => 'required',
            'package_name' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $package = Package::findOrFail($id);
        $package->update([
            'type' => $request->type,
            'package_name' => $request->package_name,
            'price' => $request->price
        ]);

        toastr()->success('Package has been edited.', 'Success!');
        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        toastr()->success('Package has been deleted.', 'Success!');
        return redirect()->route('packages.index');
    }
}
