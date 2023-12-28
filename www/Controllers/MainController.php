<?php

namespace Controllers;

use MiladRahimi\PhpRouter\View\View;
use ORM;

class MainController
{
    function index(View $view)
    {
        $posts = ORM::for_table('posts')->find_many();
        return $view->make('index', ['posts' => $posts]);
    }
    function registration(View $view)
    {
        return $view->make('reg');
    }
    function login(View $view)
    {
        return $view->make('auth');
    }
    function page(View $view, $id)
    {
        $comments = ORM::for_table('comments')->join('users', ['comments.user_id', '=', 'users.id'])->where('comments.post_id', $id)->find_many();
        $post = ORM::for_table('posts')->where('id', $id)->find_one();
        return $view->make('page', ['post' => $post, 'comments' => $comments]);
    }

}