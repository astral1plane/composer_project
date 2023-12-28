<?php

namespace Controllers;

use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;
use ORM;

class ComController
{
function store(ServerRequest $request, $id)
    {
        $params = $request->getParsedBody();
        $comment = ORM::for_table('comments')->create();
        $comment->text = $params['text'];
        $comment->user_id = $_SESSION['user'];
        $comment->post_id = $id;
        $comment->save();
        return new RedirectResponse('/post/'.$id);
    }
}