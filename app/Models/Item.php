<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name' , 'description', 'section_id'
    ];
    //protected $guarded = []; //instead of $fillable

    public function section()
    {
    return $this->belongsTo(Section::class);
    }
}
