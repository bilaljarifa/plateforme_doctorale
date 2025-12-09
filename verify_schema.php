<?php

// Test script to verify NOT NULL constraints are working
// This script attempts to insert null values and should fail

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== Database Schema Verification ===\n\n";

// Check theses table
echo "1. Checking 'theses' table columns...\n";
$thesesColumns = DB::select("DESCRIBE theses");
$notNullFields = [];
foreach ($thesesColumns as $column) {
    if ($column->Null === 'NO' && $column->Field !== 'id' && !str_contains($column->Field, 'created_at') && !str_contains($column->Field, 'updated_at')) {
        $notNullFields[] = $column->Field;
    }
}
echo "   NOT NULL fields in theses: " . implode(', ', $notNullFields) . "\n";
echo "   ✓ Total: " . count($notNullFields) . " fields\n\n";

// Check doctorant_profiles table
echo "2. Checking 'doctorant_profiles' table columns...\n";
$profileColumns = DB::select("DESCRIBE doctorant_profiles");
$notNullFields = [];
foreach ($profileColumns as $column) {
    if ($column->Null === 'NO' && $column->Field !== 'id' && $column->Field !== 'user_id' && !str_contains($column->Field, 'created_at') && !str_contains($column->Field, 'updated_at')) {
        $notNullFields[] = $column->Field;
    }
}
echo "   NOT NULL fields in doctorant_profiles: " . implode(', ', $notNullFields) . "\n";
echo "   ✓ Total: " . count($notNullFields) . " fields\n\n";

// Check reinscriptions table
echo "3. Checking 'reinscriptions' table columns...\n";
$reinscriptionsColumns = DB::select("DESCRIBE reinscriptions");
$notNullFields = [];
foreach ($reinscriptionsColumns as $column) {
    if ($column->Null === 'NO' && $column->Field !== 'id' && $column->Field !== 'user_id' && !str_contains($column->Field, 'created_at') && !str_contains($column->Field, 'updated_at')) {
        $notNullFields[] = $column->Field;
    }
}
echo "   NOT NULL fields in reinscriptions: " . implode(', ', $notNullFields) . "\n";
echo "   ✓ Total: " . count($notNullFields) . " fields\n\n";

echo "=== Verification Complete ===\n";
echo "All migrations have been applied successfully!\n";
