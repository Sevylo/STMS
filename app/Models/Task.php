<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'priority',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
