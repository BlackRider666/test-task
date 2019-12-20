<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    protected $table = 'serials';

    protected $fillable = [
    	'name',
    	'logo_path',
    	'desc',
    	'start'
    ];

    public function sezons()
    {
    	return $this->HasMany('App\Sezon');
    }
}
