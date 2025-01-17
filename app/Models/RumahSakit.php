<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
class RumahSakit extends Model
{
    use HasFactory;
    
    protected $table ='rumah_sakit';
    protected $fillable = [ 'id_kode', 'nama', 'organisasi_id', 'kode_rs', 'kelas_rs', 'status', 'alamat', 'kota_kab', 'email', 'lokasi', 'jumlah_pengiriman_data', ];


    public static function get_list_merge($getPage,$getLimit,$getStatus,$getKotaKab,$getKelasRS){  
        $msg = "Merge";  $page ='';  $page = (intval($getPage) > 0) ? intval($getPage) : 1;
        $lmt = 20; 
        if (is_numeric($getLimit) && $getLimit >= 1) {   $lmt = (int) $getLimit;  }
        $query = RumahSakit::select( 'id_kode', 'nama', 'organisasi_id', 'kode_rs', 'kelas_rs', 'status', 'alamat', 'kota_kab', 'email', 'lokasi', 'jumlah_pengiriman_data')->orderBy('id', 'ASC');

        if (!empty($getStatus) && is_numeric($getStatus)) {
            $statusMap = [ 1 => 'Terkoneksi', 2 => 'Belum Terkoneksi'];
            if (array_key_exists($getStatus, $statusMap)) {
                $msg  =$statusMap[$getStatus];
                $query->where('status', $statusMap[$getStatus]);
            }
        }

        if (!empty($getKotaKab)) { $query->where('kota_kab', 'like', '%' . $getKotaKab . '%');}
        if (!empty($getKelasRS)) {$query->where('kelas_rs', 'like', '%' . $getKelasRS . '%');}
      
        $data = $query->paginate($lmt);
        $result = json_decode(json_encode($data));
        $pages = $result->total /$lmt;
        $explode = explode(".", $pages);
        $pages = 0;

        if(count($explode) > 1){
            $pages = (int) ($explode[0] + 1); 
        }else{
            $pages = (int) $explode[0];
        }

        $result = [
            'status' =>  1,
            'message' => "Data {$msg} Ditampilkan",
            'opt' => array('total' => $result->total ,'limit' =>$lmt,'page' =>$page,'pages' =>  $pages ),
            'data' => $result->data,
        ];

        return json_encode($result);
    } 

}