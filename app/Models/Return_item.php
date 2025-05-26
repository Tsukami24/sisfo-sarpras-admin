<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class Return_item extends Model
{

    protected $table = 'return_items';

    protected $fillable = [
        'loan_id',
        'admin_id',
        'item_id',
        'quantity',
        'returned_date',
        'condition',
        'fine',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
