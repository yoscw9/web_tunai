<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeanutBrittles extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'peanut_brittles';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
}
