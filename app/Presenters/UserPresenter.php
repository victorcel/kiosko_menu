<?php

namespace App\Presenters;


use App\User;
use App\Http\Controllers\CartController;

class UserPresenter extends Presenter
{

    public function point()
    {

            return $this->user->point;

    }

    public function cart()
    {
        return CartController::totalCart();

    }
}