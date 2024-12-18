<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\User;

class UsersController extends BaseController {

    public static function index () {

        $users = User::all();
        
        self::loadView('/user/users', [
            'title' => 'Users',
            'domain' => 'Users',
            'users' => $users,
        ]);
    }

    public static function user ($id) {

        $user = User::find($id);

        if (!$user->id) {
            return self::loadView('/404');
        }

        $orders = Order::getOrdersWithUserId($id);

        self::loadView('/user/user', [
            'title' => $user->getFullName(),
            'domain' => 'Users',
            'user' => $user,
            'orders' => $orders,
        ]);
    }

}