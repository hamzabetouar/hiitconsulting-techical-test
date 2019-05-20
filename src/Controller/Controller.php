<?php


namespace App\Controller;


use App\Application;
use App\Tools\Http\Request;

class Controller
{

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $view
     * @param $data
     */
    public function render($view, $data = []) {
        Application::render($view, $data);
    }

    public function redirect($url) {
        header('Location: ' .$url);
        die;
    }

}