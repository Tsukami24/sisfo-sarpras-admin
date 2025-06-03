<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan_item extends Model
{
    use HasFactory;

    protected $table = 'loan_items';

    protected $fillable = [
        'loan_id',
        'item_id',
        'quantity',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
