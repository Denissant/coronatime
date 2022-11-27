<div id="burger-wrapper" class="relative flex items-center">
    <button id="burger-button" class="mr-4 sm:hidden"><x-assets.burger-icon /></button>
    <div id="burger-menu"
         class="my-auto invisible opacity-0 scale-0 absolute top-8 -left-16 transition-all duration-500 origin-top-right
                divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-2 ring-black ring-opacity-5 p-4
                sm:visible sm:opacity-100 sm:scale-100 sm:static sm:ring-0 sm:shadow-none sm:divide-none sm:transition-none sm:flex sm:items-center sm:p-0"
    >
        @auth
            <div class="block pb-6 sm:pb-0 sm:mr-8 font-bold">{{ auth()->user()->username }}</div>
            <form action="{{ route('logout') }}" method="POST" class="block">
                @csrf
                <button type="submit">{{ __('Log Out') }}</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block pb-6 sm:pb-0 sm:mr-8">{{ __('Login') }}</a>
            <a href="{{ route('register') }}" class="block">{{ __('Sign Up') }}</a>
        @endauth
    </div>
</div>
