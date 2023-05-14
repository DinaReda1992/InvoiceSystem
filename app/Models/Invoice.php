<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
        'section_id',
        'amount_collection',
        'amount_commission',
        'discount',
        'product',
        'rate_vat',
        'value_vat',
        'total',
        'status',
        'value_status',
        'note',
        'user',
        'payment_date'
    ];
    protected $dates = ['deleted_at'];
    // protected $guarded = [];
    public function section()
    {
    return $this->belongsTo(Section::class);
    }
}
