<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promos extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'promos';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function menuPromos()
    {
        return $this->belongsTo(MenuPromos::class, 'promo_id');
    }

    public function packageMenuPromos()
    {
        return $this->belongsTo(PackageMenuPromos::class, 'promo_id');
    }
}
