<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Return_item;
use App\Models\Loan;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'password',
    ];

    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function loan()
    {
        return $this->hasMany(Loan::class);
    }

    public function return_item()
    {
        return $this->hasMany(Return_item::class);
    }
}
