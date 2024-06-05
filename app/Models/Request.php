<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Request extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'user_id',
        'name',
        'status',
        'data'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
