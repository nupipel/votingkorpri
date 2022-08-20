<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LogError;
use App\Models\Voter;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function kirim_wa(Request $request)
    {
        $slug = $request->slug;
        $voters = Voter::when($slug, function ($q) use ($request) {
            $q->where('slug', $request->slug);
        })->get();
        $records = array();
        foreach (json_decode($voters) as $response) {
            $records[] = [
                'id' => $response->id,
                'name' => $response->name,
                'phone' => $response->phone,
                'slug' => $response->slug,
            ];
        }
        foreach ($records as $record) {
            $message = "VOTING KORPRI\n\nNama : " . $record['name'] . "\n\nLink : \n" . env('MAIN_URL') . $record['phone'];

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
            if ($result == 'failed') {
                LogError::create([
                    'phone' => $record['phone'],
                    'voter_id' => $record['id'],
                    'message' => 'Gagal Mengirim Pesan, Nomor Tidak Valid'
                ]);
            }
        }
        return ResponseFormatter::success($result);
    }
    public function kirim_wa_range(Request $request)
    {
        $slug = $request->slug;
        $voters = Voter::when($slug, function ($q) use ($request) {
            $q->where('slug', $request->slug);
        })->get();
        $records = array();
        foreach (json_decode($voters) as $response) {
            $records[] = [
                'id' => $response->id,
                'name' => $response->name,
                'phone' => $response->phone,
                'slug' => $response->slug,
            ];
        }
        $start = $request->start;
        $end = $request->end;
        $rs =  array_slice($records, $start, $end);
        foreach ($rs as $record) {
            $message = "VOTING KORPRI\n\nNama : " . $record['name'] . "\n\nLink : \n" . env('MAIN_URL') . $record['phone'];

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
            if ($result == 'failed') {
                LogError::create([
                    'phone' => $record['phone'],
                    'voter_id' => $record['id'],
                    'message' => 'Gagal Mengirim Pesan, Nomor Tidak Valid'
                ]);
            }
        }
        return ResponseFormatter::success(['data' => $result, 'start_end' => $start . '-' . $end, 'voters' => $rs]);
    }
    public function singleWhatsapp(Voter $voter)
    {
        $message = "VOTING KORPRI\n\nNama : " . $voter->name . "\n\nLink : \n" . env('MAIN_URL') . $voter->phone;

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
        if ($result == 'failed') {
            $error = LogError::create([
                'phone' => $voter->phone,
                'voter_id' => $voter->id,
                'message' => 'Gagal Mengirim Pesan, Nomor Tidak Valid'
            ]);
            return ResponseFormatter::error("", $error->message);
        }
        return ResponseFormatter::success($result, 'Whatsapp Sukses Terkirim');
    }
}
