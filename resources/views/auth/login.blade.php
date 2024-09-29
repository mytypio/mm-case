<x-guest-layout>

    <div class="isolate overflow-hidden bg-gray-900 w-100">

        <svg
            class="absolute inset-0 -z-10 h-full w-full stroke-white/10 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
            aria-hidden="true">
            <defs>
                <pattern id="983e3e4c-de6d-4c3f-8d64-b9761d1534cc" width="200" height="200" x="50%" y="-1"
                         patternUnits="userSpaceOnUse">
                    <path d="M.5 200V.5H200" fill="none"/>
                </pattern>
            </defs>
            <svg x="50%" y="-1" class="overflow-visible fill-gray-800/20">
                <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z"
                      stroke-width="0"/>
            </svg>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#983e3e4c-de6d-4c3f-8d64-b9761d1534cc)"/>
        </svg>
        <div
            class="absolute left-[calc(50%-4rem)] top-10 -z-10 transform-gpu blur-3xl sm:left-[calc(50%-18rem)] lg:left-48 lg:top-[calc(50%-30rem)] xl:left-[calc(50%-24rem)]"
            aria-hidden="true">
            <div class="aspect-[1108/632] w-[69.25rem] bg-gradient-to-r from-[#80caff] to-[#4f46e5] opacity-20"
                 style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)"></div>
        </div>

        <div class="mt-6 px-6 py-4 overflow-hidden sm:rounded-lg" style="width: 500px">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <div class="flex min-h-full flex-col justify-center px-6 py-6 lg:px-8">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <h1 class="mt-4 text-3xl font-bold leading-9 tracking-tight text-gray-100">Welcome back!</h1>
                    <h2 class="mt-4 text-xl -mt-2 font-bold leading-9 tracking-tight text-gray-600">Login to your
                        account</h2>
                </div>
                <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <x-input-label class="block text-sm font-medium leading-6 text-gray-50" for="email"
                                           :value="__('Email')"/>
                            <div class="mt-2">
                                <x-text-input id="email"
                                              class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                              type="email" name="email" :value="old('email')" required autofocus
                                              value="rick@example.com"
                                              autocomplete="username"/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="flex items-center justify-between">
                                <label for="password"
                                       class="block text-sm font-medium leading-6 text-gray-50">Password</label>
                                <div class="text-sm">

                                    @if (Route::has('password.request'))
                                        <a class="font-semibold text-gray-400 hover:text-indigo-500"
                                           href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2">

                                <x-text-input id="password"
                                              class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                              type="password"
                                              name="password"
                                              value="password"
                                              required autocomplete="current-password"/>

                                <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                            </div>
                        </div>

                        <div class="border-b border-white/10 pb-12 -mt-4"></div>

                        <div class="block mt-6">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                       class="rounded bg-gray-900 border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                       name="remember">
                                <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>



                        <div>
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button
                                    class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>
