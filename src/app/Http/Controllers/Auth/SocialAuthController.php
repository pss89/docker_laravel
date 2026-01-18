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
        // 소셜 사용자 정보 가져오기
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('소셜 로그인에 실패했습니다.');
        }

        // SocialAccount 모델에서 이미 연동된 계정인지 확인
        $socialAccount = SocialAccount::where('provider_name', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        // 이미 연동 된 계정이면 바로 로그인
        if ($socialAccount) {
            $user = $socialAccount->user;
            Auth::login($user);
            return redirect('/dashboard');
        }

        // 연동된 계정이 없다면 이메일로 기존 회원 확인
        $email = $socialUser->getEmail();
        $user = User::where('email', $email)->first();

        // 기존 회원이 없다면 신규 회원 가입 처리
        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User_' . Str::random(5),
                'email' => $email,
                'password' => Hash::make(Str::random(16)), // 임의의 비밀번호 설정
            ]);
        }

        // 소셜 계정 연동
        $socialAccount = SocialAccount::create([
            'user_id' => $user->id,
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'token' => $socialUser->token,
        ]);

        // 로그인 및 이동
        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
