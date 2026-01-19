<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialAccount extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'token',
    ];

    // 소셜 계정이 속한 사용자(User)와의 관계 정의
    public function user(): BelongsTo
    {
        // 이 모델이 다른 모델에 속해 있음을 나타내는 관계를 정의합니다.
        return $this->belongsTo(User::class);
    }
}
