<?php

namespace App\Services;

class Dadata
{
    const DADATA_URL = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/";
    const SUGGEST_ADDRESS = "address";
    const SUGGEST_EMAIL = "email";
    public function request($request, $category, $method = "POST"){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::DADATA_URL.$category);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($method == "POST"){
        $data = json_encode($request);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        $headers = [
            "Content-Type: application/json",
            "Accept: */*",
            "Authorization: Token ".env("DADATA_TOKEN")
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        }
        $result = json_decode($response, true);
        curl_close($ch);
        return $result;
    }

    public function suggestPostData($data, $category){
        return $this->request($data, $category);
    }
}