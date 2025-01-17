<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utils extends Model
{

    public static  function http_get($partUrl,$headers){

        $url = "https://dinkes.jakarta.go.id";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $partUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
            $result = curl_exec($ch); 
        $err = curl_error($ch);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        }  else {
        return $result; 
        }	
        curl_close ($ch); 
    }
}