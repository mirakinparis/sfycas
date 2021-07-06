<?php

namespace App\Service;

class SfyCASTicketGenerator
{
    public function getTicket(): string
    {
        $bytes = random_bytes(16);
        return bin2hex($bytes);
    }
}