<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageMenus extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'package_menus';
    protected $primaryKey = 'id';
    protected $foreignKey = ['package_id', 'menu_id'];
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'id';
    }
    
    public function packages()
    {
        return $this->belongsTo(Packages::class, 'package_id');
    }

    public function menus()
    {
        return $this->belongsTo(Menus::class, 'menu_id');
    }

    public function carts()
    {
        return $this->belongsTo(Carts::class, 'package_menu_id');
    }

    public function packageMenuPromos()
    {
        return $this->belongsTo(PackageMenuPromos::class, 'package_menu_id');
    }
}
