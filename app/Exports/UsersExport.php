<?php

namespace App\Exports;

use App\Models\User; // Make sure this imports your User model
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection()
    {
        return User::all(); // Retrieves all users from the database
    }
}