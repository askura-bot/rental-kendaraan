<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $vehicle->name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 dark:hover:bg-green-500 transition">
                    {{ __('Edit') }}
                </a>
                <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" class="inline" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-500 transition">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- Basic Info -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Thumbnail -->
                    <div>
                        @if($vehicle->thumbnail)
                            <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="{{ $vehicle->name }}" class="w-full h-80 object-cover rounded-lg">
                        @else
                            <div class="w-full h-80 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400">{{ __('No thumbnail') }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Details -->
                    <div class="space-y-4">
                        <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('Basic Information') }}</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Category') }}</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $vehicle->category->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Brand') }}</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $vehicle->brand }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Year') }}</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $vehicle->year }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Status') }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $vehicle->status === 'available' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : ($vehicle->status === 'rented' ? 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200' : 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200') }}">
                                        {{ ucfirst($vehicle->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Engine (CC)') }}</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ number_format($vehicle->cc) }} CC</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Capacity') }}</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $vehicle->capacity }} {{ __('passengers') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Transmission') }}</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ ucfirst($vehicle->transmission) }}</p>
                                </div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Pricing') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ __('12-Hour Rental') }}</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            Rp {{ number_format($vehicle->price_12h) }}
                        </p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ __('24-Hour Rental') }}</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            Rp {{ number_format($vehicle->price_24h) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($vehicle->description)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Description') }}</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $vehicle->description }}</p>
                </div>
            @endif

            <!-- Gallery -->
            @if($vehicle->images->count())
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        {{ __('Gallery') }} ({{ $vehicle->images->count() }} {{ __('images') }})
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($vehicle->images as $image)
                            <div class="relative group">
                                <img
                                    src="{{ asset('storage/' . $image->image_path) }}"
                                    alt="Gallery image"
                                    class="w-full h-40 object-cover rounded-lg cursor-pointer"
                                    onclick="openImageModal('{{ asset('storage/' . $image->image_path) }}')"
                                >
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition rounded-lg flex items-center justify-center gap-2">
                                    <button
                                        type="button"
                                        class="text-white hover:text-blue-300"
                                        onclick="openImageModal('{{ asset('storage/' . $image->image_path) }}')"
                                        title="{{ __('View') }}"
                                    >
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Metadata -->
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 mt-6">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    {{ __('Created') }}: {{ $vehicle->created_at->format('d M Y H:i') }} |
                    {{ __('Updated') }}: {{ $vehicle->updated_at->format('d M Y H:i') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="hidden fixed inset-0 bg-black/75 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
        <div class="relative max-w-4xl w-full bg-white dark:bg-gray-900 rounded-lg" onclick="event.stopPropagation()">
            <button type="button" class="absolute top-2 right-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200" onclick="closeImageModal()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Full size image" class="w-full h-auto rounded-lg">
        </div>
    </div>

    <script>
        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</x-app-layout>
