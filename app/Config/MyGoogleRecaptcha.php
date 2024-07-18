<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class MyGoogleRecaptcha extends BaseConfig
{
    public $siteKey;
    public $secretKey;

    public function __construct()
    {
        $this->siteKey = getenv('RECAPTCHA_SITE_KEY');
        $this->secretKey = getenv('RECAPTCHA_SECRET_KEY');
    }
}
