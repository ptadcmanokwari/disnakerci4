<?php

namespace App\Helpers;

if (!function_exists('tgl_indo')) {
    function tgl_indo($tgl)
    {
        $ubah = gmdate('Y-m-d', strtotime($tgl));
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('bulan')) {
    function bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
            case 2:
                return "Februari";
            case 3:
                return "Maret";
            case 4:
                return "April";
            case 5:
                return "Mei";
            case 6:
                return "Juni";
            case 7:
                return "Juli";
            case 8:
                return "Agustus";
            case 9:
                return "September";
            case 10:
                return "Oktober";
            case 11:
                return "November";
            case 12:
                return "Desember";
        }
    }
}

if (!function_exists('shortdate_indo')) {
    function shortdate_indo($tgl)
    {
        $ubah = gmdate('Y-m-d', strtotime($tgl));
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = short_bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . '/' . $bulan . '/' . $tahun;
    }
}

if (!function_exists('short_bulan')) {
    function short_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "01";
            case 2:
                return "02";
            case 3:
                return "03";
            case 4:
                return "04";
            case 5:
                return "05";
            case 6:
                return "06";
            case 7:
                return "07";
            case 8:
                return "08";
            case 9:
                return "09";
            case 10:
                return "10";
            case 11:
                return "11";
            case 12:
                return "12";
        }
    }
}

if (!function_exists('mediumdate_indo')) {
    function mediumdate_indo($tgl)
    {
        $ubah = gmdate('Y-m-d', strtotime($tgl));
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = medium_bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . '-' . $bulan . '-' . $tahun;
    }
}

if (!function_exists('medium_bulan')) {
    function medium_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Jan";
            case 2:
                return "Feb";
            case 3:
                return "Mar";
            case 4:
                return "Apr";
            case 5:
                return "Mei";
            case 6:
                return "Jun";
            case 7:
                return "Jul";
            case 8:
                return "Ags";
            case 9:
                return "Sep";
            case 10:
                return "Okt";
            case 11:
                return "Nov";
            case 12:
                return "Des";
        }
    }
}

if (!function_exists('longdate_indo')) {
    function longdate_indo($tanggal)
    {
        $ubah = gmdate('Y-m-d', strtotime($tanggal));
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];
        $bulan = bulan($pecah[1]);

        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";
        switch ($nama) {
            case "Sunday":
                $nama_hari = "Minggu";
                break;
            case "Monday":
                $nama_hari = "Senin";
                break;
            case "Tuesday":
                $nama_hari = "Selasa";
                break;
            case "Wednesday":
                $nama_hari = "Rabu";
                break;
            case "Thursday":
                $nama_hari = "Kamis";
                break;
            case "Friday":
                $nama_hari = "Jumat";
                break;
            case "Saturday":
                $nama_hari = "Sabtu";
                break;
        }
        return $nama_hari . ', ' . $tgl . ' ' . $bulan . ' ' . $thn;
    }
}
