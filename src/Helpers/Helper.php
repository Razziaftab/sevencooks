<?php

namespace src\Helpers;

class Helper implements IConstants
{
    /**
     * For the Curl API
     *
     * @param $apiUrl
     * @return bool|string|void
     */
    public static function curlAPI($apiUrl)
    {
        // Initialize curl
        $ch = curl_init();

        // Set curl options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        // Execute the request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo self::API_ERROR . curl_error($ch);
            die();
        }

        // Close curl
        curl_close($ch);

        return $response;
    }
}
