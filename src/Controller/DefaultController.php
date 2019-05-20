<?php


namespace App\Controller;


class DefaultController extends Controller
{

    public function index() {
        if( $this->request->session->get('user') )
            $this->redirect($this->request->server->getPath() .'tchat');

        $this->render('default/index');
    }

}