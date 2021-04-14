<?php

namespace App\Services;

use App\Interfaces\URLLoader;
use Exception;

class CURLService implements URLLoader
{
    /**
     * Loads resource by url
     * @param string $url URL of destination point
     * @return string Result from point
     * @throws Exception
     */
    public function loadUrl(string $url): string
    {
        // Create curl
        $curl = curl_init($url);

        // Set options
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)",
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CONNECTTIMEOUT => 10,
        ]);

        // Perform
        $returned = curl_exec($curl);

        // If some error
        if(false === $returned) {

            $errorCode = curl_errno($curl);

            if(CURLE_COULDNT_RESOLVE_HOST === $errorCode)
                throw new Exception("Can't resolve server by url('$url')");

            if(CURLE_COULDNT_CONNECT === $errorCode)
                throw new Exception("Server '$url' is inactive.");

            if(CURLE_URL_MALFORMAT === $errorCode)
                throw new Exception("URI('$url') has wrong format.");

            // Unknown error
            throw new Exception("CURL error(#$errorCode) on url('$url')");

        }

        // Close
        curl_close($curl);

        return $returned;
    }
}