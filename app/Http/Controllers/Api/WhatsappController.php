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
            $message = "VOTING KORPRI\n\nNama : " . $record['name'] . "\nKode : " . $record['slug'] . "\n\nLink : \n" . env('MAIN_URL') . $record['slug'];

            $message = preg_replace("/(\n)/", "<ENTER>", $message);
            $message = preg_replace("/(\r)/", "<ENTER>", $message);

            // $phone = preg_replace("/(\n)/", ",", $record['phone']);
            // $phone = preg_replace("/(\r)/", "", $record['phone']);
            $data = array("phone_no" => $record['phone'], "key" => "e4d16a0772635a648acd790503fe71a9ebcd9f538952dfbc", "message" => $message);
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
        return ResponseFormatter::success($result);
    }
    public function singleWhatsapp(Voter $voter)
    {
        $message = "VOTING KORPRI\n\nNama : " . $voter->name . "\nKode : " . $voter->slug . "\n\nLink : \n" . env('MAIN_URL') . $voter->slug;

        $message = preg_replace("/(\n)/", "<ENTER>", $message);
        $message = preg_replace("/(\r)/", "<ENTER>", $message);

        // $phone = preg_replace("/(\n)/", ",", $record['phone']);
        // $phone = preg_replace("/(\r)/", "", $record['phone']);
        $data = array("phone_no" => $voter->phone, "key" => "e4d16a0772635a648acd790503fe71a9ebcd9f538952dfbc", "message" => $message);
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
        return ResponseFormatter::success($result);
    }
}
