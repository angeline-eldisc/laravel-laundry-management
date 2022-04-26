<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;
use App\Exports\MembersExport;
use App\Exports\AdminsExport;
use App\Exports\CashiersExport;
use App\Exports\OwnersExport;
use App\Models\Outlet;

class ReportController extends Controller
{
    public function index(){
        $outlet = Outlet::first();
        $title = $outlet->name;

        return view('report.index', compact(['title']));
    }

    public function excelReportTransaction(){
        return Excel::download(new TransactionsExport, 'report_transaction_'.date('Y-m-d_H-i-s').'.xlsx');
    }

    public function excelReportMember(){
        return Excel::download(new MembersExport, 'report_members_'.date('Y-m-d_H-i-s').'.xlsx');
    }

    public function excelReportUserAdmin(){
        return Excel::download(new AdminsExport, 'report_users_admin_'.date('Y-m-d_H-i-s').'.xlsx');
    }

    public function excelReportUserCashier(){
        return Excel::download(new CashiersExport, 'report_users_cashier_'.date('Y-m-d_H-i-s').'.xlsx');
    }

    public function excelReportUserOwner(){
        return Excel::download(new OwnersExport, 'report_users_owner_'.date('Y-m-d_H-i-s').'.xlsx');
    }
}
