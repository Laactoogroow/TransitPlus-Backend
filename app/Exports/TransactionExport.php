<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Mengambil semua data transaksi
     */
    public function collection()
    {
        return Transaction::with(['user', 'ticket'])->get();
    }

    /**
     * Menentukan header untuk file Excel
     */
    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Ticket Name',
            'Quantity',
            'Total Price',
            'Transaction Date',
        ];
    }

    /**
     * Format data untuk setiap baris
     */
    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->user->name ?? 'N/A',
            $transaction->ticket->name ?? 'N/A',
            $transaction->quantity,
            $transaction->total_price,
            $transaction->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
