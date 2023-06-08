<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoicesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Invoice([
           'invoice_number'     => $row[0],
           'invoice_date'    => Carbon::now(),
           'due_date' => Carbon::now(),
           'section_id' => $row[3],
           'amount_collection' => $row[4],
           'amount_commission' => $row[5],
           'discount' =>$row[6],
           'product' => $row[7],
           'rate_vat' => $row[8],
           'value_vat' => $row[9],
           'total' => $row[10],
           'status' => $row[11],
           'value_status' => $row[12],
           'note' => $row[13],
           'payment_date' => Carbon::now(),
           'user' => $row[15],
        ]);
    }
}
