<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['slider_id','lang','lang_key_heading','lang_key_title' ];

    public function slider(){
        return $this->belongsTo(Slider::class);
    }
}
