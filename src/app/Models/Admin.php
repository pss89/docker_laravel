<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    //
    use HasFactory, Notifiable;

    // 입력 가능한 칼럼 정의
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // 숨겨야 할 칼럼 정의
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 비밀번호 해시 자동 처리
    protected $casts = [
        'password' => 'hashed',
    ];
}
