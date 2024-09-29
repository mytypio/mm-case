<x-guest-layout>
    <div class="isolate overflow-hidden bg-gray-900">
        <svg
            class="absolute inset-0 -z-10 h-full w-full stroke-white/10 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
            aria-hidden="true">
            <defs>
                <pattern id="983e3e4c-de6d-4c3f-8d64-b9761d1534cc" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                    <path d="M.5 200V.5H200" fill="none"/>
                </pattern>
            </defs>
            <svg x="50%" y="-1" class="overflow-visible fill-gray-800/20">
                <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z" stroke-width="0"/>
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


                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="space-y-4 mt-10">
                        <h1 class="mt-6 text-3xl font-bold leading-9 tracking-tight text-gray-100">Register</h1>
                        <h2 class="text-xl -mt-4 font-bold leading-9 tracking-tight text-gray-600">
                            Fill in this form to create an account for this demo application
                        </h2>
                        <div class="border-b border-white/10 pb-12">
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="firstName" class="block text-sm font-medium leading-6 text-white">
                                        First name
                                    </label>
                                    <div class="mt-2">
                                        <x-text-input id="firstName"
                                                      class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                                      type="text" name="firstName" :value="old('firstName')" required
                                                      autofocus autocomplete="name"/>
                                        <x-input-error :messages="$errors->get('firstName')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="last-name" class="block text-sm font-medium leading-6 text-white">
                                        Last name
                                    </label>
                                    <div class="mt-2">
                                        <x-text-input id="lastName"
                                                      class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                                      type="text" name="lastName" :value="old('lastName')" required
                                                      autofocus autocomplete="name"/>
                                        <x-input-error :messages="$errors->get('lastName')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="email" class="block text-sm font-medium leading-6 text-white">
                                        Email
                                    </label>
                                    <div class="mt-2">
                                        <x-text-input id="email"
                                                      class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                                      type="email" name="email" :value="old('email')" required
                                                      autocomplete="username"/>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                    </div>
                                </div>


                                <div class="sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium leading-6 text-white">
                                        Password
                                    </label>
                                    <div class="mt-2">
                                        <x-text-input id="password"
                                                      class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                                      type="password"
                                                      name="password"
                                                      required autocomplete="new-password"/>
                                        \
                                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium leading-6 text-white">
                                        Confirm password
                                    </label>
                                    <div class="mt-2">
                                        <x-text-input id="password_confirmation"
                                                      class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                                      type="password"
                                                      name="password_confirmation" required
                                                      autocomplete="new-password"/>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pb-12">
                            <p class="mt-1 text-sm leading-6 text-gray-400">
                                Be aware, all your information will be stored in the database and synced to Mixpanel and
                                will be used for demo purposes only.
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit"
                                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                            Create account
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>
