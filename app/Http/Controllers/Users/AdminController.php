<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\User;
use Alert;
use Auth;

class AdminController extends Controller
{
    /**
     * Contructor
     */
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
        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page.');
            return redirect()->back();
        }

        $outlet = Outlet::first();
        $title = $outlet->name;

        $admins = User::where('role', 'admin')->get();
        return view('users.admin.index', compact(['admins', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page.');
            return redirect()->back();
        }

        $outlet = Outlet::first();
        $title = $outlet->name;

        return view('users.admin.create', compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page.');
            return redirect()->back();
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:5',
            'phone_num' => 'required|numeric|digits_between:10,13',
            'gender' => 'required',
            'address' => 'required',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $admin = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_num' => $request->phone_num,
            'gender' => $request->gender,
            'address' => $request->address,
            'role' => 'admin'
        ]);

        $file = $request->profile;
        if ($file) {
            $dir = 'images/users';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '-' . $nama . '-' . Str::random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $admin->profile = $fileName;
            $admin->save();
        }

        toastr()->success('Admin user has been added.', 'Success!');
        return redirect()->route('users.admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page');
            return redirect()->back();
        }

        $outlet = Outlet::first();
        $title = $outlet->name;

        $admin = User::findOrFail($id);
        return view('users.admin.show', compact(['admin', 'title']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page.');
            return redirect()->back();
        }

        $outlet = Outlet::first();
        $title = $outlet->name;

        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('users.admin.edit', compact(['admin', 'title']));
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
        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page.');
            return redirect()->back();
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone_num' => 'required|numeric|digits_between:10,13',
            'gender' => 'required',
            'address' => 'required',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $admin = User::findOrFail($id);

        $admin->update([
            'name' => $request->name,
            'phone_num' => $request->phone_num,
            'gender' => $request->gender,
            'address' => $request->address
        ]);

        $file = $request->profile;
        if ($file) {
            $image_path = 'images/users/' . $admin->profile;
            if($image_path && $admin->profile != NULL) {
                unlink($image_path);
            }

            $dir = 'images/users';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '-' . $nama . '-' . Str::random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $admin->profile = $fileName;
            $admin->save();
        }

        toastr()->success('Admin user has been edited.', 'Success!');
        return redirect()->route('users.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            Alert::warning('Warning!', 'You are forbidden to delete yourself.');
            return redirect()->route('users.admin.index');
        }

        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page.');
            return redirect()->back();
        }

        $admin = User::findOrFail($id);
        $image_path = 'images/users/' . $admin->profile;
        if($image_path && $admin->profile != NULL) {
            unlink($image_path);
        }

        $admin->delete();

        toastr()->success('Admin user has been deleted.', 'Success!');
        return redirect()->back();
    }

    public function updateProfile(Request $request, $id)
    {
        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page.');
            return redirect()->back();
        }

        $this->validate($request, [
            'profile' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $admin = User::findOrFail($id);

        $file = $request->profile;
        if ($file) {
            $image_path = 'images/users/' . $admin->profile;
            if($image_path && $admin->profile != NULL) {
                unlink($image_path);
            }

            $dir = 'images/users';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '-' . $nama . '-' . str_random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $admin->profile = $fileName;
            $admin->save();
        }

        Alert::success('Success!', 'Profile has been changed.');
        return redirect()->back();
    }

    public function deleteProfile($id)
    {
        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page.');
            return redirect()->back();
        }

        $admin = User::findOrFail($id);
        $image_path = 'images/users/' . $admin->profile;
        if($image_path && $admin->profile != NULL) {
            unlink($image_path);
            $admin->profile = NULL;
            $admin->save();
            Alert::success('Success!', 'Profile has been deleted.');
        } else if ($admin->profile == NULL) {
            Alert::warning('Warning!', 'There is no profile that can be deleted.');
        } else {
            Alert::error('Error!', 'Profile can not be deleted.');
        }

        return redirect()->back();
    }
}
