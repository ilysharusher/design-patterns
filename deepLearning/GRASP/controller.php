<?php

// This is just concept of simple controller class which is responsible for handling the request and sending the response back to the client.

class Controller {
    protected $model;
    protected $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleRequest($request) {
        $data = $this->model->getData($request);

        $response = $this->view->render($data);

        return $response;
    }
}