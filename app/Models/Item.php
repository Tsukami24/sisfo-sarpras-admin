<?php

namespace App\Models;

use App\Models\Loan;
use App\Models\Loan_item;
use App\Models\Return_item;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'stock',
        'total',
        'description',
        'image',
        'category_id',
        'admin_id'
    ];

    protected $appends = ['image_url'];

    protected function getImageUrlAttribute()
    {
        if (Storage::disk('public')->exists($this->attributes['image'])) {
            return asset('storage/' . $this->attributes['image']);
        }

        return asset('path/to/default-image.jpg');
    }



    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function loan()
    {
        return $this->belongsToMany(Loan::class, 'loan_items')->withPivot('quantity');
    }

    public function loanItems()
    {
        return $this->hasMany(Loan_item::class);
    }

    public function returnItems()
    {
        return $this->hasMany(Return_item::class);
    }
}
