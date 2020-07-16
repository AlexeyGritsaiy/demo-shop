<?php

namespace App\Imports;

use App\Entity\User\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'last_name'    => $row['last_name'],
            'status'    => $row['status'],
            'role'    => $row['role'],
            'password' => \Hash::make($row['password']),
        ]);
    }
}