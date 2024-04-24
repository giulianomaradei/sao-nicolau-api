<?php

class BaseController {
    protected function errorResponse($message, $code = 500) {
        header('Content-Type: application/json');
        echo json_encode(['code' => $code, 'error' => $message]);
    }

    protected function successResponse($data, $code = 200) {
        header('Content-Type: application/json');
        echo json_encode(['code' => $code, 'data' => $data]);
    }

    protected function executeInTransaction(callable $function) {
        $database = Database::getInstance();
        $database->beginTransaction();

        try {
            $result = $function();
            $database->commit();
            return $result;
        } catch (Exception $e) {
            $database->rollBack();
            $this->errorResponse($e->getMessage());
        }
    }
}