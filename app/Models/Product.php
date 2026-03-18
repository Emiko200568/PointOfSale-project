<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'category_id',
        'stock',
    ];
    public function actionLogs(){
        return $this->hasMany(ActionLog::class);
    }


      // Define the relationship to Category
      public function category()
      {
          return $this->belongsTo(Category::class, 'category_id');
      }
}
