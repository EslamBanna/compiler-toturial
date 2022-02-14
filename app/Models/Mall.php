<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    use HasFactory;

    protected $fillable = ['manager_id', 'name', 'address', 'phone', 'space', 'note', 'photo'];


    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

    public function getPhotoAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'images/malls/' . $value);
    }
    public function departments()
    {
        return $this->hasMany(Dpartment::class, 'mall_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($mall) {
            $mall->departments()->each(function ($department) {
                $department->delete();
            });
        });
    }
}
