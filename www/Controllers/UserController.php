<?php

namespace Controllers;

use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;
use ORM;

class UserController
{
    function store(ServerRequest $request)
    {
        $params = $request->getParsedBody();
        $user=ORM::for_table('users')->create();
        $user->login = $params['login'];
        $user->password = password_hash($params['password'], PASSWORD_DEFAULT);
        return new RedirectResponse('/');

    }
    function login(ServerRequest $request)
    {
        $params = $request->getParsedBody();
        $user = ORM::for_table('users')->where('login', $params['login'])->find_one();
        if($user)
        {
            if( password_verify($params['password'], $user['password']))
            {
                $_SESSION['user'] = $user->id;
                return new RedirectResponse('/');
            }
        }
        return new RedirectResponse('/login');
    }


}