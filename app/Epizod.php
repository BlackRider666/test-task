<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epizod extends Model
{
    protected $table = 'epizods';

    protected $fillable = [
    	'name','logo_path','desc','release','sezon_id'
    ];
    
    public function sezon()
    {
    	return $this->belongsTo('App\Sezon');
    }
}
