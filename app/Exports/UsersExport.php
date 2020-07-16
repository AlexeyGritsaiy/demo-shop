<?php

namespace App\Exports;

use App\Entity\User\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{

    public function collection()
    {
        return User::all();
    }
}