<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getAlert($text, $url)
{
    return print "<script language=javascript> alert('$text'); location.replace('$url'); </script>";
}

function aligo($data)
    {
        $AWS_API_GATEWAY_KEY = "XpFYdBURK63c7mexOxw9a7BbtAzFSvZE1YDauauL";
        $url = "https://6u6gm4ezsb.execute-api.ap-northeast-2.amazonaws.com/dev/sms/send";

        $curl = curl_init();

        $headers[] = "x-api-key: ". $AWS_API_GATEWAY_KEY; 
        $headers[] = "Content-type: Application/json";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

?>