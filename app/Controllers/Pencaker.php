<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PencakerModel;
use App\Models\DokumenPencakerModel;
use App\Models\SettingsModel;
use CodeIgniter\Controller;

class Pencaker extends Controller
{
    public function __construct()
    {
        helper('whatsapp');
        $this->settingsModel = new SettingsModel();
    }


    public function index()
    {
        $usersModel = new UsersModel();
        $userId = user()->id;

        // Ambil data pengguna berdasarkan user ID
        $user = $usersModel->find($userId);

        $pencakerModel = new PencakerModel();
        $id_pencaker = $pencakerModel->getStatusByUserId($user['id']);

        $dokumenPencaker = new DokumenPencakerModel();

        $isDataComplete = $pencakerModel->isDataComplete($userId);
        $isDocumentComplete = $dokumenPencaker->isDocumentComplete($userId);

        $data = [
            'title' => 'Dashboard Pencaker',
            'user' => $user,
            'id_pencaker' => $id_pencaker,
            'isDocumentComplete' => $isDocumentComplete,
            'isDataComplete' => $isDataComplete
        ];

        return $this->loadView('pencaker/dashboard', $data);
    }

    public function minta_verifikasi()
    {
        $pencakerModel = new PencakerModel();
        $userId = $this->request->getPost('id_pencaker');

        if (!$userId) {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'User ID tidak ditemukan.']);
        }

        $data = [
            'keterangan_status' => $this->request->getPost('keterangan_status'),
        ];

        try {
            // Update status di database
            $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

            if ($existingPencaker) {
                $pencakerModel->update($existingPencaker['id'], $data);
            } else {
                $data['user_id'] = $userId;
                $pencakerModel->insert($data);
            }

            // Ambil data nomor telepon dan nama lengkap dari request
            $phoneNumber = '081248803652';
            $namaLengkap = 'OMPAY';

            // Format pesan yang akan dikirim
            $message = "*Notifikasi disnakertransmkw.com*" . PHP_EOL . PHP_EOL .
                "Hi, *" . $namaLengkap . "*," . PHP_EOL .
                "Anda telah berhasil melakukan registrasi sebagai pencaker di situs disnakertransmkw.com. " .
                "Silakan lakukan aktivasi akun Anda dengan mengecek email aktivasi dari Sistem Disnakertrans Manokwari." . PHP_EOL . PHP_EOL .
                "*<noreply>*";

            $settingsModel = new SettingsModel();

            // Ambil userkey dan passkey dari settings
            $userKey = $settingsModel->getValueByKey('whatsapp_userkey');
            $passKey = $settingsModel->getValueByKey('whatsapp_passkey');
            $admin = $settingsModel->getValueByKey('whatsapp_admin');

            // Kirim pesan WhatsApp menggunakan API Zenziva
            $response = $this->sendWhatsAppMessage($phoneNumber, $message, $userKey, $passKey, $admin);

            if ($response && isset($response['status']) && $response['status'] == 'success') {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan dan notifikasi dikirim']);
            } else {
                log_message('error', 'Gagal mengirim notifikasi: ' . json_encode($response));
                return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Data berhasil disimpan tapi notifikasi gagal dikirim']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Kesalahan saat menyimpan data atau mengirim notifikasi: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Terjadi kesalahan saat menyimpan data atau mengirim notifikasi.']);
        }
    }

    private function sendWhatsAppMessage($phoneNumber, $message, $userKey, $passKey, $admin)
    {
        $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
        $data = [
            'userkey' => $userKey,
            'passkey' => $passKey,
            'to' => $phoneNumber,
            'message' => $message
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            log_message('error', 'Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response, true);
    }



    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}
