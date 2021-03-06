<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SuggestCategory extends Pivot
{
    use HasFactory;

    protected $table = 'suggest_categories';
    protected $fillable = [
        'suggest_id', 'category_id'
    ];

}
