<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request
;use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\Member;
use App\Models\Outlet;
use Alert;
use Auth;

class TransactionController extends Controller
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

        $transactions = Transaction::orderByDesc('id')->get();
        $packages = Package::all();
        return view('transaction.index', compact(['transactions', 'packages', 'title']));
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

        $getRow = Transaction::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $code = "TR000001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $code = "TR00000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $code = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $code = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $code = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 99999) {
                $code = "TR0".''.($lastId->id + 1);
            } else {
                    $code = "TR".''.($lastId->id + 1);
            }
        }

        $members = Member::all();
        $packages = Package::all();

        return view('transaction.create',compact(['members', 'packages', 'code', 'title']));
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
            'member_id' => 'required',
            'date' => 'required',
            'due_date' => 'required',
            'payment_date' => 'nullable',
            'additional_cost' => 'required|numeric',
            'discount' => 'required|numeric',
            'tax' => 'required|numeric',
            'paid_status' => 'required',
            'package_id' => 'required',
            'qty' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        $paidStatus = $request->paid_status;
        if ($paidStatus == 'Paid') {
            $this->validate($request, [
                'payment_date' => 'required'
            ]);
        }

        $transaction = Transaction::create([
            'invoice_code' => $request->invoice_code,
            'member_id' => $request->member_id,
            'date' => $request->date,
            'due_date' => $request->due_date,
            'payment_date' => $request->payment_date,
            'additional_cost' => $request->additional_cost,
            'discount' => $request->discount,
            'tax' => $request->tax,
            'status' => 'New',
            'paid_status' => $request->paid_status
        ]);

        $package = Package::firstWhere('id', $request->package_id);
        $total = $package->price * $request->qty;

        if ($request->description == NULL ) {
            $description = "-";
        } else {
            $description = $request->description;
        }

        $transaction->packages()->attach($request->package_id, [
            'qty' => $request->qty,
            'total' => $total,
            'description' => $description
        ]);

        toastr()->success('Transaction has been added.', 'Success!');
        return redirect()->route('transactions.index');
    }

    public function addPackageItem(Request $request)
    {
        $this->validate($request, [
            'package_id' => 'required',
            'qty' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        $invoiceCode = $request->invoice_code;
        $transaction = Transaction::firstWhere('invoice_code', $invoiceCode);

        $package = Package::firstWhere('id', $request->package_id);
        $total = $package->price * $request->qty;

        if ($request->description == NULL ) {
            $description = "-";
        } else {
            $description = $request->description;
        }

        foreach($transaction->packages as $packages) {
            $packageID = $packages->pivot->package_id;

            if($packageID == $request->package_id) {
                toastr()->warning('You can not add the same item.', 'Warning!');
                return redirect()->route('transactions.index');
            }
        }

        $transaction->packages()->attach($request->package_id, [
            'qty' => $request->qty,
            'total' => $total,
            'description' => $description
        ]);

        toastr()->success('New package item has been added.', 'Success!');
        return redirect()->route('transactions.index');
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

        $transaction = Transaction::findOrFail($id);
        $packages = Package::all();
        return view('transaction.show',compact(['transaction', 'packages', 'title']));
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

        $transaction = Transaction::findOrFail($id);
        $members = Member::all();
        $packages = Package::all();

        return view('transaction.edit',compact(['transaction', 'members', 'packages', 'title']));
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
            'member_id' => 'required',
            'payment_date' => 'nullable',
            'additional_cost' => 'required|numeric',
            'discount' => 'required|numeric',
            'tax' => 'required|numeric',
            'status' => 'required',
            'paid_status' => 'required'
        ]);

        $paidStatus = $request->paid_status;
        if ($paidStatus == 'Paid') {
            $this->validate($request, [
                'payment_date' => 'required'
            ]);
        }

        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'member_id' => $request->member_id,
            'payment_date' => $request->payment_date,
            'additional_cost' => $request->additional_cost,
            'discount' => $request->discount,
            'tax' => $request->tax,
            'status' => $request->status,
            'paid_status' => $request->paid_status,
        ]);

        toastr()->success('Transaction has been edited.', 'Success!');
        return redirect()->route('transactions.index');
    }

    public function editPackageItem(Request $request, $id) {
        $this->validate($request, [
            'package_id' => 'required',
            'qty' => 'required|numeric',
            'description' => 'required|string'
        ]);

        $ItemPackageID = $request->ItemPackageID;
        $detailTransaction = DetailTransaction::findOrFail($ItemPackageID);

        $package = Package::findOrFail($request->package_id);
        $price = $package->price;
        $total = $price * $request->qty;

        $detailTransaction->update([
            'transaction_id' => $transaction->id,
            'package_id' => $request->package_id,
            'qty' => $request->qty,
            'total' => $total,
            'description' => $request->description
        ]);

        toastr()->success('Item Package has been edited.', 'Success!');
        return redirect()->route('transactions.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        if($transaction) {
            $transaction->packages()->detach();
            $transaction->delete();
            toastr()->success('Transaction has been deleted.', 'Success!');
        } else {
            toastr()->success('Transaction can not be deleted.', 'Success!');
        }

        return redirect()->route('transactions.index');
    }

    public function deletePackageItem($id) {
        $detailTransaction = DetailTransaction::findOrFail($id);
        $detailTransaction->delete();

        toastr()->success('Item Package has been deleted.', 'Success!');
        return redirect()->back();
    }

    public function printInvoice($id) {
        $transaction = Transaction::findOrFail($id);
        $outlet = Outlet::first();

        $pdf = PDF::loadView('transaction.invoice', compact(['transaction', 'outlet']))->setPaper('a4', 'portrait');
        return $pdf->stream('print-invoice_'.date('Y-m-d_H-i-s').'.pdf');
    }
}
