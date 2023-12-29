<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Sector;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/sectors/all', function (Request $request) {
    $parentId = null; // Assuming the top-level categories have a null parent_id
    $hierarchy = Sector::getHierarchy($parentId);
    return $hierarchy;
});
