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
}
