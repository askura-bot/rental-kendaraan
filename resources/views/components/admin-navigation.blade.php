<!-- Admin Navigation Component -->
<nav class="bg-gray-100 dark:bg-gray-900 border-b border-gray-300 dark:border-gray-700" x-data="{ adminMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <!-- Logo (Left) -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <!-- Admin Links + Account Dropdown (Right) -->
            <div class="hidden sm:flex items-center space-x-1">
                <!-- Admin Links (Vehicles, Categories) -->
                <a href="{{ route('admin.vehicles.index') }}" class="px-4 py-2 text-sm font-medium transition {{ request()->routeIs('admin.vehicles.*') ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600' : 'text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100' }}">
                    {{ __('Vehicles') }}
                </a>
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 text-sm font-medium transition {{ request()->routeIs('admin.categories.*') ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600' : 'text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100' }}">
                    {{ __('Categories') }}
                </a>
                <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 text-sm font-medium transition flex items-center gap-1.5 {{ request()->routeIs('admin.messages.*') ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600' : 'text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100' }}">
                    {{ __('Messages') }}
                    @php $unreadCount = \App\Models\ContactMessage::unread()->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-500 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.settings.contact') }}" class="px-4 py-2 text-sm font-medium transition {{ request()->routeIs('admin.settings.*') ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600' : 'text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100' }}">
                    {{ __('Settings') }}
                </a>

                <!-- Account Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="sm:hidden flex items-center">
                <button @click="adminMenuOpen = !adminMenuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="adminMenuOpen" class="sm:hidden bg-gray-50 dark:bg-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('admin.vehicles.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 text-sm font-medium">
                {{ __('Vehicles') }}
            </a>
            <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 text-sm font-medium">
                {{ __('Categories') }}
            </a>
            <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-1.5 px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 text-sm font-medium">
                {{ __('Messages') }}
                @if($unreadCount ?? (\App\Models\ContactMessage::unread()->count()) > 0)
                    <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-500 rounded-full">{{ $unreadCount ?? \App\Models\ContactMessage::unread()->count() }}</span>
                @endif
            </a>
            <a href="{{ route('admin.settings.contact') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 text-sm font-medium">
                {{ __('Settings') }}
            </a>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 text-sm font-medium">
                {{ __('Profile') }}
            </a>
            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 text-sm font-medium">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</nav>
