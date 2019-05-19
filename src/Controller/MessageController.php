<?php


namespace App\Controller;


use App\Model\Message;

class MessageController extends Controller
{

    public function create() {
        $message = new Message();
        $message->setMessage($this->request->post->get('message'))
            ->setSenderId($this->request->session->get('user')->getId())
            ->setReceiverId($this->request->post->get('uid'));
        $message->create();
        echo json_encode($message);
    }

    public function messages() {
        $message = new Message();
        $messages = $message->findMessages($this->request->query->get('uid'),
            $this->request->session->get('user')->getId());
        if( !$messages ) $messages = [];
        echo json_encode($messages);
    }

    public function inbox() {
        $message = new Message();
        $messages = $message->getMessages(
            $this->request->session->get('user')->getId(),
            $this->request->query->get('uid'),
            $this->request->query->get('mid'));
        if( !$messages ) $messages = [];
        echo json_encode($messages);
    }

}