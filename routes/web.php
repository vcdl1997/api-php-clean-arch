<?php

use Illuminate\Support\Facades\Route;

Route::get('/api/documentation', function () {
    $documentation = config('l5-swagger.defaults.default_documentation', 'default');
    $urlToDocs = url('api/api-docs');
    $useAbsolutePath = true;


    return view('vendor.l5-swagger.index', compact('documentation', 'urlToDocs', 'useAbsolutePath'));
});

Route::get('api/api-docs', function () {
    return response()->file(storage_path('api-docs/api-docs.json'));
});
