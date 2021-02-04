<?php


namespace App\Services;


use Spatie\PdfToText\Pdf;

class PdfService
{
    public function searchText(string $word): bool
    {
        $text = '';
        if(request()->hasFile('attachment')) {
            $text = Pdf::getText(request()->file('attachment'));
        }

        return strpos($text, $word) !== false;
    }
}
