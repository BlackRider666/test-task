<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serial;
use Validator,Image;
class SerialController extends Controller
{
    public function index(Request $request)
    {
        $serials = Serial::all();
    	return view('pages.home',[
            'serials'   =>  $serials,
        ]);
    }
    public function create()
    {
    	return view('pages.create_serial');
    }
    public function store(Request $request)
    {
    	$request->validate([
	        'name' => 'required|string|max:255',
	        'logo' => 'required|image',
	        'desc' => 'required',
	        'start' => 'required|date',
    	]);
    	$filename = sha1(uniqid()).'.'.$request->file('logo')->getClientOriginalExtension();
    	$path = $request->file('logo')->storeAs('public',$filename);
    	$serial = Serial::create([
    		'name'	=>	$request->get('name'),
    		'desc'	=>	$request->get('desc'),
    		'start'	=>	$request->get('start'),
    		'logo_path'	=>	$filename,
    	]);

    	return redirect()->route('serial.show',$serial->getKey());

    }
    public function show($id)
    {
    	$serial = Serial::find($id);
    	return view('pages.show_serial',[
    		'serial'	=> $serial,
    	]);
    }
}
