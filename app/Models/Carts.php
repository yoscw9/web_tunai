<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carts extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'carts';
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

    public function menuPromos()
    {
        return $this->belongsTo(MenuPromos::class, 'menu_promo_id');
    }

    public function packageMenus()
    {
        return $this->belongsTo(PackageMenus::class, 'package_menu_id');
    }

    public function packageMenuPromos()
    {
        return $this->belongsTo(PackageMenuPromos::class, 'package_menu_promo_id');
    }
}
