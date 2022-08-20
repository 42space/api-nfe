<?php

class Apidanfe {
    public $returnBase64;

    public function __construct($xmlString) {
        return $this->returnBase64 = $this->requestApi($xmlString);
    }

    /*
    ********************************************************
     * Function Request API 
     *******************************************************
     */
    public function requestApi($xmlString) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://ws.meudanfe.com/api/v1/get/nfe/xmltodanfepdf/API',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$xmlString,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml'
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}