<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuPromos extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'menu_promos';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function menus()
    {
        return $this->belongsTo(Menus::class, 'menu_id');
    }

    public function promos()
    {
        return $this->belongsTo(Promos::class, 'promo_id');
    }

    public function carts()
    {
        return $this->belongsTo(Carts::class, 'menu_promo_id');
    }
}
