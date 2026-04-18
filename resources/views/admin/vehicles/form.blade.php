<div class="space-y-6">
    <!-- Category -->
    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ __('Category') }} <span class="text-red-500">*</span>
        </label>
        <select
            id="category_id"
            name="category_id"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="">{{ __('Select a category') }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $vehicle->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <!-- Vehicle Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ __('Vehicle Name') }} <span class="text-red-500">*</span>
        </label>
        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name', $vehicle->name ?? '') }}"
            required
            placeholder="{{ __('e.g., Toyota Avanza 2023') }}"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
        @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Brand -->
        <div>
            <label for="brand" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Brand') }} <span class="text-red-500">*</span>
            </label>
            <input
                id="brand"
                type="text"
                name="brand"
                value="{{ old('brand', $vehicle->brand ?? '') }}"
                required
                placeholder="{{ __('e.g., Toyota') }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            @error('brand')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Year -->
        <div>
            <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Year') }} <span class="text-red-500">*</span>
            </label>
            <input
                id="year"
                type="number"
                name="year"
                value="{{ old('year', $vehicle->year ?? '') }}"
                required
                min="1900"
                max="{{ date('Y') + 1 }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            @error('year')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- CC -->
        <div>
            <label for="cc" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Engine (CC)') }} <span class="text-red-500">*</span>
            </label>
            <input
                id="cc"
                type="number"
                name="cc"
                value="{{ old('cc', $vehicle->cc ?? '') }}"
                required
                min="100"
                placeholder="1500"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            @error('cc')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Capacity -->
        <div>
            <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Passenger Capacity') }} <span class="text-red-500">*</span>
            </label>
            <input
                id="capacity"
                type="number"
                name="capacity"
                value="{{ old('capacity', $vehicle->capacity ?? '') }}"
                required
                min="1"
                max="20"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            @error('capacity')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Transmission -->
        <div>
            <label for="transmission" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Transmission') }} <span class="text-red-500">*</span>
            </label>
            <select
                id="transmission"
                name="transmission"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">{{ __('Select') }}</option>
                <option value="manual" {{ old('transmission', $vehicle->transmission ?? '') == 'manual' ? 'selected' : '' }}>{{ __('Manual') }}</option>
                <option value="automatic" {{ old('transmission', $vehicle->transmission ?? '') == 'automatic' ? 'selected' : '' }}>{{ __('Automatic') }}</option>
            </select>
            @error('transmission')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Price 12h -->
        <div>
            <label for="price_12h" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Price - 12 Hours') }} <span class="text-red-500">*</span>
            </label>
            <input
                id="price_12h"
                type="number"
                name="price_12h"
                value="{{ old('price_12h', $vehicle->price_12h ?? '') }}"
                required
                min="0"
                step="0.01"
                placeholder="150000"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            @error('price_12h')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Price 24h -->
        <div>
            <label for="price_24h" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Price - 24 Hours') }} <span class="text-red-500">*</span>
            </label>
            <input
                id="price_24h"
                type="number"
                name="price_24h"
                value="{{ old('price_24h', $vehicle->price_24h ?? '') }}"
                required
                min="0"
                step="0.01"
                placeholder="250000"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            @error('price_24h')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Status') }} <span class="text-red-500">*</span>
            </label>
            <select
                id="status"
                name="status"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">{{ __('Select status') }}</option>
                <option value="available" {{ old('status', $vehicle->status ?? 'available') == 'available' ? 'selected' : '' }}>{{ __('Available') }}</option>
                <option value="rented" {{ old('status', $vehicle->status ?? 'available') == 'rented' ? 'selected' : '' }}>{{ __('Rented') }}</option>
                <option value="maintenance" {{ old('status', $vehicle->status ?? 'available') == 'maintenance' ? 'selected' : '' }}>{{ __('Maintenance') }}</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ __('Description') }}
        </label>
        <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="{{ __('Enter vehicle description...') }}"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >{{ old('description', $vehicle->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <!-- Thumbnail Image -->
    <div>
        <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ __('Thumbnail Image') }}
        </label>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 dark:hover:border-blue-400 transition" onclick="document.getElementById('thumbnail').click()">
            @if(isset($vehicle) && $vehicle->thumbnail)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="Thumbnail" class="mx-auto h-32 w-32 object-cover rounded">
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Click to change') }}</p>
                </div>
            @else
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-18-8l6 6m0 0l-6 6m6-6H6m18-6v12m6 6v-2a6 6 0 10-12 0v2m6 6h-2m2 0h2"></path>
                </svg>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Click to upload thumbnail image') }}</p>
            @endif
        </div>
        <input
            id="thumbnail"
            type="file"
            name="thumbnail"
            accept="image/*"
            class="hidden"
        >
        @error('thumbnail')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <!-- Gallery Images -->
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ __('Gallery Images (up to 10 images)') }}
        </label>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 dark:hover:border-blue-400 transition" onclick="document.getElementById('images').click()">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-18-8l6 6m0 0l-6 6m6-6H6m18-6v12m6 6v-2a6 6 0 10-12 0v2m6 6h-2m2 0h2"></path>
            </svg>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Click or drag images to upload') }}</p>
        </div>
        <input
            id="images"
            type="file"
            name="images[]"
            accept="image/*"
            multiple
            class="hidden"
        >
        @error('images')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

        <!-- Image Previews -->
        <div id="imagePreviewContainer" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            <!-- New image previews will appear here -->
        </div>

        <!-- Existing Images (for edit view) -->
        @if(isset($vehicle) && $vehicle->images->count())
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ __('Current Images') }}</p>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach($vehicle->images as $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery" class="w-full h-24 object-cover rounded">
                            <button type="button" class="delete-image-btn absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center rounded" data-image-id="{{ $image->id }}" data-route="{{ route('admin.vehicle-images.destroy', $image) }}" onclick="deleteImage(event, this)">
                                <span class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    {{ __('Delete') }}
                                </span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Submit Button -->
    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.vehicles.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            {{ __('Cancel') }}
        </a>
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 transition">
            {{ __('Save Vehicle') }}
        </button>
    </div>
</div>

<!-- Image Compression Library -->
<script src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.2/dist/browser-image-compression.js"></script>

<script>
    // Configuration for image compression
    const compressionConfig = {
        maxSizeMB: 1,              // Max file size: 1MB
        maxWidthOrHeight: 1920,    // Max dimension: 1920px
        useWebWorker: true,        // Use web worker for better performance
        quality: 0.8               // Quality level (0-1)
    };

    /**
     * Format file size for display
     */
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    /**
     * Compress a single image file
     */
    async function compressImage(file) {
        try {
            const compressed = await imageCompression(file, compressionConfig);
            return compressed;
        } catch (error) {
            console.error('Compression error:', error);
            return file; // Return original if compression fails
        }
    }

    /**
     * Handle thumbnail image upload with compression
     */
    document.getElementById('thumbnail').addEventListener('change', async function(e) {
        const input = this;
        const file = input.files[0];

        if (!file) return;

        const originalSize = file.size;
        const originalSizeStr = formatFileSize(originalSize);

        // Show loading state
        const preview = document.querySelector('[onclick="document.getElementById(\'thumbnail\').click()"]');
        preview.innerHTML = `
            <div class="mb-4">
                <div class="mx-auto h-12 w-12 flex items-center justify-center">
                    <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Compressing image...') }}</p>
            </div>
        `;

        try {
            const compressed = await compressImage(file);
            const compressedSize = compressed.size;
            const compressedSizeStr = formatFileSize(compressedSize);
            const compressionRatio = Math.round((1 - compressedSize / originalSize) * 100);

            // Create a new DataTransfer to replace the file
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(compressed);
            input.files = dataTransfer.files;

            // Show preview with compression info
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div class="mb-4">
                        <img src="${e.target.result}" alt="Thumbnail" class="mx-auto h-32 w-32 object-cover rounded">
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Click to change') }}</p>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400 space-y-1">
                            <p>📦 {{ __('Original') }}: ${originalSizeStr}</p>
                            <p>✅ {{ __('Compressed') }}: ${compressedSizeStr}</p>
                            <p>📉 {{ __('Reduced') }}: ${compressionRatio}%</p>
                        </div>
                    </div>
                `;
            };
            reader.readAsDataURL(compressed);
        } catch (error) {
            console.error('Thumbnail compression error:', error);
            previewThumbnail(this);
        }
    });

    /**
     * Handle gallery images upload with compression
     */
    document.getElementById('images').addEventListener('change', async function(e) {
        const input = this;
        const files = Array.from(input.files || []);

        if (files.length === 0) return;

        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        // Show loading state
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'col-span-full text-center py-4';
        loadingDiv.innerHTML = `
            <svg class="animate-spin h-8 w-8 text-blue-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Compressing images...') }}</p>
        `;
        container.appendChild(loadingDiv);

        try {
            const compressedFiles = [];
            let totalOriginal = 0;
            let totalCompressed = 0;

            // Compress each file
            for (let i = 0; i < Math.min(files.length, 10); i++) {
                const file = files[i];
                totalOriginal += file.size;
                const compressed = await compressImage(file);
                totalCompressed += compressed.size;
                compressedFiles.push(compressed);
            }

            // Create a new DataTransfer with compressed files
            const dataTransfer = new DataTransfer();
            compressedFiles.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;

            // Display previews
            container.innerHTML = '';
            const totalRatio = Math.round((1 - totalCompressed / totalOriginal) * 100);

            // Stats header
            const statsDiv = document.createElement('div');
            statsDiv.className = 'col-span-full bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-700 rounded p-3 text-sm text-blue-800 dark:text-blue-200';
            statsDiv.innerHTML = `
                <p class="font-semibold mb-2">{{ __('Compression Summary') }}</p>
                <div class="grid grid-cols-3 gap-2 text-xs">
                    <div>📦 {{ __('Original') }}: ${formatFileSize(totalOriginal)}</div>
                    <div>✅ {{ __('Compressed') }}: ${formatFileSize(totalCompressed)}</div>
                    <div>📉 {{ __('Reduced') }}: ${totalRatio}%</div>
                </div>
            `;
            container.appendChild(statsDiv);

            // Image previews
            compressedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index}" class="w-full h-24 object-cover rounded">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center rounded">
                            <span class="text-white text-xs">{{ __('File') }} ${index + 1}</span>
                        </div>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        } catch (error) {
            console.error('Gallery compression error:', error);
            previewGalleryImages(this);
        }
    });

    /**
     * Fallback preview function (called if file wasn't changed through event)
     */
    function previewThumbnail(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.querySelector('[onclick="document.getElementById(\'thumbnail\').click()"]');
                preview.innerHTML = `
                    <div class="mb-4">
                        <img src="${e.target.result}" alt="Thumbnail" class="mx-auto h-32 w-32 object-cover rounded">
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Click to change') }}</p>
                    </div>
                `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    /**
     * Fallback gallery preview function (called if files weren't changed through event)
     */
    function previewGalleryImages(input) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        if (input.files) {
            const files = Array.from(input.files);
            files.slice(0, 10).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index}" class="w-full h-24 object-cover rounded">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center rounded">
                            <span class="text-white text-xs">{{ __('File') }} ${index + 1}</span>
                        </div>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    /**
     * Delete an image via AJAX (prevents nested form issues)
     */
    function deleteImage(event, button) {
        event.preventDefault();
        
        if (!confirm('{{ __('Delete this image?') }}')) {
            return;
        }

        const imageId = button.getAttribute('data-image-id');
        const route = button.getAttribute('data-route');
        
        // Send DELETE request via fetch API
        fetch(route, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Failed to delete image');
            // Remove the image element from DOM
            button.closest('.relative').remove();
            // Show success message
            console.log('Image deleted successfully');
        })
        .catch(error => {
            console.error('Error deleting image:', error);
            alert('{{ __('Failed to delete image') }}');
        });
    }
</script>
