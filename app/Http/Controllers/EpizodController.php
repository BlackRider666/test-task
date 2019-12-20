<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Epizod;
use Validator;
class EpizodController extends Controller
{
    public function create($id)
    {
    	return view('pages.create_epizod',[
    		'sezon_id'	=>	$id,
    	]);
    }	
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
    	$path = $request->file('logo')->storeAs('public',$filename);
    	$epizod = Epizod::create([
    		'logo_path'	=>	$filename,
    		'desc'		=>	$request->get('desc'),
    		'name'		=>	$request->get('name'),
    		'release'	=>	$request->get('release'),
    		'sezon_id'	=>	$request->get('sezon_id')
    	]);
    	return redirect()->route('epizod.show',$epizod->getKey());
    }
    public function show($id)
    {
    	$epizod = Epizod::find($id);
    	return view('pages.show_epizod',[
    		'epizod'	=>	$epizod,
    	]);
    }
}
