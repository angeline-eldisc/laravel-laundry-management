<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\Outlet;
use Alert;
use Auth;

class MemberController extends Controller
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

        $members = Member::all();
        return view('member.index', compact(['members', 'title']));
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

        return view('member.create', compact(['title']));
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
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'gender' => 'required',
            'phone_num' => 'required|numeric|digits_between:10,13',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $member = Member::create([
            'name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone_num' => $request->phone_num,
        ]);

        $file = $request->profile;
        if ($file) {
            $dir = 'images/users';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '-' . $nama . '-' . Str::random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $member->profile = $fileName;
            $member->save();
        }

        toastr()->success('Member has been added.', 'Success!');
        return redirect()->route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlet = Outlet::first();
        $title = $outlet->name;

        $member = Member::findOrFail($id);
        return view('member.show', compact(['member', 'title']));
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

        $member = Member::findOrFail($id);
        return view('member.edit', compact(['member', 'title']));
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
            'gender' => 'required',
            'phone_num' => 'required|numeric',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $member = Member::findOrFail($id);

        $member->update([
            'name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone_num' => $request->phone_num,
        ]);

        $file = $request->profile;
        if ($file) {
            $image_path = 'images/users/' . $member->profile;
            if($image_path && $member->profile != NULL) {
                unlink($image_path);
            }
            $dir = 'images/users';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '-' . $nama . '-' . Str::random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $member->profile = $fileName;
            $member->save();
        }

        toastr()->success('Member has been edited.', 'Success!');
        return redirect()->route('members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $memberInTransaction = $member->has('transactions');

        if($memberInTransaction) {
            // If the member data is exists in related table (transactions table)
            Alert::warning('Warning!', 'You can not delete this member because this member is related in transaction table.');
            return redirect()->back();
        } else {
            $image_path = 'images/users/' . $member->profile;
            if($image_path && $member->profile != NULL) {
                unlink($image_path);
            }
            $member->delete();
            toastr()->success('Member has been deleted.', 'Success!');
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'profile' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $member = Member::findOrFail($id);

        $file = $request->profile;
        if ($file) {
            $image_path = 'images/users/' . $member->profile;
            if($image_path && $member->profile != NULL) {
                unlink($image_path);
            }

            $dir = 'images/users';
            $nama = pathinfo($request->file('profile')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '-' . $nama . '-' . str_random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $member->profile = $fileName;
            $member->save();
        }

        Alert::success('Success!', 'Profile has been changed.');
        return redirect()->back();
    }

    public function deleteProfile($id)
    {
        $member = Member::findOrFail($id);
        $image_path = 'images/users/' . $member->profile;
        if($image_path && $member->profile != NULL) {
            unlink($image_path);
            $member->profile = NULL;
            $member->save();
            Alert::success('Success!', 'Profile has been deleted.');
        } else if ($member->profile == NULL) {
            Alert::warning('Warning!', 'There is no profile that can be deleted.');
        } else {
            Alert::error('Error!', 'Profile can not be deleted.');
        }

        return redirect()->back();
    }
}
