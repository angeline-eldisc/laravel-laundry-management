<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Transaction;

class HomeController extends Controller
{
    public function index() {
        $outlet = Outlet::first();
        $title = $outlet->name;
        return view('home', compact(['title']));
    }

    public function about() {
        $outlet = Outlet::first();
        $title = $outlet->name;
        return view('pages.about', compact(['title']));
    }

    public function trackLaundry(Request $request) {
        $outlet = Outlet::first();
        $title = $outlet->name;

        $search = $request->invoice_code;
        if($search) {
            $transaction = Transaction::where('invoice_code', $search)->first();
        } else {
            $transaction = NULL;
        }

        return view('pages.trackLaundry', compact(['title', 'transaction', 'search']));
    }

    public function contact() {
        $outlet = Outlet::first();
        $title = $outlet->name;

        return view('pages.contact', compact(['title', 'outlet']));
    }
}
