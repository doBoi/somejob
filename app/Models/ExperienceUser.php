<?php

namespace App\Models;

use App\Models\DetailUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienceUser extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'experience_Uuser';

    protected $date = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'detail_user_id',
        'experience'
    ];
    // one to many
    public function detail_user()
    {
        return $this->belongsTo(DetailUser::class, 'detail_user_id', 'id');
    }
}
