<?php

namespace App;

use App\Http\Controllers\CartController;
use App\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',  'last_name', 'username','password', 'type', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function scopeOrderid($query)
    {
        return $query->orderBy('id', 'ASC')->paginate(5);
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function admin()
    {
        return $this->type === 'admin';
    }

    protected $hidden = [
         'remember_token',
    ];

    public function present(){

        return new UserPresenter($this);
    }
}
