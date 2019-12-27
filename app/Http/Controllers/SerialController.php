<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serial;
use Validator,Image;
class SerialController extends Controller
{
    public function store(Request $request)
    {
    	$request->validate([
	        'name' => 'required|string|max:255',
	        'logo' => 'required|image',
	        'desc' => 'required',
	        'start' => 'required|date',
    	]);
    	$filename = sha1(uniqid()).'.'.$request->file('logo')->getClientOriginalExtension();
        $img = Image::make($request->file('logo'));
        $img->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $path = '/img/serial/'.$filename;
        $img->save(public_path($path));
    	$serial = Serial::create([
    		'name'	=>	$request->get('name'),
    		'desc'	=>	$request->get('desc'),
    		'start'	=>	$request->get('start'),
    		'logo_path'	=>	$path,
    	]);

    	return response()->json($serial,200);

    }
    public function getSerials(){
        try {
            $serials = Serial::all();
            return response()->json($serials,200);
        } catch (Throwable $e) {
            return response()->json("Bad request",400);
        }
        
    }
    public function getSerial($id){
        $serial = Serial::find($id);
        if(isset($serial->sezons))
        {
            $sezons = $serial->sezons;
        } else {
            $sezons = null;
        }
        return response()->json([
            'serial' => $serial,
            'sezons' => $sezons,
        ],200);
        
    }
}
