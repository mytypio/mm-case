<x-app-layout>
    <div class="pt-4 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow ">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">User management</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the users </p>
                </div>
            </div>
        </div>
        <div class="mt-8 flow-root overflow-hidden">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <table class="min-w-full">
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
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 text-center">
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
                    <tbody class="bg-white">
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
                                        class="px-2 block text-xs leading-5 rounded-full bg-green-50 text-green-800">
                                        IN SYNC
                                    </span>
                                @else
                                    <span
                                        class="px-2 block text-xs leading-5 rounded-full bg-red-100  text-red-800">
                                            OUT OF SYNC
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 text-center">
                                @if ($user->getStatus()->value === \App\Enum\UserStatus::ACTIVE->value)

                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $user->getStatus()->value }}
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $user->getStatus()->value }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500">
                                {{ $user->getRole() }}
                            </td>
                            <td class="relative py-4 pl-3 text-right text-sm font-medium">
                                <a href="{{ route('user.view', ['id' => $user->getId() ]) }}" class="p-2 text-indigo-600 mr-10 hover:text-indigo-900">View</a>
                                <a href="{{ route('user.destroy', ['id' => $user->getId() ]) }}" class="p-2 text-red-600 hover:bg-red-500 hover:text-white">Delete</a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
