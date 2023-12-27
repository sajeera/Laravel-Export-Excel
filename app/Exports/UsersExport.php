<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return User::query()->with('user');
    }

    public function headings(): array
    {
        return [
            '#',
            'name',
            'email', 
            'Created At'
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email, 
            $user->created_at
        ];
    }

    public function fields(): array
    {
        return [
            'id',
            'name',
            'mail',
            'created_at'
        ];
    }
}