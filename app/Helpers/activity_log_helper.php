<?php

if (!function_exists('log_activity')) {
    function log_activity($title, $user)
    {
        $db = \Config\Database::connect();
        $activityLogModel = new \App\Models\ActivityLogModel();

        $ipAddress = $_SERVER['REMOTE_ADDR'];

        $data = [
            'title'      => $title,
            'user'       => $user,
            'ip_address' => $ipAddress
        ];

        $activityLogModel->save($data);
    }
}
