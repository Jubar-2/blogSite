<?php

namespace App\Libraries;

use CodeIgniter\I18n\Time;

class DateSnippets
{

    public function humanDate($date, $timezoon)
    {
        return Time::parse($date, $timezoon)->humanize();
    }
}
