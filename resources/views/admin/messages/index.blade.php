<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-white">
                {{ __('Contact Messages') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if ($message = session('success'))
                <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800 dark:bg-gray-800 dark:text-green-400">
                    {{ $message }}
                </div>
            @endif

            <!-- Search Bar -->
            <div class="mb-6">
                <form method="GET" class="flex gap-2">
                    <input
                        type="text"
                        name="search"
                        placeholder="{{ __('Search by name, email, or subject...') }}"
                        value="{{ request('search') }}"
                        class="flex-1 rounded-lg border-gray-300 bg-white px-4 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                    />
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-gray-800"
                    >
                        {{ __('Search') }}
                    </button>
                    @if (request('search'))
                        <a
                            href="{{ route('admin.messages.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-gray-800"
                        >
                            {{ __('Reset') }}
                        </a>
                    @endif
                </form>
            </div>

            <!-- Messages Table -->
            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Sender') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Subject') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Status') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Date') }}
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($messages as $msg)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 {{ !$msg->is_read ? 'bg-blue-50/50 dark:bg-blue-900/10' : '' }}">
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    <div class="flex items-center gap-2">
                                        @unless($msg->is_read)
                                            <span class="inline-block w-2 h-2 rounded-full bg-blue-500 shrink-0"></span>
                                        @endunless
                                        <div>
                                            <strong>{{ $msg->full_name }}</strong>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $msg->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    {{ $msg->subject }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($msg->is_read)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                            {{ __('Read') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ __('New') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $msg->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <a
                                        href="{{ route('admin.messages.show', $msg) }}"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200 mr-4"
                                    >
                                        {{ __('View') }}
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('admin.messages.destroy', $msg) }}"
                                        style="display: inline;"
                                        onsubmit="return confirm('{{ __('Are you sure you want to delete this message?') }}')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200"
                                        >
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    <p class="text-sm">{{ __('No messages found.') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
