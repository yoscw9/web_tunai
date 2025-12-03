<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menus extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $foreignKey = 'category_id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function carts()
    {
        return $this->belongsTo(Carts::class, 'menu_id');
    }

    public function packageMenus()
    {
        return $this->hasMany(PackageMenus::class, 'menu_id');
    }

    public function menuPromos()
    {
        return $this->belongsTo(MenuPromos::class, 'menu_id');
    }
}
