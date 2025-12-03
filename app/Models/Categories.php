<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rules\In;

class Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'categories';
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
        return $this->belongsTo(Menus::class, 'category_id');
    }
}
