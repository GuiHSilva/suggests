<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Suggest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\Component;

class SuggestInfoWidget extends Component
{

    public $total = 0;
    public $total_identificadas = 0;
    public $total_categorias = 0;
    public $total_usuarios = 0;
    public $total_ultima_semana = 0;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $date = new Carbon();

        $this->total                = Suggest::all()->count();
        $this->total_identificadas  = Suggest::whereNotNull('author')->get()->count();
        $this->total_categorias     = Category::where('active', true)->get()->count();
        $this->total_usuarios       = User::all()->count();
        $this->total_ultima_semana  = Suggest::where('created_at', '>', $date->subDays(7))->get()->count();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('landing.components.suggest-info-widget');
    }
}
