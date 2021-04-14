<?php


namespace App\Interfaces;


interface URLLoader
{
    public function loadUrl(string $url): string;
}