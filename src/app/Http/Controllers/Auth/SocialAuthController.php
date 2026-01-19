<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    // 소셜로그인 페이지로 리다이렉트
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // 소셜로그인 콜백 처리
    public function callback($provider)
    {
        try {
            // 1. 소셜 제공자로부터 사용자 정보 가져오기
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            // 취소하거나 에러가 나면 로그인 페이지로
            return redirect('/login')->with('error', '소셜 로그인에 실패했습니다.');
        }

        // 2. 이미 연동된 소셜 계정이 있는지 확인
        $existingSocialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        // [상황 A] 이미 연동된 계정이면 -> 바로 로그인
        if ($existingSocialAccount) {
            Auth::login($existingSocialAccount->user);
            return redirect()->intended('/dashboard'); // 대시보드로 이동
        }

        // [상황 B] 연동된 계정은 없지만, 이메일이 같은 '기존 회원'이 있는지 확인
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // 3. 기존 회원이 존재하면 -> 소셜 계정 정보를 DB에 추가(연동)하고 로그인 시킴
            SocialAccount::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'token' => $socialUser->token,
            ]);

            Auth::login($user);
            // return redirect()->intended('/admin');
            return redirect()->intended('/dashboard');
        }

        // [상황 C] 기존 회원도 없고, 연동 내역도 없음 -> 가입 거절
        return redirect('/login')->with('error', '가입되지 않은 이메일입니다. 먼저 이메일로 회원가입을 진행해주세요.');
    }
}
