<?php

namespace App\Exports;

use App\Models\Billing;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BillingsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Billing::query()->with('user');
    }

    public function headings(): array
    {
        return [
            'Id',
            'User Id',
            'Amount',
            'Description', 
            'Created At'
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->user_id,
            $user->amount,
            $user->decription, 
            $user->created_at
        ];
    }

    public function fields(): array
    {
        return [
            'id',
            'user_id',
            'amount',
            'decription',
            'created_at'
        ];
    }
}