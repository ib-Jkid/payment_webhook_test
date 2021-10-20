@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 mr-5 ">Home</a>
            <a href="{{ route('transactions') }}" class="text-sm text-gray-700 dark:text-gray-500 mr-5">Transactions</a>
            <a href="{{ route('payment') }}" class="text-sm text-gray-700 dark:text-gray-500 mr-5">Make Payment</a>

            <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 mr-5">Logout</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 ">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500">Register</a>
            @endif
        @endauth
    </div>
@endif