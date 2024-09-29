<x-app-layout>
    <div class="bg-white p-6 shadow-lg">
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">
                {{ $user->getName() }}
                @if ($user->getStatus()->value === \App\Enum\UserStatus::ACTIVE->value)
                    <span
                        class="px-2  float-right inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        {{ $user->getStatus()->value }}
                    </span>
                @else
                    <span
                        class="px-2 float-right inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        {{ $user->getStatus()->value }}
                    </span>
                @endif
            </h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{ $user->getEmail() }}</p>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Firstname</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->getFirstName() }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Lastname</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->getLastName() }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Role</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->getRole() }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->getEmail() }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Storage
                        <span class="text-gray-400 text-xs block">
                            Last synced at: {{ $user->getLastSyncedAt() }}
                        </span>
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 ">

                        {{ strtoupper($user->getUserStorageType()->value) }}

                        @if ($user->isInSync())
                            <span class="px-2 inline-flex text-xs leading-5 rounded-full bg-green-50 text-green-800 font-semibold">
                                IN SYNC
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 rounded-full bg-red-100 text-red font-semibold">
                                OUT OF SYNC
                            </span>
                        @endif

                    </dd>
                </div>
            </dl>
        </div>

    </div>

    @if ($user->getStatus()->value === \App\Enum\UserStatus::INACTIVE->value)

        <div class="bg-white p-6 shadow-lg mt-10">
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dd class="mt-1 text-sm leading-6 text-gray-500 sm:col-span-2 sm:mt-0">
                <h2 class="font-semibold text-gray-700 text-xl mb-4">
                    User Activation
                </h2>
                <strong>
                    Note:
                </strong>
                This user is currently inactive. Activate this user to allow them to login.
            </dd>
            <dt class="text-sm font-medium leading-6 text-gray-900">

                <form method="POST" action="{{ route('user.activate', $user->id) }}" class="float-right">
                    @csrf
                    <button type="submit" class="py-4 px-10 inline-flex font-semibold rounded-md bg-gray-50 shadow text-gray-800">
                        Activate User
                    </button>
                </form>


            </dt>
        </div>
        </div>
    @endif


    @if (!$user->IsInSync())

        <div class="bg-white p-6 shadow-lg mt-10">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dd class="mt-1 text-sm leading-6 text-gray-500 sm:col-span-2 sm:mt-0">
                    <h2 class="font-semibold text-gray-700 text-xl mb-4">
                        Synchronize User
                    </h2>
                    <strong>
                        Note:
                    </strong>
                    This user is currently out of sync. Synchronize this user to update their storage.
                </dd>
                <dt class="text-sm font-medium leading-6 text-gray-900">

                    <form method="POST" action="{{ route('user.sync', $user->id) }}" class="float-right">
                        @csrf
                        <button type="submit" class="py-4 px-10 inline-flex font-semibold rounded-md bg-gray-50 shadow text-gray-800">
                            Sync User
                        </button>
                    </form>


                </dt>
            </div>
        </div>
    @endif

</x-app-layout>
