<?php

namespace App\Models;

use App\Models\OrderStatus;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'order';

    protected $date = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'buyer_id',
        'freelancer_id',
        'service_id',
        'file',
        'note',
        'expired',
        'order_status_id',
    ];

    public function user_buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function user_freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }
}
