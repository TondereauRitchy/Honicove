<?php

namespace App\Controllers;


use Gravity\Core\App\Controllers\Controller;

class BaseController extends Controller {

    /**
     * Sending a success response
     * 
     * @param mixed $data
     * @param mixed $message
     * @param mixed $code
     */
    public function sendResponse($data, $message = "Successful", $code=200) {
        $response = [
            'error' => false,
            'status'=>$code,
            'message' => $message,
            'data' => $data
        ];

        if(empty($data))
            unset($response['data']);

        // header("Access-Control-Allow-Origin: *");

        return $this->renderJson($response, $code);
    }


    /**
     * Sending an error message
     * 
     * @param mixed $error
     * @param mixed $errorMessages
     * @param mixed $code
     */
    public function sendError($error, $errorMessages = [], $code = 404) {
        $response = [
            'error'=> true,
            'status'=>$code,
            'message'=> $error
        ];

        if(!empty($errorMessages)) {
            $response['issues'] = $errorMessages;
        }

        if($code == 503 && !DEBUG)
            $response['issues'] = "Erreur interne du système";

        return $this->renderJson($response, $code);
    }


}

?>