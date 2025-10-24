<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    $services = [
        'app' => true,
        'database' => true,
        'storage' => true,
        'cache' => true
    ];
    
    $errors = [];

    // Check database connection
    try {
        \DB::connection()->getPdo();
    } catch (\Exception $e) {
        $services['database'] = false;
        $errors[] = $e->getMessage();
    }

    // Check storage access
    try {
        \Storage::disk('public')->put('health-check.txt', 'Health check');
        \Storage::disk('public')->delete('health-check.txt');
    } catch (\Exception $e) {
        $services['storage'] = false;
        $errors[] = $e->getMessage();
    }

    // Check cache
    try {
        \Cache::set('health-check', 'test', 1);
        \Cache::get('health-check');
    } catch (\Exception $e) {
        $services['cache'] = false;
        $errors[] = $e->getMessage();
    }

    $status = array_reduce($services, function ($carry, $item) {
        return $carry && $item;
    }, true);

    return response()->json([
        'status' => $status ? 'healthy' : 'unhealthy',
        'services' => $services,
        'errors' => $errors,
        'timestamp' => now()->toIso8601String()
    ], $status ? 200 : 503);
});