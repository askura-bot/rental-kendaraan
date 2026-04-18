<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb & Back Button -->
            <div class="mb-6 flex items-center justify-between">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <a href="{{ route('catalog') }}" class="hover:text-blue-600 dark:hover:text-blue-400">{{ __('Catalog') }}</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900 dark:text-white font-semibold">{{ $vehicle->name }}</span>
                </div>
                <a href="{{ route('catalog') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 dark:bg-gray-600 dark:hover:bg-gray-500 transition font-medium text-sm">
                    {{ __('← Back to Catalog') }}
                </a>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Images & Info -->
                <div class="lg:col-span-2">
                    <!-- Gallery -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-6">
                        <!-- Main Image -->
                        <div class="relative bg-gray-200 dark:bg-gray-700 h-96">
                            @if($vehicle->thumbnail)
                                <img
                                    id="mainImage"
                                    src="{{ asset('storage/' . $vehicle->thumbnail) }}"
                                    alt="{{ $vehicle->name }}"
                                    class="w-full h-full object-cover cursor-pointer"
                                    onclick="openImageModal('{{ asset('storage/' . $vehicle->thumbnail) }}')"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-green-500 text-white px-4 py-2 rounded-full font-semibold">
                                {{ __('Available') }}
                            </div>
                        </div>

                        <!-- Thumbnail Gallery -->
                        @if($vehicle->images->count())
                            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                                    <!-- Thumbnail -->
                                    @if($vehicle->thumbnail)
                                        <div
                                            class="relative h-20 rounded cursor-pointer border-2 border-blue-500"
                                            onclick="changeMainImage('{{ asset('storage/' . $vehicle->thumbnail) }}')"
                                        >
                                            <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="Thumbnail" class="w-full h-full object-cover rounded">
                                        </div>
                                    @endif

                                    <!-- Gallery Images -->
                                    @foreach($vehicle->images as $image)
                                        <div
                                            class="relative h-20 rounded cursor-pointer border-2 border-gray-300 dark:border-gray-600 hover:border-blue-500 transition"
                                            onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')"
                                        >
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery" class="w-full h-full object-cover rounded">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Vehicle Specifications -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Specifications') }}</h2>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <!-- Brand -->
                            <div class="border-l-4 border-blue-500 pl-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ __('Brand') }}</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $vehicle->brand }}</p>
                            </div>

                            <!-- Year -->
                            <div class="border-l-4 border-green-500 pl-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ __('Year') }}</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $vehicle->year }}</p>
                            </div>

                            <!-- Category -->
                            <div class="border-l-4 border-purple-500 pl-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ __('Category') }}</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $vehicle->category->name }}</p>
                            </div>

                            <!-- Engine -->
                            <div class="border-l-4 border-red-500 pl-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ __('Engine (CC)') }}</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($vehicle->cc) }}</p>
                            </div>

                            <!-- Capacity -->
                            <div class="border-l-4 border-yellow-500 pl-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ __('Passenger Capacity') }}</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $vehicle->capacity }} {{ __('seats') }}</p>
                            </div>

                            <!-- Transmission -->
                            <div class="border-l-4 border-indigo-500 pl-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ __('Transmission') }}</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">{{ ucfirst($vehicle->transmission) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($vehicle->description)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Description') }}</h2>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                                {{ $vehicle->description }}
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Booking & Pricing -->
                <div class="lg:col-span-1">
                    <!-- Pricing Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6 sticky top-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Rental Price') }}</h2>

                        <!-- 12 Hour Price -->
                        <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">{{ __('12 Hours') }}</span>
                                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                                    Rp {{ number_format($vehicle->price_12h) }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('per rental') }}</p>
                        </div>

                        <!-- 24 Hour Price -->
                        <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">{{ __('24 Hours') }}</span>
                                <span class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                    Rp {{ number_format($vehicle->price_24h) }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('per rental') }}</p>
                        </div>

                        <!-- WhatsApp Booking Button -->
                        <a
                            href="{{ $whatsappUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg transition mb-3"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.173 0-5.538 1.672-5.538 3.745 0 1.584.924 2.863 2.467 3.457-.113.636-.72 3.471-1.338 5.746-.167.495-.295.991-.295 1.458 0 .628.231 1.122.693 1.122.585 0 1.463-.455 3.432-3.483.512.294 1.338.456 2.579.456 3.173 0 5.538-1.672 5.538-3.745 0-2.069-2.365-3.755-5.538-3.755zm0 5.905c-.666 0-1.194-.51-1.194-1.16 0-.65.528-1.158 1.194-1.158.666 0 1.193.508 1.193 1.158 0 .65-.527 1.16-1.193 1.16z"/>
                                <path d="M.461 11.456l1.733 5.195A5.01 5.01 0 005 21.257c2.393 0 4.617-.98 6.189-2.568l5.736 5.736c.396.396 1.04.396 1.435 0 .396-.396.396-1.04 0-1.435L13.36 17.254c2.022-1.46 3.37-3.8 3.37-6.49C16.73 6.235 13.495 3 9.365 3 5.236 3 2 6.235 2 10.365c0 .524.052 1.033.138 1.528L.461 10.59c-.396-.396-1.04-.396-1.435 0-.396.396-.396 1.04 0 1.435z" fill-rule="evenodd" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Book via WhatsApp') }}
                        </a>

                        <!-- Info Box -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-3">
                            <p class="text-sm text-blue-900 dark:text-blue-200">
                                ℹ️ {{ __('Click the button above to start a conversation with us on WhatsApp. A template message has been prepared for your convenience.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-4">
                        <h3 class="font-bold text-amber-900 dark:text-amber-200 mb-2">⚠️ {{ __('Before Booking') }}</h3>
                        <ul class="text-sm text-amber-800 dark:text-amber-300 space-y-1">
                            <li>✓ {{ __('Have your ID ready') }}</li>
                            <li>✓ {{ __('Bring a valid driving license') }}</li>
                            <li>✓ {{ __('Prepare security deposit') }}</li>
                            <li>✓ {{ __('Check terms & conditions') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Related Vehicles -->
            @if($relatedVehicles->count())
                <div class="mt-12 pt-12 border-t border-gray-200 dark:border-gray-700">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                        {{ __('Related Vehicles') }}
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedVehicles as $related)
                            <a href="{{ route('vehicle-detail', $related->id) }}" class="group">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl dark:hover:shadow-lg transition overflow-hidden h-full flex flex-col">
                                    <!-- Image -->
                                    <div class="relative overflow-hidden bg-gray-200 dark:bg-gray-700 h-40">
                                        @if($related->thumbnail)
                                            <img
                                                src="{{ asset('storage/' . $related->thumbnail) }}"
                                                alt="{{ $related->name }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                                            >
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="p-3 flex-1 flex flex-col">
                                        <h3 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                            {{ $related->name }}
                                        </h3>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">
                                            {{ $related->brand }} • {{ $related->year }}
                                        </p>
                                        <div class="border-t border-gray-200 dark:border-gray-700 pt-2 mt-auto">
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs text-gray-500">24h</span>
                                                <span class="font-bold text-blue-600 dark:text-blue-400">
                                                    Rp {{ number_format($related->price_24h) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="hidden fixed inset-0 bg-black/75 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
        <div class="relative max-w-4xl w-full bg-white dark:bg-gray-900 rounded-lg" onclick="event.stopPropagation()">
            <button type="button" class="absolute top-2 right-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 z-10" onclick="closeImageModal()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Full size image" class="w-full h-auto rounded-lg max-h-96 object-contain">
        </div>
    </div>

    <script>
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
        }

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
