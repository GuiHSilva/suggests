<?php

namespace App\Http\Controllers;

use App\Models\Suggest;
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
            ->orderBy('created_at', 'DESC');

        return view('landing.home', [
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
