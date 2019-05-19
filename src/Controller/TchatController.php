<?php


namespace App\Controller;


use App\Model\User;

class TchatController extends Controller
{

    public function index() {
        $user = new User();

        $this->render('tchat/index', [
            'user'  => $this->request->session->get('user'),
            'users' => $user->findUsers(),
        ]);
    }

}