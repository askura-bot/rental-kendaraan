<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ __('Edit Vehicle') }}: {{ $vehicle->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <form method="POST" action="{{ route('admin.vehicles.update', $vehicle) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('admin.vehicles.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
