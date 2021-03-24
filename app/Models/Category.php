<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function suggests(){
        return $this->belongsToMany(Suggest::class, 'sugestcategory', 'suggest_id', 'category_id')
            ->withPivot('id')
            ->using(SuggestCategory::class);
    }

}
