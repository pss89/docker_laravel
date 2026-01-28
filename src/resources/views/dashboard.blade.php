{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h1 class="text-2xl font-bold mb-4">커뮤니티 홈</h1>

                    @auth
                        <div class="mb-4 p-4 bg-indigo-50 dark:bg-indigo-900 rounded-lg">
                            <p class="font-bold">{{ Auth::user()->name }}님, 안녕하세요!</p>
                            <p class="text-sm">오늘도 즐거운 커뮤니티 활동 되세요.</p>
                        </div>
                    @else
                        <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <p>로그인하지 않으셨군요!</p>
                            <p class="text-sm">로그인하면 더 많은 기능을 사용할 수 있습니다.</p>
                        </div>
                    @endauth

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <div class="border p-4 rounded dark:border-gray-600">
                            <h2 class="text-lg font-bold mb-2">📢 공지사항</h2>
                            <ul class="list-disc pl-5 text-sm">
                                <li>사이트 오픈 안내</li>
                                <li>다크모드 기능 추가</li>
                            </ul>
                        </div>
                        <div class="border p-4 rounded dark:border-gray-600">
                            <h2 class="text-lg font-bold mb-2">🔥 인기글</h2>
                            <ul class="list-disc pl-5 text-sm">
                                <li>라라벨 개발 꿀팁 공유</li>
                                <li>오늘 저녁 뭐 먹지?</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>