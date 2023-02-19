<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class ShippingCost extends Model
{

    public function seller(){
       return $this->hasMany(Seller::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
