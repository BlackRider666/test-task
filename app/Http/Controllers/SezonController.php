<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sezon;
use Validator;
use Image;
class SezonController extends Controller
{
    public function store(Request $request)
    {
    	$request->validate([
	        'logo' => 'required|image',
	        'desc' => 'required',
	        'start' => 'required|date',
	        'finish' => 'required|date|after:start',
	        'serial_id'	=>	'required|integer'
    	]);
    	$filename = sha1(uniqid()).'.'.$request->file('logo')->getClientOriginalExtension();
        $img = Image::make($request->file('logo'));
        $img->resize(null, 300, function ($constraint) {
            $constraint->aspectRatio();
        });
        $path = '/img/sezon/'.$filename;
        $img->save(public_path($path));
    	$sezon = Sezon::create([
    		'logo_path'	=>	$path,
    		'desc'		=>	$request->get('desc'),
    		'start'		=>	$request->get('start'),
    		'finish'	=>	$request->get('finish'),
    		'serial_id'	=>	$request->get('serial_id')
    	]);
    	return response()->json($sezon,200);
    }
    public function getSezon($id)
    {
        $sezon = Sezon::find($id);
        if(isset($sezon->epizods))
        {
            $epizods = $sezon->epizods;
        } else {
            $epizods = null;
        }
        return response()->json([
            'sezon' => $sezon,
            'epizods' => $epizods,
        ],200);
    }
}
