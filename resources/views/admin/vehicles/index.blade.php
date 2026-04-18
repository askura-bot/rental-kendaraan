<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('Vehicle Management') }}
            </h2>
            <a href="{{ route('admin.vehicles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 transition">
                {{ __('+ Add Vehicle') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            

            <!-- Search & Filters -->
            <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <form method="GET" action="{{ route('admin.vehicles.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Search') }}
                        </label>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="{{ __('Vehicle name or brand...') }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Category') }}
                        </label>
                        <select name="category" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Status') }}
                        </label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">{{ __('All Status') }}</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>{{ __('Available') }}</option>
                            <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>{{ __('Rented') }}</option>
                            <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>{{ __('Maintenance') }}</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 transition">
                            {{ __('Filter') }}
                        </button>
                        <a href="{{ route('admin.vehicles.index') }}" class="flex-1 px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 dark:bg-gray-600 dark:hover:bg-gray-500 transition text-center">
                            {{ __('Reset') }}
                        </a>
                    </div>
                </form>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 rounded-lg text-green-800 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Vehicles Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                @if($vehicles->count())
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Vehicle') }}</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Category') }}</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Price (12h / 24h)') }}</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Images') }}</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($vehicles as $vehicle)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @if($vehicle->thumbnail)
                                                    <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="{{ $vehicle->name }}" class="w-10 h-10 rounded object-cover">
                                                @else
                                                    <div class="w-10 h-10 rounded bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                        <span class="text-xs text-gray-500">No image</span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="font-medium text-gray-900 dark:text-white">{{ $vehicle->name }}</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $vehicle->brand }} • {{ $vehicle->year }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                            {{ $vehicle->category->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                            Rp {{ number_format($vehicle->price_12h) }} / Rp {{ number_format($vehicle->price_24h) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <select
                                                    class="vehicle-status-select px-3 py-1 text-sm rounded border {{ $vehicle->status === 'available' ? 'bg-green-50 dark:bg-green-900 border-green-300 dark:border-green-700 text-green-800 dark:text-green-200' : ($vehicle->status === 'rented' ? 'bg-blue-50 dark:bg-blue-900 border-blue-300 dark:border-blue-700 text-blue-800 dark:text-blue-200' : 'bg-yellow-50 dark:bg-yellow-900 border-yellow-300 dark:border-yellow-700 text-yellow-800 dark:text-yellow-200') }} dark:bg-opacity-20"
                                                    data-vehicle-id="{{ $vehicle->id }}"
                                                    data-endpoint="{{ route('admin.vehicles.update-status', $vehicle) }}"
                                                >
                                                    <option value="available" {{ $vehicle->status === 'available' ? 'selected' : '' }}>{{ __('Available') }}</option>
                                                    <option value="rented" {{ $vehicle->status === 'rented' ? 'selected' : '' }}>{{ __('Rented') }}</option>
                                                    <option value="maintenance" {{ $vehicle->status === 'maintenance' ? 'selected' : '' }}>{{ __('Maintenance') }}</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                            <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-xs">
                                                {{ $vehicle->images->count() }} {{ __('images') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.vehicles.show', $vehicle) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ __('View') }}</a>
                                                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-green-600 dark:text-green-400 hover:underline">{{ __('Edit') }}</a>
                                                <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" class="inline" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">{{ __('Delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4">
                        {{ $vehicles->links() }}
                    </div>
                @else
                    <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                        {{ __('No vehicles found.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const statusSelects = document.querySelectorAll('.vehicle-status-select');

                statusSelects.forEach(select => {
                    select.addEventListener('change', async function() {
                        const vehicleId = this.dataset.vehicleId;
                        const endpoint = this.dataset.endpoint;
                        const newStatus = this.value;

                        try {
                            const response = await fetch(endpoint, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ status: newStatus })
                            });

                            if (!response.ok) throw new Error('Network response was not ok');

                            const data = await response.json();

                            if (data.success) {
                                // Update UI with success feedback
                                const row = this.closest('tr');
                                const statusCell = row.querySelector('td:nth-child(4)');

                                // Show success toast (optional)
                                console.log(data.message);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('{{ __('Failed to update status') }}');
                            // Revert select to previous value
                            this.value = this.dataset.previousStatus || this.value;
                        }
                    });

                    // Store previous status for potential revert
                    select.addEventListener('click', function() {
                        this.dataset.previousStatus = this.value;
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
