<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Epresence extends Model
{
    protected $table = 'epresences';
    protected $guarded = [];

    

    public function user()
    {
        return $this->belongsTo('App/User');
    }
}
