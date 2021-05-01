<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Suggest;
use App\Models\SuggestCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $suggests = Suggest::where('public', '=', true)
            ->where('deleted_by', '=', null)
            ->orderBy('created_at', 'DESC')
            ->paginate();


        return view('landing.home', [
            'suggests'  => $suggests
        ]);
    }

    public function search(Request $request) {

        $request->validate([
            'q' => 'required|min:3|max:12|string'
        ],[
            'q.required' => 'Informe uma palavra-chave',
            'q.min'      => 'Palavra-chave muito curta',
            'q.max'      => 'Palavra-chave muito longa',
            'q.string'   => 'Palavra-chave inválida',
        ]);

        $q = $request->q;

        $suggests = Suggest::where('title', 'LIKE', "%{$q}%")
            ->orWhere('content', 'LIKE', "%{$q}%")->paginate();

        return view('landing.parts.main_content.search', compact('q', 'suggests'));

    }

    public function showSuggest(String $slug, Request $request) {

        $suggest = Suggest::where('slug', $slug)->first();

        if (!$suggest) return response(404);

        return view('landing.parts.main_content.suggest_show', compact('suggest'));

    }

    public function showCategory( Category $category, Request $request)
    {

        // TO-DO: um query mais inteligente para filtrar a busca, para passar pelo URL

        $order_by_column    = $request->attr ?? 'created_at';
        $order_by_direction = $request->direction ?? 'DESC';

        $suggests = $category->suggests()
            ->orderBy($order_by_column, $order_by_direction)
            ->paginate()
            ->appends( request()->query() );

        return view('landing.parts.main_content.category', [
            'category'  => $category,
            'suggests'  => $suggests
        ]);

    }

    /**
     * Fazer uma nova sugestao
     */
    public function novaSugestao(Request $request){

        return view('landing.parts.main_content.suggest_new');

    }

    public function indexAdmin(){
        return view('vendor.adminlte.home');
    }

}
