<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function sizes(){
      return $this->belongsToMany('App\ProductSize');
    }

    public function colors(){
      return $this->belongsToMany('App\ProductColor');
    }

    public function category(){
      return $this->belongsTo('App\ProductCategory', 'category_id');
    }



}
