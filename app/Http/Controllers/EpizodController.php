<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Epizod;
use Validator;
use Image;
class EpizodController extends Controller
{
    public function store(Request $request)
    {
		$request->validate([
	        'logo' => 'required|image',
	        'desc' => 'required',
	        'name' => 'required|string|max:255',
	        'release' => 'required|date',
	        'sezon_id'	=>	'required|integer'
    	]);
    	$filename = sha1(uniqid()).'.'.$request->file('logo')->getClientOriginalExtension();
        $img = Image::make($request->file('logo'));
        $img->resize(null, 300, function ($constraint) {
            $constraint->aspectRatio();
        });
        $path = '/img/epizod/'.$filename;
        $img->save(public_path($path));
    	$epizod = Epizod::create([
    		'logo_path'	=>	$path,
    		'desc'		=>	$request->get('desc'),
    		'name'		=>	$request->get('name'),
    		'release'	=>	$request->get('release'),
    		'sezon_id'	=>	$request->get('sezon_id')
    	]);
    	return response()->json($epizod,200);
    }
    public function getEpizod($id)
    {
        try {
            $epizod = Epizod::find($id);
            return response()->json($epizod,200);
        } catch (Throwable $e) {
            return response()->json("Bad request",400);
        }
    }
}
