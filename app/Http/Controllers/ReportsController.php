<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $now = now();
        $before = $now->copy()->subDays(7); // Gunakan copy() agar $now tidak berubah

        // 1. Query Default (tanpa filter tanggal) - HANYA order 'Dibayar'
        $orders = Orders::where('payment_status', 'Dibayar')
            ->latest()
            ->paginate(5);

        // 2. Query dengan Filter Tanggal - HANYA order 'Dibayar'
        if ($request->from_date && $request->to_date) {
            $orders = Orders::where('payment_status', 'Dibayar')
                ->whereBetween(DB::raw('DATE(created_at)'), [$request->from_date, $request->to_date])
                ->get();
        }

        // Catatan: Pastikan Anda telah mengimpor DB di atas file: use Illuminate\Support\Facades\DB;

        return view('pages.reports', compact('orders', 'now', 'before'));
    }
}
