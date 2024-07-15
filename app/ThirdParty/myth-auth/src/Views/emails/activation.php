<p>Ini email aktivasi untuk akun Anda di <?= site_url() ?>.</p>

<p>Untuk mengaktivasi akun Anda, klik AKTIVASI AKUN di bawah ini.</p>

<p><a class="btn btn-info" href="<?= site_url('activate-account') . '?token=' . $hash ?>">AKTIVASI AKUN</a>.</p>

<br>

<p>Jika Anda tidak melakukan ini, abaikan email ini. Terima kasih!</p>