<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function orders()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }
}
