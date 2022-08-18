<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voter;

class WhatsappController extends Controller
{
    public function kirim_wa()
    {
        $voters = Voter::all();
        $records = array();
        foreach (json_decode($voters) as $response) {
            $records[] = [
                'name' => $response->name,
                'phone' => $response->phone,
                'slug' => $response->slug,
            ];
        }
        foreach ($records as $record) {
            $message = "VOTING KORPRI " . $record['name'];

            $message = preg_replace("/(\n)/", "<ENTER>", $message);
            $message = preg_replace("/(\r)/", "<ENTER>", $message);

            $record['phone'] = preg_replace("/(\n)/", ",", $record['phone']);
            $record['phone'] = preg_replace("/(\r)/", "", $record['phone']);

            $data = array("phone" => $record['phone'], "key" => "e4d16a0772635a648acd790503fe71a9ebcd9f538952dfbc", "message" => $message);
            $data_string = json_encode($data);
            $ch = curl_init('http://116.203.92.59/api/send_message');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string)
                )
            );
            $result = curl_exec($ch);
            dd($result);
        }
    }
    public function kirim_wa_test($phone_no, $nama, $nip)
    {
        $message = "ASN dengan nama " . $nama . " (" . $nip . ")\n\nmelakukan pengajuan cuti dan membutuhkan verifikasi Anda sebagai atasan.\n\nSilakan melakukan verifikasi pada menu E-Cuti pada aplikasi Simpatik https://simpatik.semarangkota.go.id/\n\n";

        $message = preg_replace("/(\n)/", "<ENTER>", $message);
        $message = preg_replace("/(\r)/", "<ENTER>", $message);

        $phone_no = preg_replace("/(\n)/", ",", $phone_no);
        $phone_no = preg_replace("/(\r)/", "", $phone_no);

        $data = array("phone_no" => $phone_no, "key" => "e4d16a0772635a648acd790503fe71a9ebcd9f538952dfbc", "message" => $message);
        $data_string = json_encode($data);
        $ch = curl_init('http://116.203.92.59/api/send_message');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );
        $result = curl_exec($ch);
    }
}
