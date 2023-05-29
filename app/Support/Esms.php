<?php
/**
 * Author : CanhDominich.
 */

namespace App\Support;

use \GuzzleHttp\Client;

class Esms
{
    // const API_KEY = '36E75840E574B47ECBF59946499F5C';
    // const SECRET_KEY = '08F124CC7F824501EAC5588CB74985';
    const API_KEY = '8186B41AF90A10497FDE3453AE7F18';
    const SECRET_KEY = '7500F1E4941F3ABF94EACB6DFB5F23';
    const BASE_URL = 'http://rest.esms.vn/MainService.svc/json/';
    const BRANDNAME = 'NT_Nhi Khoa';

    private $apiKey;
    private $secretKey;
    private $baseUrl = 'http://rest.esms.vn/MainService.svc/json/';
    private $brandName = 'NT_Nhi Khoa';

    public function __construct()
    {
        $this->apiKey = env('ESMS_API_KEY');
        $this->secretKey = env('ESMS_SECRET_KEY');
    }

    public function getBalance()
    {
        $httpClient = new Client();
        $response = $httpClient->get($this->baseUrl . 'GetBalance/' . $this->apiKey . '/' . $this->secretKey);
        echo $response->getStatusCode();
    }

    public function sendOtp($phone_number, $content)
    {
        $content = "Ma xac thuc cua ban la: $content";
        $httpClient = new Client();
        $response = $httpClient->get($this->baseUrl . 'SendMultipleMessage_V4_get?Phone=' . $phone_number . '&Content=' . $content . '&ApiKey=' . $this->apiKey . '&SecretKey=' . $this->secretKey . '&SmsType=2&Brandname=' . $this->brandName);
        $results = json_decode((string) $response->getBody(), true);
        if ($results['CodeResult'] == 100) {
            return true;
        }
        return false;
    }
}