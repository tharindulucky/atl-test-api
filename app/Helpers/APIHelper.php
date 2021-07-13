<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class APIHelper {


    public static function createSuccessAPIResponse($data = null, $status_code, $status, $message = null) {

        $result = [];
        $result["status"] = $status;

        if($message != null){
            $result["message"] = $message;
        }

        if($data != null){
            $result["data"] = $data;
        }
        return response()->json($result, $status_code);
    }

    public static function createErrorAPIResponse($data = null, $status_code, $status, $error_payload = null) {

        $result = [];

        if ($data == null){
            $data = "Data query error. This will be reported";
        }

        $result["status"] = 'failed';
        $result["error"] = $data;

        if ($error_payload != null){
            $result["data"] = $error_payload;
        }
        return response()->json($result, $status_code);
    }


    public static function sendAPICall($method = "GET", $url = "", $body = null, $headers = ['Content-Type' => 'application/json', 'Accept' => 'application/json; charset=utf-8'], $guzzle_body_type = 'json'){
        $curl_exception = false;
        $client = new Client(['http_errors' => false, 'verify' => false]);

        $request_body = [
            'headers' => $headers,
            $guzzle_body_type => $body,
            'timeout' => 30,
        ];

        try {
            $response = $client->request($method, $url, $request_body);
        } catch (\Exception $e) {
            Log::critical($e);
            $curl_exception = true;
        }

        if (!$curl_exception && $response->getBody()) {
            $response_body["body"] = json_decode((string)$response->getBody(), true);
            $status_code = $response->getStatusCode();
            $response_body["status_code"] = $status_code;
            $response_body["headers"] = $response->getHeaders();
            return $response_body;
        } else {
            $log_data = ["ACTION" => "API ERROR", "URL" => $url, "BODY" => $body, "HEADERS" => $headers, "GUZZLE_BODY_TYPE" => $guzzle_body_type];
            Log::critical(json_encode($log_data));
            return null;
        }
    }
}
