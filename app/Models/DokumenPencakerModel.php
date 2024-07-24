<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenPencakerModel extends Model
{
    protected $table = 'pencaker_dokumen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['namadokumen', 'tgl_upload', 'pencaker_id', 'dokumen_id'];

    public function isDocumentComplete($pencaker_id)
    {
        $requiredDokumenIds = [1, 2, 3];

        foreach ($requiredDokumenIds as $dokumen_id) {
            $data = $this->where('pencaker_id', $pencaker_id)
                ->where('dokumen_id', $dokumen_id)
                ->first();
            if (empty($data)) {
                return false;
            }
        }
        return true;
    }
}
