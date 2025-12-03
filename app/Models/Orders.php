<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_date',
    'order_code',
    'cust_name',
    'total_amount',
    'payment_method',
    // PASTIKAN KOLOM INI ADA:
    'cash_paid',        // <-- WAJIB
    'change_amount',    // <-- WAJIB
    'payment_status',   // <-- WAJIB
];

    protected $guarded = [];
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}
