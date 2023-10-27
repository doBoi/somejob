<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUser extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'detail_user';

    protected $date = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'photo',
        'role',
        'contact_number',
        'biography',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    // one to one
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    // one to many
    public function experience_user()
    {
        return $this->hasMany(ExperienceUser::class, 'detail_user_id');
    }
}
