<?php

/**
 * Created by PhpStorm.
 * User: maowandong
 * Date: 2016/8/17
 * Time: 11:44
 */
class Util
{
    /**
     * HTTP POST
     * @param $url
     * * @param $data
     * @param $timeout
     * * @param $header
     * @return array
     */
    public static function curlPost($url, $data, $timeout = 5, $header = '', $dataType) {
        $ch = curl_init();
        if (!empty($header) && is_array($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POST, 1);

        if ($dataType == 'json') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            return false;
        }

        curl_close($ch);
        if ($http_status != 200) {
            return false;
        }
        return $result;
    }
}