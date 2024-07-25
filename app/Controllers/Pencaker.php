<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UsersModel;
use App\Models\PencakerModel;
use App\Models\PendidikanModel;
use App\Models\PengalamanKerjaModel;
use App\Models\DokumenPencakerModel;
use App\Models\JenjangpendidikanModel;
use App\Models\DokumenModel;
use App\Models\BahasaModel;
use App\Models\JabatanModel;
use App\Models\PerusahaanModel;
use App\Models\SettingsModel;
use App\Models\ActivitylogsModel;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Pencaker extends Controller
{
    public function __construct()
    {
        helper('whatsapp');
        // $this->settingsModel = new SettingsModel();
    }


    public function index()
    {
        $usersModel = new UsersModel();
        $userId = user()->id;

        // Ambil data pengguna berdasarkan user ID
        $user = $usersModel->find($userId);

        $activityLogsModel = new ActivitylogsModel();

        // Ambil log aktivitas berdasarkan user ID
        $logs = $activityLogsModel->getActivityLogs();

        $pencakerModel = new PencakerModel();
        $id_pencaker = $pencakerModel->getStatusByUserId($user['id']);

        $dokumenPencaker = new DokumenPencakerModel();

        $isDataComplete = $pencakerModel->isDataComplete($userId);
        $isDocumentComplete = $dokumenPencaker->isDocumentComplete($userId);

        // $timelines = $pencakerModel->get_timeline();
        $timelines = $pencakerModel->get_timeline($userId);


        $data = [
            'title' => 'Dashboard Pencaker',
            'user' => $user,
            'id_pencaker' => $id_pencaker,
            'isDocumentComplete' => $isDocumentComplete,
            'isDataComplete' => $isDataComplete,
            'logs' => $logs,
            'timelines' => $timelines
        ];

        return $this->loadView('pencaker/dashboard', $data);
    }


    // Generate nomor pendaftaran
    public function nomorpendaftaran()
    {
        $pencakerModel = new PencakerModel();
        $lastEntry = $pencakerModel->generate_nopendaftaran();

        if ($lastEntry) {
            $lastNoUrut = intval($lastEntry['nopendaftaran']);
            $nourut = $lastNoUrut + 1;
        } else {
            $nourut = 1;
        }

        $tgl = date('dmY');
        $batas = str_pad($nourut, 6, "0", STR_PAD_LEFT);
        $nopendaftaran = "9202" . $tgl . $batas;
        return $nopendaftaran;
    }

    public function profil_pencaker()
    {
        $bahasaModel = new BahasaModel();
        $bahasa = $bahasaModel->findAll();

        $jenjangPendidikan = new JenjangpendidikanModel();
        $jenjang = $jenjangPendidikan->findAll();

        $usersModel = new UsersModel();
        $userId = user()->id;

        // Ambil data pengguna berdasarkan user ID
        $user = $usersModel->find($userId);
        $pencakerModel = new PencakerModel();

        $id_pencaker = $pencakerModel->get_pencaker_id_by_user_id($user['id']);

        // Dapatkan nomor pendaftaran yang di-generate oleh sistem
        $nopendaftaran = $this->nomorpendaftaran();

        $data = [
            'title' => 'Profil Pencari Kerja',
            'jenjang' => $jenjang,
            'user' => $user,
            'nopendaftaran' => $nopendaftaran,
            'bahasa' => $bahasa,
            'id_pencaker' => $id_pencaker
        ];

        return $this->loadView('pencaker/profil_pencaker', $data);
    }

    public function save_data_tujuan()
    {
        $pencakerModel = new PencakerModel();

        $userId = $this->request->getPost('id_pencaker');

        $data = [
            'user_id' => $userId,
            'tujuan' => $this->request->getPost('tujuan'),
        ];

        // Check if user already exists in the pencaker table
        $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

        if ($existingPencaker) {
            // Update the existing record
            $pencakerModel->update($existingPencaker['id'], $data);
        } else {
            // Insert a new record
            $pencakerModel->insert($data);
        }

        return $this->response->setStatusCode(200)->setBody('Data berhasil disimpan');
    }

    public function get_data_tujuan($id)
    {
        $pencakerModel = new PencakerModel();
        $data = $pencakerModel->where('user_id', $id)->first();
        return $this->response->setJSON($data);
    }


    public function save_data_keterangan_umum()
    {
        $pencakerModel = new PencakerModel();

        $userId = $this->request->getPost('id_pencaker');
        $nopendaftaran = $this->request->getPost('nopendaftaran');
        $qrcode = $this->generate_qr_code($nopendaftaran);

        $data = [
            'user_id' => $userId,
            'nopendaftaran' => $this->request->getPost('nopendaftaran'),
            'nik' => $this->request->getPost('nik'),
            'namalengkap' => $this->request->getPost('namalengkap'),
            'nohp' => $this->request->getPost('nohp'),
            'email' => $this->request->getPost('email'),
            'jenkel' => $this->request->getPost('jenkel'),
            'tempatlahir' => $this->request->getPost('tempatlahir'),
            'tgllahir' => $this->request->getPost('tgllahir'),
            'statusnikah' => $this->request->getPost('statusnikah'),
            'agama' => $this->request->getPost('agama'),
            'tinggibadan' => $this->request->getPost('tinggibadan'),
            'beratbadan' => $this->request->getPost('beratbadan'),
            'alamat' => $this->request->getPost('alamat'),
            'kodepos' => $this->request->getPost('kodepos'),
            'keterangan_status' => 'Registrasi',
            'qr_code' => $qrcode,
        ];

        // Check if user already exists in the pencaker table
        $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

        if ($existingPencaker) {
            // Update the existing record
            $pencakerModel->update($existingPencaker['id'], $data);
        } else {
            // Insert a new record
            $pencakerModel->insert($data);
        }

        // Generate QR code
        $this->generate_qr_code($data['nopendaftaran']);

        return $this->response->setStatusCode(200)->setBody('Data berhasil disimpan');
    }

    public function generate_qr_code($nopendaftaran)
    {
        $qrCode = new QrCode(site_url("admin/validasi_ak1/" . sha1($nopendaftaran)));
        $qrCode->setSize(300);

        $writer = new PngWriter();
        $qrImage = $writer->write($qrCode);

        // Directory where QR codes will be saved
        $directory = FCPATH . 'uploads/pencaker/qrcode/';

        // Ensure the directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $qrName = $nopendaftaran . '.png';
        $qrImage->saveToFile($directory . $qrName);

        return $qrName;
    }

    public function validasi_ak1($code)
    {
        $pencakerModel = new PencakerModel();
        $getPencaker = $pencakerModel->validasi_ak1($code);
        $data['v_msg'] = new \stdClass();

        if (count($getPencaker) > 0) {
            $data['v_msg']->valid = "Kartu Anda Valid dan Terdaftar di Sistem Dinas Tenaga Kerja dan Transmigrasi Kabupaten Manokwari";
            $data['v_msg']->code = TRUE;
            $data['v_msg']->pencaker = $getPencaker[0];
        } else {
            $data['v_msg']->valid = "Maaf, Kartu Anda Tidak Terdaftar di Sistem Disnakertrans Manokwari!";
            $data['v_msg']->code = FALSE;
        }

        $data['page'] = new \stdClass();
        $data['page']->menu = 'dashboard';
        $data['page']->title = 'Pelatihan';

        echo view('frontend/validasi_ak1', $data);
    }


    public function get_data_keterangan_umum($id)
    {
        $pencakerModel = new PencakerModel();
        $data = $pencakerModel->where('user_id', $id)->first();
        return $this->response->setJSON($data);
    }

    public function save_data_pendidikan()
    {
        $pendidikanModel = new PendidikanModel();

        $pencaker_id = $this->request->getPost('pencaker_id');
        $jenjang_pendidikan_id = $this->request->getPost('jenjang');

        $data = [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'tahunmasuk' => $this->request->getPost('tahunmasuk'),
            'tahunlulus' => $this->request->getPost('tahunlulus'),
            'ipk' => $this->request->getPost('ipk'),
            'keterampilan' => $this->request->getPost('keterampilan'),
            'pencaker_id' => $pencaker_id,
            'jenjang_pendidikan_id' => $jenjang_pendidikan_id
        ];

        // Cek apakah data dengan pencaker_id dan jenjang_pendidikan_id sudah ada
        $existingData = $pendidikanModel->where('pencaker_id', $pencaker_id)
            ->where('jenjang_pendidikan_id', $jenjang_pendidikan_id)
            ->first();

        if ($existingData) {
            // Jika data sudah ada, lakukan update
            $pendidikanModel->update($existingData['id'], $data);
            $response = [
                'status' => 'success',
                'message' => 'Data pendidikan berhasil diperbarui.'
            ];
        } else {
            // Jika data belum ada, lakukan insert
            if ($pendidikanModel->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data pendidikan berhasil disimpan.'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data pendidikan.'
                ];
            }
        }

        return $this->response->setJSON($response);
    }

    public function fetch_data_pendidikan()
    {
        $pendidikanModel = new PendidikanModel();
        $request = service('request');

        // Ambil pencaker_id dari request
        $pencaker_id = $this->request->getPost('pencaker_id');

        // Panggil metode dari model
        $pendidikan = $pendidikanModel->getPendidikanByPencakerId($pencaker_id);

        $data = [];
        $no = 1;
        foreach ($pendidikan as $pd) {
            $data[] = [
                'no' => $no++,
                'tahunmasuk' => $pd['tahunmasuk'],
                'tahunlulus' => $pd['tahunlulus'],
                'jenjang' => $pd['jenjang'],
                'nama_sekolah' => $pd['nama_sekolah'],
                'ipk' => $pd['ipk'],
                'keterampilan' => $pd['keterampilan'],
                'aksi' => '<div class="btn-group" role="group" aria-label="Actions">
                       <button class="btn btn-primary btn-sm editPendidikan" data-id="' . $pd['id'] . '" data-pencaker_id="' . $pd['pencaker_id'] . '" title="Edit Pendidikan">
                           <i class="bi bi-pencil-fill"></i>
                       </button>
                       <button class="btn btn-danger btn-sm deletePendidikan" data-id="' . $pd['id'] . '" title="Hapus Pendidikan">
                           <i class="bi bi-trash"></i>
                       </button>
                   </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }


    public function get_pendidikan_by_id()
    {
        $request = service('request');
        $id = $request->getPost('id'); // Ambil ID dari POST data

        $model = new PendidikanModel(); // Buat instance model PendidikanModel

        $pendidikan = $model->find($id); // Ambil data pendidikan berdasarkan ID

        if ($pendidikan) {
            // Jika data pendidikan ditemukan, kirim respons JSON
            return $this->response->setJSON($pendidikan)->setStatusCode(200);
        } else {
            // Jika data tidak ditemukan, kirim respons error
            return $this->response->setJSON(['message' => 'Data pendidikan tidak ditemukan'])->setStatusCode(404);
        }
    }

    public function update_data_pendidikan()
    {
        $request = service('request');

        // Ambil data dari POST request
        $data = [
            'id' => $request->getPost('id'),
            'nama_sekolah' => $request->getPost('nama_sekolah'),
            'tahunmasuk' => $request->getPost('tahunmasuk'),
            'tahunlulus' => $request->getPost('tahunlulus'),
            'ipk' => $request->getPost('ipk'),
            'keterampilan' => $request->getPost('keterampilan'),
            'jenjang' => $request->getPost('jenjang'),
            'pencaker_id' => user()->id,
        ];

        $model = new PendidikanModel(); // Buat instance model PendidikanModel

        // Lakukan update data pendidikan berdasarkan ID
        if ($model->update($data['id'], $data)) {
            // Jika berhasil update, kirim respons JSON sukses
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            // Jika gagal update, kirim respons JSON error
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }


    public function hapus_data_pendidikan()
    {
        $id = $this->request->getPost('id');
        $model = new PendidikanModel();

        // Hapus data pendidikan dari database berdasarkan id
        if ($model->delete($id)) {
            // Berhasil menghapus, kembalikan respons JSON sukses
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            // Gagal menghapus, kembalikan respons JSON error
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }


    // Penglaman Kerja
    public function save_data_pengalaman_kerja()
    {
        $pengalamanKerjaModel = new PengalamanKerjaModel();

        $pencaker_id = $this->request->getPost('pencaker_id');

        $data = [
            'tahunmasuk' => $this->request->getPost('tahunmasukkerja'),
            'tahunkeluar' => $this->request->getPost('tahunkeluarkerja'),
            'instansi' => $this->request->getPost('instansi'),
            'jabatan' => $this->request->getPost('jabatan'),
            'alasan_berhenti' => $this->request->getPost('alasan_berhenti'),
            'pendapatan_terakhir' => $this->request->getPost('pendapatan_terakhir'),
            'pencaker_id' => $pencaker_id,
        ];

        // Jika data belum ada, lakukan insert
        if ($pengalamanKerjaModel->save($data)) {
            $response = [
                'status' => 'success',
                'message' => 'Data pengalaman kerja berhasil disimpan.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menyimpan data pengalaman kerja.'
            ];
        }


        return $this->response->setJSON($response);
    }

    public function fetch_data_pengalaman_kerja()
    {
        $pengalamanKerjaModel = new PengalamanKerjaModel();

        // Ambil pencaker_id dari request
        $pencaker_id = $this->request->getPost('pencaker_id');

        // Ambil data pendidikan dengan join ke tabel jenjang_pendidikan
        $pekerjaan = $pengalamanKerjaModel->findAll();

        $pekerjaan = $pengalamanKerjaModel->select('pengalaman_kerja.*')
            ->where('pengalaman_kerja.pencaker_id', $pencaker_id)
            ->findAll();

        $data = [];
        $no = 1;
        foreach ($pekerjaan as $pk) {
            $data[] = [
                'no' => $no++,
                'tahunmasuk' => $pk['tahunmasuk'],
                'tahunkeluar' => $pk['tahunkeluar'],
                'instansi' => $pk['instansi'],
                'jabatan' => $pk['jabatan'],
                'alasan_berhenti' => $pk['alasan_berhenti'],
                'pendapatan_terakhir' => $pk['pendapatan_terakhir'],
                'aksi' => '<div class="btn-group" role="group" aria-label="Actions">
                           <button class="btn btn-primary btn-sm editPekerjaan" data-id="' . $pk['id'] . '" data-pencaker_id="' . $pk['pencaker_id'] . '" title="Edit Pekerjaan">
                               <i class="bi bi-pencil-fill"></i>
                           </button>
                           <button class="btn btn-danger btn-sm deletePekerjaan" data-id="' . $pk['id'] . '" title="Hapus Pekerjaan">
                               <i class="bi bi-trash"></i>
                           </button>
                       </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function get_pengalaman_kerja_by_id()
    {
        $request = service('request');
        $id = $request->getPost('id');

        $model = new PengalamanKerjaModel();

        $pekerjaan = $model->find($id);

        if ($pekerjaan) {
            // Jika data pekerjaan ditemukan, kirim respons JSON
            return $this->response->setJSON($pekerjaan)->setStatusCode(200);
        } else {
            // Jika data tidak ditemukan, kirim respons error
            return $this->response->setJSON(['message' => 'Data pekerjaan tidak ditemukan'])->setStatusCode(404);
        }
    }

    public function update_data_pengalaman_kerja()
    {
        $request = service('request');

        // Ambil data dari POST request
        $data = [
            'id' => $request->getPost('id'),
            'tahunmasuk' => $request->getPost('tahunmasukkerja'),
            'tahunkeluar' => $request->getPost('tahunkeluarkerja'),
            'instansi' => $request->getPost('instansi'),
            'jabatan' => $request->getPost('jabatan'),
            'alasan_berhenti' => $request->getPost('alasan_berhenti'),
            'pendapatan_terakhir' => $request->getPost('pendapatan_terakhir'),
            'pencaker_id' => user()->id,
        ];

        if (empty($data['id'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID is missing'])->setStatusCode(400);
        }

        $model = new PengalamanKerjaModel(); // Buat instance model PengalamanKerjaModel

        // Lakukan update data pendidikan berdasarkan ID
        if ($model->update($data['id'], $data)) {
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }

    public function hapus_data_pengalaman_kerja()
    {
        $id = $this->request->getPost('id');
        $model = new PengalamanKerjaModel();

        // Hapus data pendidikan dari database berdasarkan id
        if ($model->delete($id)) {
            // Berhasil menghapus, kembalikan respons JSON sukses
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            // Gagal menghapus, kembalikan respons JSON error
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }

    //  Minat Jabatan
    public function save_data_minat_jabatan()
    {
        $jabatanModel = new JabatanModel();
        $pencakerModel = new PencakerModel(); // Tambahkan model PencakerModel

        $pencaker_id = $this->request->getPost('id_pencaker');

        $dataJabatan = [
            'pencaker_id' => $pencaker_id,
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'lokasi_jabatan' => $this->request->getPost('lokasi_jabatan'),
        ];

        $dataPencaker = [
            'lokasi_jabatan' => $this->request->getPost('lokasi_jabatan'),
        ];

        // Check if user already exists in the minat_jabatan table
        $existingJabatan = $jabatanModel->where('pencaker_id', $pencaker_id)->first();

        if ($existingJabatan) {
            // Update the existing record in minat_jabatan table
            $jabatanModel->update($existingJabatan['id'], $dataJabatan);
        } else {
            // Insert a new record into minat_jabatan table
            $jabatanModel->insert($dataJabatan);
        }

        // Update the lokasi_jabatan in pencaker table using user_id
        $existingPencaker = $pencakerModel->where('user_id', $pencaker_id)->first();
        if ($existingPencaker) {
            $pencakerModel->update($existingPencaker['id'], $dataPencaker);
        }

        return $this->response->setStatusCode(200)->setBody('Data berhasil disimpan');
    }


    public function get_data_minat_jabatan($id)
    {
        $jabatanModel = new JabatanModel();
        $data = $jabatanModel->where('pencaker_id', $id)->first();
        return $this->response->setJSON($data);
    }


    public function save_data_perusahaan_tujuan()
    {
        $perusahaanModel = new PerusahaanModel();
        $pencakerModel = new PencakerModel(); // Tambahkan model PencakerModel

        // $id = $this->request->getPost('id');  // Ambil id perusahaan jika ada
        $pencaker_id = $this->request->getPost('pencaker_id');
        // $user_id = $this->request->getPost('user_id'); // Dapatkan user_id dari form

        $dataPerusahaan = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'nohp_perusahaan' => $this->request->getPost('nohp_perusahaan'),
            'alamat_perusahaan' => $this->request->getPost('alamat_perusahaan'),
            'pencaker_id' => $pencaker_id,
        ];

        $dataPencaker = [
            'tujuan_perusahaan' => $this->request->getPost('nama_perusahaan'),
        ];

        // Cek apakah data dengan pencaker_id tersebut sudah ada di database
        $existingData = $perusahaanModel->where('pencaker_id', $pencaker_id)->first();

        if ($existingData) {
            // Jika data sudah ada, lakukan update
            $perusahaanModel->update($existingData['id'], $dataPerusahaan);
        } else {
            // Jika data belum ada, lakukan insert
            if ($perusahaanModel->insert($dataPerusahaan)) {
                // Tidak ada aksi khusus yang perlu dilakukan di sini
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data perusahaan tujuan.'
                ];
                return $this->response->setJSON($response);
            }
        }

        // Update the tujuan_perusahaan in pencaker table using user_id
        $existingPencaker = $pencakerModel->where('user_id', $pencaker_id)->first();
        if ($existingPencaker) {
            $pencakerModel->update($existingPencaker['id'], $dataPencaker);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data perusahaan tujuan berhasil disimpan.'
        ];
        return $this->response->setJSON($response);
    }

    public function get_perusahaan_tujuan_by_id($id)
    {
        $perusahaanModel = new PerusahaanModel();
        $data = $perusahaanModel->where('pencaker_id', $id)->first();
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan.'], 404);
        }
    }


    // Data Tambahan
    public function save_catatan_pengantar()
    {
        $pencakerModel = new PencakerModel();

        $userId = $this->request->getPost('id_pencaker');
        $catatanPengantar = $this->request->getPost('catatan_pengantar');

        // Validasi input (opsional)
        if (empty($userId) || empty($catatanPengantar)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID Pencaker dan Catatan Pengantar harus diisi.',
            ]);
        }

        // Data untuk diupdate
        $data = [
            'catatan_pengantar' => $catatanPengantar,
        ];

        // Cari data pencaker berdasarkan user_id
        $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

        if ($existingPencaker) {
            // Jika data sudah ada, lakukan update
            $pencakerModel->update($existingPencaker['id'], $data);
        } else {
            // Jika data belum ada, lakukan insert
            $data['user_id'] = $userId;
            $pencakerModel->insert($data);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Catatan pengantar berhasil disimpan.',
        ]);
    }

    public function get_catatan_pengantar_by_id($id)
    {
        $pencakerModel = new PencakerModel();
        $data = $pencakerModel->where('user_id', $id)->first();
        return $this->response->setJSON($data);
    }

    public function save_bahasa()
    {
        $pencakerModel = new PencakerModel();

        $userId = $this->request->getPost('id_pencaker');
        $keterampilanBahasa = $this->request->getPost('keterampilan_bahasa');
        $bahasaLainnya = $this->request->getPost('bahasa_lainnya');

        // Validasi input (opsional)
        if (empty($userId) || (empty($keterampilanBahasa) && empty($bahasaLainnya))) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID Pencaker dan keterampilan bahasa atau bahasa lainnya harus diisi.',
            ]);
        }

        // Data untuk diupdate
        $data = [
            'keterampilan_bahasa' => $keterampilanBahasa,
            'bahasa_lainnya' => $bahasaLainnya
        ];

        // Cari data pencaker berdasarkan user_id
        $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

        if ($existingPencaker) {
            // Jika data sudah ada, lakukan update
            $pencakerModel->update($existingPencaker['id'], $data);
        } else {
            // Jika data belum ada, lakukan insert
            $data['user_id'] = $userId;
            $pencakerModel->insert($data);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data keterampilan bahasa berhasil disimpan.',
        ]);
    }


    public function get_bahasa_pencaker_by_id($id)
    {
        $pencakerModel = new PencakerModel();
        $data = $pencakerModel->where('user_id', $id)->first();
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan.'], 404);
        }
    }


    // Upload Dokumen
    public function dokumen_pencaker()
    {
        // Paket paneggil data user dari tabel Users agar bisa diparsing dalam halaman view formdata_pencaker
        $usersModel = new UsersModel();
        $userId = user()->id;
        $user = $usersModel->find($userId);

        $dokumenModel = new DokumenModel();
        $jenis_dokumen = $dokumenModel->findAll();
        $data = [
            'title' => 'Review Data dan Dokumen Pencari Kerja',
            'jenis_dok' => $jenis_dokumen,
            'user' => $user,
        ];

        return $this->loadView('pencaker/dokumen_pencaker', $data);
    }


    public function dokajax()
    {
        $dokumenModel = new DokumenModel();
        $dokumenPencakerModel = new DokumenPencakerModel();

        $dokumen = $dokumenModel->findAll();

        $data = [];
        $no = 1;

        foreach ($dokumen as $dok) {

            $pencakerDokumen = $dokumenPencakerModel->where('dokumen_id', $dok['id'])
                ->where('pencaker_id', user()->id)
                ->first();

            if ($pencakerDokumen) {
                // Dapatkan NIK dari pengguna yang sedang login
                $nik = user()->nik;
                // Buat URL dengan menyertakan folder NIK
                $fileUrl = base_url('uploads/dokumen_pencaker/' . $nik . '/' . $pencakerDokumen['namadokumen']);

                $data[] = [
                    "no" => $no++,
                    "jenis" => $dok['jenis_dokumen'],
                    "nama" => $pencakerDokumen['namadokumen'],
                    "tgl" => $pencakerDokumen['tgl_upload'],
                    "aksi" => '<div class="btn-group" role="group" aria-label="Actions">
                           <a href="' . $fileUrl . '" target="_blank" class="btn btn-info btn-sm" title="Detail Dokumen">
                               <i class="bi bi-search"></i>
                           </a>
                           <button class="btn btn-danger btn-sm deleteDokumen" data-id="' . $pencakerDokumen['id'] . '" title="Hapus Dokumen">
                               <i class="bi bi-trash"></i>
                           </button>
                       </div>'
                ];
            } else {
                $data[] = [
                    "no" => $no++,
                    "jenis" => $dok['jenis_dokumen'],
                    "nama" => '-',
                    "tgl" => '-',
                    "aksi" => '<div class="btn-group" role="group" aria-label="Actions">
                           <a data-id="' . $dok['id'] . '"  data-jenis="' . $dok['jenis_dokumen'] . '"  data-toggle="modal" data-target="#uploadDokumenModal" class="btn btn-success btn-sm uplodDokumenBTN" title="Upload Dokumen">
                               <i class="bi bi-upload"></i>
                           </a>
                       </div>'
                ];
            }
        }

        echo json_encode(["data" => $data]);
    }


    public function upload_dokumen()
    {
        $validationRules = [
            'dokumen_id' => 'required|numeric',
            'jenis_dokumen' => 'required',
            'file' => 'uploaded[file]|max_size[file,256]'
        ];

        if (!$this->validate($validationRules)) {
            $response['success'] = false;
            $response['errors'] = $this->validator->getErrors();
            return $this->response->setJSON($response);
        }

        $dokumenId = $this->request->getPost('dokumen_id');
        $jenisDokumen = $this->request->getPost('jenis_dokumen');
        $file = $this->request->getFile('file');

        $nik = user()->nik;

        $fileExtension = $file->getClientExtension();
        $newFileName = $nik . '_' . str_replace(' ', '-', strtoupper($jenisDokumen)) . '.' . $fileExtension;

        $uploadPath = FCPATH . 'uploads/dokumen_pencaker/' . $nik . '/';

        // Cek apakah folder dengan nama NIK sudah ada, jika tidak, buat folder baru
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $model = new DokumenPencakerModel();
        $existingDokumen = $model->where(['pencaker_id' => user()->id, 'dokumen_id' => $dokumenId])->first();

        if ($existingDokumen) {
            // Hapus file lama jika ada
            $oldFilePath = $uploadPath . $existingDokumen['namadokumen'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            // Update data dengan file baru
            $data = [
                'namadokumen' => $newFileName,
                'tgl_upload' => date('Y-m-d H:i:s')
            ];
            $model->update($existingDokumen['id'], $data);
        } else {
            // Insert data baru
            $data = [
                'namadokumen' => $newFileName,
                'tgl_upload' => date('Y-m-d H:i:s'),
                'pencaker_id' => user()->id,
                'dokumen_id' => $dokumenId,
            ];
            $model->insert($data);
        }

        if (!$file->move($uploadPath, $newFileName)) {
            $response['success'] = false;
            $response['errors'] = ['Failed to upload file.'];
            return $this->response->setJSON($response);
        }

        $response['success'] = true;
        $response['message'] = 'File berhasil diunggah.';
        return $this->response->setJSON($response);
    }


    public function hapus_dokumen()
    {
        $id = $this->request->getPost('id');
        $model = new DokumenPencakerModel();

        $dokumen = $model->find($id);
        if (!$dokumen) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'dokumen tidak ditemukan'])->setStatusCode(404);
        }

        // Hapus gambar dari direktori jika ada
        $file_dokumen = $dokumen['namadokumen'];
        if (!empty($file_dokumen)) {
            $nik = user()->nik; // Pastikan Anda mendapatkan NIK dari user
            $path = FCPATH . 'uploads/dokumen_pencaker/' . $nik . '/' . $file_dokumen;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if ($model->delete($id)) {
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }

    public function pengaturan()
    {
        $userId = user()->id; // Mengambil user ID dari sesi
        $dokumenId = 1; // ID dokumen yang diinginkan

        // Load model
        $pencakerModel = new PencakerModel();

        // Panggil metode dari model
        $dokumen = $pencakerModel->getDokumenByUserId($userId, $dokumenId);

        $data = [
            'title' => 'Pengaturan Profile',
            'dokumen' => $dokumen,
        ];

        return $this->loadView('pencaker/myprofile', $data);
    }

    public function minta_verifikasi()
    {
        $pencakerModel = new PencakerModel();
        $usersModel = new UsersModel();
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

            // Ambil data nomor telepon dan nama lengkap dari tabel users
            $user = $usersModel->find($userId);
            if (!$user) {
                return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'Data pengguna tidak ditemukan.']);
            }

            $phoneNumber = $user['nohp'];
            $namaLengkap = $user['namalengkap'];

            // Format pesan yang akan dikirim
            $message = "*Notifikasi disnakertransmkw.com*" . PHP_EOL . PHP_EOL .
                "Hi, *" . $namaLengkap . "*," . PHP_EOL .
                "Data dan dokumen Anda telah berhasil dikirim untuk diverifikasi." .
                "Selanjutnya, silakan menunggu notifikasi validasi dari Sistem Disnakertrans Manokwari." . PHP_EOL . PHP_EOL .
                "*<noreply>*";

            $settingsModel = new SettingsModel();

            // Ambil userkey dan passkey dari settings
            $userKey = $settingsModel->getValueByKey('whatsapp_userkey');
            $passKey = $settingsModel->getValueByKey('whatsapp_passkey');
            $admin = $settingsModel->getValueByKey('whatsapp_admin');

            // Kirim pesan WhatsApp menggunakan API Zenziva
            log_message('debug', 'Sending WhatsApp message with data: ' . json_encode([
                'userkey' => $userKey,
                'passkey' => $passKey,
                'to' => $phoneNumber,
                'message' => $message,
                'admin' => $admin
            ]));

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
            'message' => $message,
            'admin' => $admin
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            log_message('error', 'Error sending WhatsApp message: ' . json_encode($data));
            return ['status' => 'error', 'message' => 'Failed to send message'];
        }

        $response = json_decode($result, true);

        return $response;
    }


    public function activity_by_user()
    {
        $activityLogsModel = new ActivitylogsModel();

        // Misalnya user ID didapat dari session atau request
        $userId = user()->id;

        // Ambil log aktivitas berdasarkan user ID
        $logs = $activityLogsModel->getActivityLogs();

        // Contoh: Mengembalikan data sebagai response JSON
        return $this->response->setJSON($logs);
    }


    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}
