<?php

namespace App\Providers;

use App\Models\Suggest;
use App\Traits\Toolkit;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{

    use Toolkit;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        //
        Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add('Pesquisar');
            $event->menu->add([
                'text' => 'Pesquisar',
                'search' => true,
                'topnav' => false,
            ]);

            $event->menu->add('Geral');

            $event->menu->add([
                'text'        => 'Início',
                'url'         => 'admin',
                'icon'        => 'fas fa-fw fa-home'
            ]);

            $event->menu->add([
                'text'        => 'Sugestões',
                'url'         => 'admin/sugestao',
                'icon'        => 'far fa-fw fa-star',
                'label'       => Toolkit::numberAbbreviation(Suggest::all()->where('viewed', '=', true)->count()),
                'label_color' => 'info',
            ]);

            $event->menu->add([
                'text'        => 'Usuários',
                'url'         => 'admin/usuario',
                'icon'        => 'far fa-fw fa-user'
            ]);




            $event->menu->add('Configuraçoes');

            $event->menu->add([
                'text'        => 'Configurar',
                'url'         => 'admin/configuracoes',
                'icon'        => 'fas fa-fw fa-cogs'
            ]);

        });



    }
}
