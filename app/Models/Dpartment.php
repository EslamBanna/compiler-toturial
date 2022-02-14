<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpartment extends Model
{
    use HasFactory;
    protected $fillable = ['mall_id', 'name', 'description', 'note'];

    public function mall()
    {
        return $this->belongsTo(Mall::class, 'mall_id', 'id');
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'department_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($department) {
            $department->vendors()->each(function ($vendor) {
                $vendor->delete();
            });
        });
    }
}
