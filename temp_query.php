<?php
require 'vendor/autoload.php';
require 'bootstrap/app.php';

\ = App\Models\Vehicle::first();
if (\) {
    echo 'Vehicle: ' . \->name . PHP_EOL;
    echo 'Thumbnail: ' . \->thumbnail . PHP_EOL;
    foreach(\->images as \) {
        echo 'Image: ' . \->image_path . PHP_EOL;
    }
} else {
    echo 'No vehicle found' . PHP_EOL;
}
