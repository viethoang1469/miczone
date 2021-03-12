<?php
class response {
    private $code;
    private $success;
    private $data;
    private $error;
    private $message;

    
    public function set ($code, $success, $data, $error, $message)
    {
        $this->code = $code;
        $this->success = $success;
        $this->data = $data;
        $this->error = $error;
        $this->message = $message;
    }
    public function getResponse ()
    {
        return [
            'code' => $this->code,
            'success' => $this->success,
            'data' => $this->data,
            'error' => $this->error,
            'message' => $this->message,
        ];
    }
}