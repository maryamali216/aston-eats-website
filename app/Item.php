<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function attributes(){
        return $this->hasMany('App\ItemsAttribute','item_id');
    }
}
