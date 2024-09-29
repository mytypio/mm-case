<section>

    <form method="POST" action="{{ route('logout') }}" class="float-right">
        @csrf
        <button type="submit"
                class="group -mx-4 -my-4 flex gap-x-3 bg-gray-700 rounded-md px-2 text-sm font-semibold leading-6 text-gray-400 hover:bg-red-800 hover:text-white">
            Logout
        </button>
    </form>


    <header>
        <h2 class="text-xl font-semibold text-gray-50">
           My account
        </h2>
        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update this account, all changes are synced with Mixpanel ") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update', ['id' => $user->getId() ]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label class="text-white" for="first_name" :value="__('Firstname')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->getFirstName())" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label class="text-white" for="last_name" :value="__('Lastname')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->getLastName())" required autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label class="text-white" for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->getEmail())" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="float-right rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">
                Update account
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
