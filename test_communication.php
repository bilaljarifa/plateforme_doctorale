<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Check table structure
echo "=== Communications Table Structure ===\n";
$columns = DB::select("DESCRIBE communications");
foreach ($columns as $column) {
    echo "{$column->Field} - {$column->Type} - Null: {$column->Null} - Default: {$column->Default}\n";
}

echo "\n=== Current Communications Count ===\n";
$count = App\Models\Communication::count();
echo "Total: $count\n";

echo "\n=== Latest 3 Communications ===\n";
$latest = App\Models\Communication::latest()->take(3)->get();
foreach ($latest as $comm) {
    echo "ID: {$comm->id}, Titre: {$comm->titre}, Annee: {$comm->annee}, User: {$comm->user_id}\n";
}

echo "\n=== Testing Insert ===\n";
try {
    $test = new App\Models\Communication();
    $test->user_id = 1; // Assuming user 1 exists
    $test->titre = 'Test Communication';
    $test->annee = 2025;
    $test->save();
    echo "✓ Insert successful! ID: {$test->id}\n";
    
    // Clean up
    $test->delete();
    echo "✓ Test record deleted\n";
} catch (\Exception $e) {
    echo "✗ Insert failed: {$e->getMessage()}\n";
}
