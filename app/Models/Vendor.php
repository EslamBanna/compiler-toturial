<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'name', 'phone', 'description', 'note', 'logo'];

    public function getLogoAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'images/vendors/' . $value);
    }
    public function department()
    {
        return $this->belongsTo(Dpartment::class, 'department_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'vendor_products', 'vendor_id', 'product_id');
    }

    public function realedProducts()
    {
        return $this->hasMany(VendorProduct::class, 'vendor_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($vendors) {
            $vendors->realedProducts()->each(function ($realedProduct) {
                $realedProduct->delete();
            });
        });
    }
}
