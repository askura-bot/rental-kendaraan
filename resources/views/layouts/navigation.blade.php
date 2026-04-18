<!-- Show Admin Navigation when admin is logged in -->
@auth
    @if(Auth::user()->isAdmin())
        <x-admin-navigation />
    @endif
@else
    <!-- Show User Navigation for guests (not logged in) -->
    <x-user-navigation />
@endauth

