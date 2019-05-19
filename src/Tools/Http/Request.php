<?php


namespace App\Tools\Http;


class Request
{

    /**
     * @var RequestGet
     */
    public $query;

    /**
     * @var RequestServer
     */
    public $server;
    /**
     * @var RequestSession
     */
    public $session;
    /**
     * @var RequestPost
     */
    public $post;

    public function __construct()
    {
        $this->query = new RequestGet();
        $this->server = new RequestServer();
        $this->session = new RequestSession();
        $this->post = new RequestPost();
    }

}