<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use App\Models\Admin;
use App\Models\Loan_item;
use App\Models\Return_item;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    protected $table = 'loans';
    protected $fillable = [
        'user_id',
        'admin_id',
        'loan_date',
        'return_date',
        'status',
        'reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'loan_items')->withPivot('quantity');
    }

    public function loanItems()
    {
        return $this->hasMany(Loan_item::class);
    }

    public function returnItems()
    {
        return $this->hasMany(Return_item::class);
    }

    public function item()
    {
        return $this->hasMany(Loan_item::class, 'loan_id');
    }
}
