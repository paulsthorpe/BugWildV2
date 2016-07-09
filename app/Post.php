<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function category(){
      return $this->belongsTo('App\PostCategory', 'post_category_id');
    }

}
