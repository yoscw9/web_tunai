<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageMenuPromos extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'package_menu_promos';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function packageMenus()
    {
        return $this->belongsTo(PackageMenus::class, 'package_menu_id');
    }

    public function promos()
    {
        return $this->belongsTo(Promos::class, 'promo_id');
    }

    public function carts()
    {
        return $this->belongsTo(Carts::class, 'package_menu_promo_id');
    }
}
