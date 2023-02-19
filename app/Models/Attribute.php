<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Attribute extends Model
{
    protected $guarded = [];
    protected $with = ['attribute_translations'];

    public function getTranslation($field = '', $lang = false){
      $lang = $lang == false ? App::getLocale() : $lang;
      $attribute_translation = $this->attribute_translations->where('lang', $lang)->first();
      return $attribute_translation != null ? $attribute_translation->$field : $this->$field;
    }

    public function attribute_translations(){
      return $this->hasMany(AttributeTranslation::class);
    }

    public function attribute_values() {
        return $this->hasMany(AttributeValue::class);
    }

    public function attribute_categories() {
      return $this->hasOne(Category::class , 'id' , 'category_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
