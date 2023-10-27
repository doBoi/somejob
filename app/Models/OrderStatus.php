<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    public $table = 'order_status';

    protected $date = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
    ];

    public function order()
    {
        return $this->hasMany(Order::class, 'order_status_id');
    }
}
