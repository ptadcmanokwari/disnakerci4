<?php

namespace App\Models;

use CodeIgniter\Model;

class PencakerModel extends Model
{
    protected $table = 'pencaker';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'namalengkap', 'tempatlahir', 'tgllahir', 'jenkel', 'alamat', 'kodepos', 'statusnikah', 'tinggibadan', 'beratbadan',
        'agama', 'nik', 'nohp', 'nopendaftaran', 'tujuan', 'lokasi_jabatan', 'tujuan_perusahaan', 'catatan_pengantar', 'keterampilan_bahasa',
        'bahasa_lainnya', 'keterangan_status', 'qr_code', 'user_id'
    ];

    // datatables server side
    public function getPencakerWithUser($filter = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('pencaker.*, users.nohp, users.email');
        $builder->join('users', 'users.id = pencaker.user_id');

        if ($filter) {
            $builder->where('pencaker.keterangan_status', $filter);
        }

        return $builder->get()->getResultArray();
    }

    public function savePencaker($data)
    {
        return $this->save($data); // Menyimpan data dengan menggunakan metode save
    }

    // Contoh method tambahan untuk mengambil statistik umur pencaker
    public function getUmurStatistik()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT (YEAR(CURDATE())-YEAR(tgllahir)) AS umur, COUNT((YEAR(CURDATE())-YEAR(tgllahir))) AS jumlah FROM pencaker GROUP BY umur ORDER BY umur ASC");
        return $query->getResult();
    }

    // Contoh method tambahan untuk menghitung jumlah pencaker
    public function countPencaker()
    {
        return $this->countAll();
    }

    // Status Halaman Dashboard
    public function getStatusByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    public function getDokumenByUserId($userId, $dokumenId)
    {
        return $this->db->table('pencaker_dokumen')
            ->select('namadokumen')
            ->where('pencaker_id', $userId)
            ->where('dokumen_id', $dokumenId)
            ->get()
            ->getRow();
    }


    public function countByStatus($status)
    {
        return $this->where('keterangan_status', $status)->countAllResults();
    }

    public function countByPendidikan()
    {
        return $this->db->table('pendidikan_pencaker')
            ->select('jenjang_pendidikan.jenjang AS pendidikan_terakhir, COUNT(*) AS jumlah')
            ->join('jenjang_pendidikan', 'pendidikan_pencaker.jenjang_pendidikan_id = jenjang_pendidikan.id')
            ->groupBy('jenjang_pendidikan.jenjang')
            ->get()
            ->getResultArray();
    }

    public function countByUsia()
    {
        return $this->select("CASE
                                WHEN YEAR(CURDATE()) - YEAR(tgllahir) BETWEEN 18 AND 25 THEN '18-25'
                                WHEN YEAR(CURDATE()) - YEAR(tgllahir) BETWEEN 26 AND 35 THEN '26-35'
                                WHEN YEAR(CURDATE()) - YEAR(tgllahir) BETWEEN 36 AND 45 THEN '36-45'
                                WHEN YEAR(CURDATE()) - YEAR(tgllahir) > 45 THEN '46+'
                              END AS rentang_usia, COUNT(*) AS jumlah")
            ->groupBy('rentang_usia')
            ->findAll();
    }

    public function getPencakerByGenderAndMonth($year)
    {
        $query = $this->db->query("
            SELECT MONTH(tgllahir) AS bulan, jenkel, COUNT(*) AS jumlah
            FROM pencaker
            WHERE YEAR(tgllahir) = ?
            GROUP BY MONTH(tgllahir), jenkel
            ORDER BY MONTH(tgllahir)
        ", [$year]);

        return $query->getResult();
    }

    public function getNikByPencakerId($pencaker_id)
    {
        return $this->where('id', $pencaker_id)->first();
    }

    public function isDataComplete($userId)
    {
        $data = $this->where('user_id', $userId)->first();
        if ($data) {
            foreach ($this->allowedFields as $field) {
                if (!isset($data[$field]) || empty($data[$field])) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    public function getpendidikanpencaker($id_pencaker)
    {
        $builder = $this->db->query('select pp.nama_sekolah, pp.tahunmasuk, pp.tahunlulus, pp.ipk, pp.keterampilan, jp.jenjang from pencaker p join pendidikan_pencaker pp on pp.pencaker_id = p.id join jenjang_pendidikan jp on jp.id = pp.jenjang_pendidikan_id where p.id = ' . $id_pencaker);
        return $builder->getResultArray();
    }

    public function getpengalamankerjapencaker($id_pencaker)
    {
        $builder = $this->db->query('select pk.instansi, pk.tahunmasuk, pk.tahunkeluar, pk.jabatan, pk.pendapatan_terakhir, pk.alasan_berhenti from pencaker p join pengalaman_kerja pk on pk.pencaker_id = p.id where p.id = ' . $id_pencaker);
        return $builder->getResultArray();
    }

    public function getdokumenpencaker($id_pencaker)
    {
        $builder = $this->db->query('select p.nik, p.namalengkap, namadokumen, d.jenis_dokumen from pencaker p join pencaker_dokumen pd on pd.pencaker_id = p.id join dokumen d on d.id = pd.dokumen_id where p.id = ' . $id_pencaker);
        return $builder->getResultArray();
    }

    public function getpasfotopencaker($id_pencaker)
    {

        $builder = $this->db->query('select p.nik, p.namalengkap, namadokumen, pd.*, d.jenis_dokumen from pencaker p join pencaker_dokumen pd on pd.pencaker_id = p.id join dokumen d on d.id = pd.dokumen_id where d.id = 1 and p.id = ' . $id_pencaker);
        return $builder->getRowArray();
    }


    public function get_pencaker_id_by_user_id($id_user)
    {
        $builder = $this->db->query('select p.id from pencaker p join users u on u.id = p.user_id where u.id =' . $id_user);
        return $builder->getRowArray();
    }

    // Generasi nopendaftaran
    public function generate_nopendaftaran()
    {
        $query = $this->db->query("SELECT RIGHT(nopendaftaran, 6) AS nopendaftaran FROM pencaker ORDER BY nopendaftaran DESC LIMIT 1");
        return $query->getRowArray();
    }


    public function validasi_ak1($code)
    {
        $builder = $this->db->table('pencaker p');
        $builder->select('*, DATE(tu.tglwaktu) AS tglaktifpencaker');
        $builder->join('pencaker_dokumen pd', 'pd.pencaker_id = p.id');
        $builder->join('dokumen d', 'd.id = pd.dokumen_id');
        $builder->join('users u', 'u.id = p.user_id');
        $builder->join('timeline_user tu', 'tu.user_id = u.id');
        $builder->where('d.id', '1');
        $builder->where('tu.timeline_id', '6');
        $builder->where('SHA1(p.nopendaftaran)', $code);

        $query = $builder->get(); // eksekusi query
        return $query->getResultArray(); // ambil hasil sebagai array
    }


    public function get_timeline($userId)
    {
        $builder = $this->db->table('timeline t');
        $builder->select('t.subject, tu.timeline_id, tu.tglwaktu, tu.description');
        $builder->join('timeline_user tu', 'tu.timeline_id = t.id');
        $builder->join('users u', 'u.id = tu.users_id');
        $builder->where('tu.users_id', $userId);

        $query = $builder->get(); // eksekusi query
        return $query->getResultArray(); // ambil hasil sebagai array
    }

    public function getLatestPencaker($limit = 5)
    {
        return $this->where('keterangan_status', 'Verifikasi')
            ->orderBy('id', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}
