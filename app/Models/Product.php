<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'manufacture_company', 'photo'];

    public function getPhotoAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'images/products/' . $value);
    }

    public function Vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_products', 'product_id', 'vendor_id');
    }
}
