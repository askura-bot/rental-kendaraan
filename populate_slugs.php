$vehicles = App\Models\Vehicle::all();
foreach ($vehicles as $v) {
    $v->slug = \Illuminate\Support\Str::slug($v->name);
    $v->save();
}
echo 'Done';
