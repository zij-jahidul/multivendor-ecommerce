<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
  protected $fillable = ['brand_id','name','lang','meta_title','meta_description' ];

  public function brand(){
    return $this->belongsTo(Brand::class);
  }
}
