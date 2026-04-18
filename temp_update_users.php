<?php
require 'vendor/autoload.php';
\ = require_once 'bootstrap/app.php';
\ = \->make('Illuminate\Contracts\Console\Kernel');
\->bootstrap();

use App\Models\User;

\ = User::all();
foreach (\ as \) {
    \->update(['role' => 'admin']);
}
echo 'All ' . count(\) . ' users updated to admin role';
