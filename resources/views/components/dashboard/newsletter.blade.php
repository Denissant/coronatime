<section class="flex flex-col items-center bg-gradient-linear-green py-10 rounded-2xl mt-[7vh] sm:mt-[13vh]">
    <h4 class="font-black text-2xl">{{ __('Get notified first') }}</h4>
    <p class="font-normal mt-4">{{ __('Get') }} <span class="font-bold">{{ __('personalised') }}</span> {{ __('notifications via email') }}</p>
    <label for="email" class="sr-only">Newsletter email</label>
    <form class="relative w-11/12 lg:w-1/3" method="POST">
        @csrf
        <input id="email" name="email" type="email" placeholder="{{ __('Enter your email') }}"
               class="w-full mt-10 rounded-[32px] h-16 pl-16 pr-20 sm:pr-32 border-0 focus:border-1 focus:border-brand-lightgreen focus:ring-brand-darkgreen" />
        <div class="absolute h-5 w-5 bottom-[1.375rem] left-7"><x-assets.search /></div>
        <button type="submit"
                class="absolute uppercase h-12 w-16 sm:w-28 bottom-2 right-2
                       rounded-[27px] bg-brand-lightgreen text-white text-sm font-black text-white">
            {{ __('Send') }}
        </button>
    </form>
</section>
