<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\DetailTransaction;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class TransactionsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return[
            "Invoice Code",
            "Member",
            "Member's Address",
            "Member's Phone Number",
            "Transaction Date",
            "Due Date",
            "Payment Date",
            "Package",
            "Additional Cost",
            "Discount",
            "Tax",
            "Status",
            "Paid Status"
        ];
    }

    public function map($transaction): array
    {
         return[
            $transaction->invoice_code,
            $transaction->member->name,
            $transaction->member->address,
            $transaction->member->phone_num,
            $transaction->date,
            $transaction->due_date,
            $transaction->payment_date != NULL ? $transaction->payment_date : '-',
            $transaction->packages->pluck('package_name')->implode(', '),
            $transaction->additional_cost != NULL ? $transaction->additional_cost : '-',
            $transaction->discount,
            $transaction->tax,
            $transaction->status,
            $transaction->paid_status
         ];
    }

    public function query()
    {
        return Transaction::query();
    }
}
