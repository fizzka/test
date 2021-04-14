<?php


namespace App\Interfaces;


interface URLLoader
{
    /**
     * Loads resource by url
     * @param string $url URL of destination point
     * @return string Result from point
     */
    public function loadUrl(string $url): string;
}