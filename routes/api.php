<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Sector;
use Illuminate\Support\Facades\Validator;
use App\Models\Record;

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


Route::post('/record/add', function (Request $request) {
    $rules = array(
        'name' => 'required',
        'selection' => 'required',
        'agree' => 'required'
    );

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json('Invalid Data', 421);
    }

    $length = count($request->selection);

    $record = Record::create([
        'name' => $request->name,
        'sector_id' => $request->selection[$length],
        'is_agreed' => $request->agree
    ]);
    $res = $request->all();
    $res['id'] = $record->id;
    return $res;
});


Route::post('/record/update', function (Request $request) {
    $rules = array(
        'id' => 'required',
        'name' => 'required',
        'selection' => 'required',
        'agree' => 'required'
    );

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json('Invalid Data', 421);
    }

    $length = count($request->selection);
    $record =  Record::find($request->id);
    $record->update([
        'name' => $request->name,
        'sector_id' => $request->selection[$length],
        'is_agreed' => $request->agree
    ]);
    $res = $request->all();
    return $res;
});
