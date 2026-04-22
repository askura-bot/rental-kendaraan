<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-white">
                {{ __('Message Detail') }}
            </h2>
            <a
                href="{{ route('admin.messages.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-gray-800"
            >
                {{ __('← Back to Messages') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <!-- Header -->
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $contactMessage->subject }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Received on') }} {{ $contactMessage->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        @if($contactMessage->is_read)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                {{ __('Read') }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                {{ __('New') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Sender Info -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Name') }}</p>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $contactMessage->full_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Email') }}</p>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                <a href="mailto:{{ $contactMessage->email }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">{{ $contactMessage->email }}</a>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Phone') }}</p>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $contactMessage->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Subject') }}</p>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $contactMessage->subject }}</p>
                        </div>
                    </div>
                </div>

                <!-- Message Body -->
                <div class="px-6 py-6">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">{{ __('Message') }}</p>
                    <div class="prose prose-sm dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                        {!! nl2br(e($contactMessage->message)) !!}
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 flex items-center justify-between">
                    <a href="mailto:{{ $contactMessage->email }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150">
                        {{ __('Reply via Email') }}
                    </a>
                    <form
                        method="POST"
                        action="{{ route('admin.messages.destroy', $contactMessage) }}"
                        onsubmit="return confirm('{{ __('Are you sure you want to delete this message?') }}')"
                    >
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition ease-in-out duration-150"
                        >
                            {{ __('Delete Message') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
