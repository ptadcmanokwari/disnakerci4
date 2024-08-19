<?php

if (!function_exists('tanggal_indo')) {
    function tanggal_indo($timestamp, $cetak_hari = false, $cetak_jam = false)
    {
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        // Memisahkan komponen tanggal dan waktu dari timestamp
        $tanggal_waktu = explode(' ', $timestamp);
        $tanggal = $tanggal_waktu[0];
        $waktu = isset($tanggal_waktu[1]) ? $tanggal_waktu[1] : '';

        $split = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            $tgl_indo = $hari[$num] . ', ' . $tgl_indo;
        }

        if ($cetak_jam) {
            return $tgl_indo . ' ' . $waktu;
        }

        return $tgl_indo;
    }

    if (!function_exists('waktu_indo')) {
        function waktu_indo($timestamp)
        {
            // Memisahkan komponen tanggal dan waktu dari timestamp
            $tanggal_waktu = explode(' ', $timestamp);
            $waktu = isset($tanggal_waktu[1]) ? $tanggal_waktu[1] : '';

            // Memisahkan jam, menit, dan detik
            $waktu_parts = explode(':', $waktu);

            // Mengembalikan hanya jam dan menit
            return $waktu_parts[0] . ':' . $waktu_parts[1];
        }
    }
}
