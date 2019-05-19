<?php


namespace App\Controller;


class DefaultController extends Controller
{

    public function index() {
        if( $this->request->session->get('user') )
            $this->redirect('/tchat');

        $this->render('default/index');
    }

}