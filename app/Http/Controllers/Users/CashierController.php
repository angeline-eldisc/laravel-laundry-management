<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Outlet;
use App\Models\User;
use Alert;
use Auth;

class CashierController extends Controller
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
        if(Auth::user()->role == 'cahsier') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->back();
        }

        $outlet = Outlet::first();
        $title = $outlet->name;

        $cashiers = User::where('role', 'cashier')->get();
        return view('users.cashier.index', compact(['cashiers', 'title']));
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

        return view('users.cashier.create', compact(['title']));
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

        $cashier = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_num' => $request->phone_num,
            'gender' => $request->gender,
            'address' => $request->address,
            'role' => 'cashier'
        ]);

        $file = $request->profile;
        if ($file) {
            $dir = 'images/users';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '-' . $nama . '-' . Str::random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $cashier->profile = $fileName;
            $cashier->save();
        }

        toastr()->success('Cashier user has been added.', 'Success!');
        return redirect()->route('users.cashier.index');
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

        $cashier = User::findOrFail($id);
        return view('users.cashier.show', compact(['cashier', 'title']));
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

        $cashier = User::where('role', 'cashier')->findOrFail($id);
        return view('users.cashier.edit', compact(['cashier', 'title']));
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

        $cashier = User::findOrFail($id);

        $cashier->update([
            'name' => $request->name,
            'phone_num' => $request->phone_num,
            'gender' => $request->gender,
            'address' => $request->address
        ]);

        $file = $request->profile;
        if ($file) {
            $image_path = 'images/users/' . $cashier->profile;
            if($image_path && $cashier->profile != NULL) {
                unlink($image_path);
            }

            $dir = 'images/users';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '-' . $nama . '-' . Str::random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $cashier->profile = $fileName;
            $cashier->save();
        }

        toastr()->success('Cashier user has been edited.', 'Success!');
        return redirect()->route('users.cashier.index');
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
            return redirect()->route('users.cashier.index');
        }

        if(Auth::user()->role == 'cashier') {
            Alert::info('Oopss..', 'You are prohibited from entering this page.');
            return redirect()->back();
        }

        $cashier = User::findOrFail($id);
        $image_path = $image_path = 'images/users/' . $cashier->profile;
        if($image_path && $cashier->profile != NULL) {
            unlink($image_path);
        }

        $cashier->delete();
        toastr()->success('Cashier user has been deleted.', 'Success!');
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

        $cashier = User::findOrFail($id);

        $file = $request->profile;
        if ($file) {
            $image_path = 'images/users/' . $cashier->profile;
            if($image_path && $cashier->profile != NULL) {
                unlink($image_path);
            }

            $dir = 'images/users';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '-' . $nama . '-' . str_random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $cashier->profile = $fileName;
            $cashier->save();
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

        $cashier = User::findOrFail($id);
        $image_path = 'images/users/' . $cashier->profile;
        if($image_path && $cashier->profile != NULL) {
            unlink($image_path);
            $cashier->profile = NULL;
            $cashier->save();
            Alert::success('Success!', 'Profile has been deleted.');
        } else if ($cashier->profile == NULL) {
            Alert::warning('Warning!', 'There is no profile that can be deleted.');
        } else {
            Alert::error('Error!', 'Profile can not be deleted.');
        }

        return redirect()->back();
    }
}
