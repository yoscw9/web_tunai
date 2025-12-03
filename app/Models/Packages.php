<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packages extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'packages';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function carts()
    {
        return $this->belongsTo(Carts::class, 'package_id');
    }

    public function packageMenus()
    {
        return $this->hasMany(PackageMenus::class, 'package_id');
    }

    public function menus()
    {
        return $this->belongsToMany(Menus::class, 'package_menus', 'package_id', 'menu_id');
    }
}
