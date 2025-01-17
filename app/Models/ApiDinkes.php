<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;
class ApiDinkes extends Model
{

    public static function api_all_rs_terkoneksi() {
        $headers = array();
        $headers[]= "Content-Type: application/json";
        $partsUrl    = "/apps/jp-2024/all-rs-terkoneksi.json";
        $result = Utils::http_get($partsUrl,$headers);
        Log::Info(' data api_all_rs_terkoneksi result'.' - '.json_encode($result));
       
        return $result;
    }

    public static function api_all_rsud() {
        $headers = array();
        $headers[]= "Content-Type: application/json";
        $partsUrl    = "/apps/jp-2024/all-rsud.json";
        $result = Utils::http_get($partsUrl,$headers);
        Log::Info(' data api_all_rsud result'.' - '.json_encode($result));
       
        return $result;
    }

    public static function api_transaksi_data_satusehat() {
        $headers = array();
        $headers[]= "Content-Type: application/json";
        $partsUrl    = "/apps/jp-2024/transaksi-data-satusehat.json";
        $result = Utils::http_get($partsUrl,$headers);
        Log::Info(' data api_transaksi_data_satusehat result'.' - '.json_encode($result));
       
        return $result;
    }




}