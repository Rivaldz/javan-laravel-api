<?php

namespace App\Services;

use App\Models\Contact;

/**
 * Class Services
 * @author yourname
 */
class ContactService
{
    public function treeSilsilah()
    {
        $bapak = Contact::where('status', 'bapak')->get();
        $anak = Contact::where('status', 'anak')->get();
        $cucu = Contact::where('status', '<>', 'anak')->where('status', '<>', 'bapak')->get();
        $arrAnak = [];
        $arrCucu = [];
        foreach ($cucu as $value) {
            $arrCucu[$value->status][] = $value->nama;
        }
        foreach ($anak as $value) {
            $key = "anak_" . strtolower($value->nama);
            $arrAnak[] = [$value->nama, $arrCucu[$key] ?? null];
        }
        return [
            $bapak[0]->nama,
            $arrAnak,

        ];
    }
}
