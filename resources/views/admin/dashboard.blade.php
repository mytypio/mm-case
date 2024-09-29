<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
            Hi {{ auth()->user()->getFirstName() }}!
        </h1>
    </x-slot>

    <div>
        <h3 class="text-base font-semibold leading-6 text-gray-900">Statistics</h3>
        <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow md:grid-cols-3 md:divide-x md:divide-y-0">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">New users</dt>
                <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                    <div class="flex items-baseline text-2xl font-semibold text-green-600">
                        {{ $newUsers }}
                        <span class="ml-2 text-sm font-medium text-gray-500">since yesterday</span>
                    </div>
                </dd>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">Total Users</dt>
                <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                        {{ $totalUsers  }}
                    </div>
                </dd>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">Out of Sync</dt>
                <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                    <div class="flex items-baseline text-2xl font-semibold text-red-600">

                        @if ($outOfSyncUsers > 0)
                            {{ $outOfSyncUsers  }}
                            <span class="ml-2 text-sm font-medium text-gray-500">van {{ $totalUsers }}</span>
                        @else
                            <span class="text-sm font-medium text-gray-500 mt-2">No users out of sync 🎉</span>
                        @endif
                    </div>
                </dd>
            </div>
        </dl>
    </div>

    <div class="mt-10 pt-4 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow ">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Latest users</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the users who recently registered </p>
                </div>
                <div class="mt-5 sm:mt-0 sm:ml-4">
                    <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
                        View all
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-8 flow-root overflow-hidden">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <table class="w-full text-left">
                    <thead class="bg-white">
                    <tr>
                        <th scope="col" class="relative isolate py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                            Name
                            <div class="absolute inset-y-0 right-full -z-10 w-screen border-b border-b-gray-200"></div>
                            <div class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-b-gray-200"></div>
                        </th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                            Updated At
                        </th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 md:table-cell">
                            Last Synced At
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Status
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Role
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)

                        <tr>
                            <td class="relative py-4 pr-3 text-sm font-medium text-gray-900">
                                {{ $user->getName() }}
                                <div class="text-sm leading-5 text-gray-500">{{ $user->getEmail() }}</div>
                                <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                            </td>
                            <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ $user->getUpdatedAt() }}</td>
                            <td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">
                                {{ $user->getLastSyncedAt() }}
                                @if ($user->isInSync())
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 rounded-full bg-green-50 text-green-800">
                                        IN SYNC
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 rounded-full bg-red-100  text-red-800">
                                            OUT OF SYNC
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500">

                                @if ($user->getStatus()->value === \App\Enum\UserStatus::ACTIVE->value)

                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $user->getStatus()->value }}
                                    </span>

                                @else

                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $user->getStatus()->value }}
                                    </span>
                                @endif

                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500">
                                {{ $user->getRole() }}
                            </td>
                            <td class="relative py-4 pl-3 text-right text-sm font-medium">
                                <a href="{{ route('user.view', ['id' => $user->getId() ]) }}" class="text-indigo-600 hover:text-indigo-900">View<span class="sr-only">, Lindsay Walton</span></a>
                            </td>
                        </tr>

                    @endforeach

                    <!-- More people... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</x-app-layout>
