<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function adminlte_image()
    {
        return 'https://www.gravatar.com/avatar/' . md5(trim($this->email));
    }

    public function suggestAmount(){

        return count(Suggest::where('author', $this->id)->get());

    }

    public function adminlte_suggests_amount()
    {
        return random_int(0, 100);
    }

    public function adminlte_profile_url()
    {
        $route = 'admin/usuario/' . $this->id;
        return Route::has($route) ? route($route) : '#';
    }
}
