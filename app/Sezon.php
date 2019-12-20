<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sezon extends Model
{
    protected $table = 'sezons';

    protected $fillable = [
    	'start',
        'finish',
        'logo_path',
        'desc',
        'serial_id',
    ];
    
    public function serial()
    {
    	return $this->belongsTo('App\Serial');
    }
    public function epizods()
    {
    	return $this->HasMany('App\Epizod');
    }
}
