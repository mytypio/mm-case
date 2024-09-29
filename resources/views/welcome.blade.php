<x-guest-layout>

    <div class="isolate overflow-hidden bg-gray-900">
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
        <div class="mx-auto max-w-7xl px-6 pb-24 pt-10 sm:pb-32 lg:flex lg:px-8 lg:py-20">
            <div class="mx-auto max-w-2xl flex-shrink-0 lg:mx-0 lg:max-w-xl lg:pt-8">
                <img width="220" src="{{ asset('images/logo_only-text_wit@2x.png') }}"
                     alt="Meditation Moments">

                <h1 class="mt-20 text-5xl font-bold text-white">
                    Demo user application powered by Mixpanel
                </h1>
                <div class="mt-24 sm:mt-32 lg:mt-16">
                        <span class="rounded-full bg-indigo-500/10 px-3 py-1 text-sm font-semibold leading-6 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">
                            Build Time: 11h 35m
                        </span>
                        <span class="ml-2 rounded-full bg-indigo-500/10 px-3 py-1 text-sm font-semibold leading-6 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">
                            PHPUnit tests: 61 (93 assertions)
                        </span>
                        <span class="ml-2 inline-flex items-center space-x-2 text-sm font-medium leading-6 text-gray-300">
                            <span>Code coverage: 96.43%</span>
                            <span class="rounded-full bg-green-500 w-3 h-3"></span>
                        </span>
                </div>
                <p class="mt-10 text-lg leading-8 text-gray-300">
                    Just a simple demo application where you can login, register and change your profile.
                    All events are synchronized with the database and a Mixpanel API.
                </p>

                <p class="mt-6 text-lg leading-8 text-gray-300">
                    You can login with the following credentials: <br />
                    <strong>rick@example.com</strong>/<strong>password</strong> or create a new account to test the registration process.
                </p>
                <div class="mt-10 flex items-center gap-x-6">
                    <a href="{{ route('register') }}"
                       class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">
                        Create account
                    </a>
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-white">or login <span
                            aria-hidden="true">→</span></a>
                </div>
            </div>
            <div class="mx-auto flex">
                <div class="max-w-3xl flex-none">
                    <img src="{{ asset('images/MtDS95gw.png') }}" alt="App screenshot" width="100"
                         class="w-[76rem] rounded-md">
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
