<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporpencakerModel extends Model
{
    protected $table = 'lapor_pencaker';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tglwaktu', 'status_kerja', 'urut_lapor', 'pencaker_id'];

    public function nomorUrutLaporPencaker($pencaker_id)
    {
        // Query untuk mendapatkan urut_lapor terbesar berdasarkan pencaker_id
        $query = $this->where('pencaker_id', $pencaker_id)
            ->orderBy('urut_lapor', 'DESC')
            ->first();

        if ($query) {
            // Jika ada hasil, ambil urut_lapor terbesar dan tambahkan 1
            $nourut = intval($query['urut_lapor']) + 1;
        } else {
            // Jika tidak ada hasil, set urut_lapor ke 1
            $nourut = 1;  // Jika belum ada urut_lapor untuk pencaker_id tersebut
        }

        return $nourut;
    }

    public function getLaporKerjaData($pencaker_id, $start, $length, $searchValue)
    {
        $builder = $this->db->table($this->table);
        $builder->select('lapor_pencaker.*, lapor_kerja.nama_perusahaan, lapor_kerja.bidang_perusahaan, lapor_kerja.jabatan, lapor_kerja.no_telp, lapor_kerja.alamat');
        $builder->join('lapor_kerja', 'lapor_kerja.lapor_pencaker_id = lapor_pencaker.id');
        $builder->where('lapor_pencaker.pencaker_id', $pencaker_id);

        if ($searchValue) {
            $builder->like('lapor_kerja.nama_perusahaan', $searchValue)
                ->orLike('lapor_kerja.bidang_perusahaan', $searchValue)
                ->orLike('lapor_kerja.jabatan', $searchValue)
                ->orLike('lapor_kerja.no_telp', $searchValue)
                ->orLike('lapor_kerja.alamat', $searchValue);
        }

        $builder->limit($length, $start);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
