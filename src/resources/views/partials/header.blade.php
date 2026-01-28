<header class="sticky top-0 z-50 w-full border-b bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                    MyCommunity
                </a>
                <nav class="hidden md:flex gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-200 dark:hover:text-indigo-400">
                        홈
                    </a>
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-200 dark:hover:text-indigo-400">
                        자유게시판
                    </a>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <button id="theme-toggle" type="button" class="rounded-lg p-2.5 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                    <span id="theme-toggle-dark-icon" class="hidden">🌙</span>
                    <span id="theme-toggle-light-icon" class="hidden">☀️</span>
                </button>

                @auth
                    <div class="hidden md:flex items-center gap-4">
                        <span class="text-sm text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}님</span>
                        <a href="{{ route('mypage') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-200">마이페이지</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline dark:text-red-400">로그아웃</button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-200">로그인</a>
                        <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">회원가입</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>