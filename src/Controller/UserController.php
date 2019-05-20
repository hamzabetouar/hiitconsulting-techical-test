<?php


namespace App\Controller;


use App\Model\User;

class UserController extends Controller
{

    public function register() {
        $user = new User();
        if($user->findByUsername($this->request->post->get('username')))
        {
            $this->render('default/index', [
                'register_err' => 'Pseudo déja utilisé'
            ]);
        }
        else{
            $user->setUsername($this->request->post->get('username'))
                ->setPassword(sha1($this->request->post->get('password') ));
            $user->create();

            $this->request->session->set('user', $user);
            $this->redirect($this->request->server->getPath() .'tchat');
        }

    }

    public function login() {
        $user = new User();
        if(!$user = $user->findByUsername($this->request->post->get('username')))
        {
            $this->render('default/index', [
                'login_err' => 'Pseudo pas encore inscrit'
            ]);
        }
        elseif($user->getPassword() != sha1($this->request->post->get('password') )) {

            $this->render('default/index', [
                'login_err' => 'Mot de passe incorrect !'
            ]);
        }else{
            $this->request->session->set('user', $user);
            $this->redirect($this->request->server->getPath() .'tchat');
        }

    }

    public function logout() {
        $this->request->session->remove('user');
        $this->redirect($this->request->server->getPath());
    }

    public function update() {
        /** @var User $user */
        $user = $this->request->session->get('user');
        $user->updateConnexion();
    }

    public function checkUsers() {
        $user = new User();
        $users = $user->findUsers();
        $data = [];
        foreach ($users as $u) {
            $data[] = [
                'id' => $u['id'],
                'username' => $u['username'],
                'connect' => strtotime($u['last_connect_date']) > time() - 10
            ];
        }
        echo json_encode($data);
    }



}