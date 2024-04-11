<?php

class BaseController {
    protected function render($view, $data = []) {
        extract($data);

        include "Views/$view.php";
    }

    protected function errorResponse($message, $code = 500) {
        echo json_encode(['code' => $code, 'error' => $message]);
    }

    protected function successResponse($data, $code = 200) {
        echo json_encode(['code' => $code, 'data' => $data]);
    }
}