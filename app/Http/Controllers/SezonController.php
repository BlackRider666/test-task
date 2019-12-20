<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sezon;
use Validator;
class SezonController extends Controller
{
    public function create($id)
    {
    	return view('pages.create_sezon',[
    		'serial_id'	=>	$id,
    	]);
    }
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
    	$path = $request->file('logo')->storeAs('public',$filename);
    	$sezon = Sezon::create([
    		'logo_path'	=>	$filename,
    		'desc'		=>	$request->get('desc'),
    		'start'		=>	$request->get('start'),
    		'finish'	=>	$request->get('finish'),
    		'serial_id'	=>	$request->get('serial_id')
    	]);
    	return redirect()->route('sezon.show',$sezon->getKey());
    }
    public function show($id)
    {
    	$sezon = Sezon::find($id);
    	return view('pages.show_sezon',[
    		'sezon'	=>	$sezon,
    	]);
    }
}
