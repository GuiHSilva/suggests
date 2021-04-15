<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Suggest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'author', 'slug', 'public', 'viewed', 'likes'
    ];

    protected $perPage = 5;

    public function user(){
        return $this->belongsTo(User::class, 'author');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'suggest_categories', 'suggest_id', 'category_id')
            ->withPivot('id')
            ->using(SuggestCategory::class);
    }

    public function liked(){
        $likes = Cookie::get('likes');
        if (isset($likes) &&  in_array($this->id, $likes)){
            return 'btn-danger';
        }
        return 'btn-outline-danger';
    }

    public function getCategoriesWithCommas(){
        $output = array();
        foreach($this->categories as $term){
            $output[] = $term->name;
        }

        if (count($output) == 0){
            return 'Nenhuma categoria associada';
        }
        return implode(' | ', $output);
    }

    public function getTimeAgoPost(){

        $diff = date_diff($this->created_at, Carbon::now());

        if ($diff->d > 7) {
            return date('d/m/Y H:i', strtotime($this->created_at));
        }
        if ($diff->d < 7 && $diff->d > 0) {
            return $diff->d . ' dia' . ($diff->d > 1 ? 's' : '') . ' atrás';
        }
        if ($diff->d == 0 && $diff->h > 0 ) {
            return $diff->h . ' hora' . ($diff->h > 1 ? 's' : '') . ' atrás';
        }
        if ($diff->i > 0) {
            return $diff->i . ' minuto' . ($diff->i > 1 ? 's' : '') . ' atrás';
        }
        return 'Poucos segundos atrás';

    }

    public function getResumedContent($quantidade = 80) {

        $textoResumo    = strip_tags($this->content);
        $simbolo        = '...';

        if ( strlen($textoResumo) > $quantidade ) {
            $valor = substr($textoResumo, 0, strpos($textoResumo, ' ', $quantidade)) . $simbolo;
        } else {
            $valor = $textoResumo;
        }

        return $valor;
    }

    public function getCardCssNotViewd(){
        if ( ! $this->viewed)
        {
            return 'border border-warning shadow-0';
        }
        return '';
    }

}
