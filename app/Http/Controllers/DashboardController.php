<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\User;
use Carbon\Carbon;
use Alert;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $outlet = Outlet::first();
        $title = $outlet->name;

        $transaction = Transaction::all();
        $newTransactions = Transaction::where('status', 'New')->get();
        $processTransactions = Transaction::where('status', 'Process')->get();
        $acceptedTransactions = Transaction::where('status', 'Pick Up')->get();

        $user = User::all();
        $package = Package::all();
        $member = Member::all();
        return view('dashboard', compact(['title', 'user', 'transaction', 'member', 'package', 'newTransactions', 'processTransactions', 'acceptedTransactions']));
    }

    public function resetPassword($id)
    {
        $outlet = Outlet::first();
        $title = $outlet->name;

        return view('users.reset_password', compact(['title']));
    }

    public function reset(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|string|min:4|confirmed'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        Alert::success('Berhasil!', 'Password berhasil diubah.');
        return redirect()->back();
    }
}
