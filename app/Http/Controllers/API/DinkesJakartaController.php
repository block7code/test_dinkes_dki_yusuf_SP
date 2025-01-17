<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ApiDinkes;
use App\Models\RumahSakit;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller as Controller;

class DinkesJakartaController extends Controller
{

    public function Tester()
    {
        return response()->json(['message' => 'Ini Tester']);
    }

    public function MergeDataRumahSakit(Request $request)
    {
        // Ambil data1 data2 data3 dari API
        $data1 = json_decode(ApiDinkes::api_all_rs_terkoneksi());
        $data2 = collect(json_decode(ApiDinkes::api_all_rsud()))->map(function ($item) {
            $item->organisasi_id = (string) $item->organisasi_id;
            return $item;
        });
        $data3 = collect(json_decode(ApiDinkes::api_transaksi_data_satusehat()))->map(function ($item) {
            $item->organisasi_id = (string) $item->organisasi_id;
            return $item;
        });

       
        $groupedData = $data3->groupBy('organisasi_id')->map(fn($group) => $group->sum('jumlah_pengiriman_data'));
        foreach ($data1 as $d1) {
            $newData2 = $data2->firstWhere('organisasi_id', $d1->organisasi_id);

            // Tentukan status koneksi
            $status = $newData2 ? 'Terkoneksi' : 'Belum Terkoneksi';
            $jumlahPengirimanData = $groupedData->get($d1->organisasi_id, 0);

            // Generate id_kode dan pastikan unik (UUID)
            while (true) {
                $id_kode = Str::uuid()->toString(); 
                $cek_existing = RumahSakit::where('id_kode', $id_kode)->exists();
                if (!$cek_existing) {
                    break;
                }
            }

            $finalData = [
                'id_kode' => $id_kode,
                'nama' => $d1->nama,
                'organisasi_id' => $d1->organisasi_id,
                'kode_rs' => $newData2->kode_rs ?? 0,
                'kelas_rs' => $newData2->kelas_rs ?? null,
                'status' => $status,
                'alamat' => $d1->alamat ?? null,
                'kota_kab' => $newData2->kota_kab ?? null,
                'email' => $newData2->email ?? null,
                'lokasi' => $d1->lokasi ?? null,
                'jumlah_pengiriman_data' => $jumlahPengirimanData,
            ];
            RumahSakit::firstOrCreate(
                ['organisasi_id' => $finalData['organisasi_id']], 
                $finalData
            );
        }
        
        $result = json_decode(RumahSakit::get_list_merge($request->page,$request->limit,$request->IsStatus,$request->kota_kab,$request->kelas_rs));
        $limit = $request->limit;   $page = $request->page;
        $opt=$result->opt;  $halaman =$opt->page;

        return response()->json($result);
    }

   
}