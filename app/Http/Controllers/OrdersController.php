<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::latest()->paginate(5);

        return view('pages.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function detail(Orders $orders, $id)
    {
        $orders = Orders::with('orderDetails')->findOrFail($id);

        return view('pages.orders.show', compact('orders'));
    }

    public function show(Orders $orders, $id)
    {
        $orders = Orders::with('orderDetails')->findOrFail($id);

        return view('pages.reports.show', compact('orders'));
    }

    public function print(int $id)
    {
        // 1. Ambil data pesanan (Orders) berdasarkan ID, termasuk detailnya (orderDetails)
        $order = Orders::with('orderDetails')->findOrFail($id);

        // 2. Kirim data ke view khusus untuk pencetakan nota
        // View ini akan berisi HTML/CSS yang diformat untuk printer thermal dan script window.print()
        return view('forms.nota', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        // Cukup muat relasi yang dibutuhkan
        $orders->load('orderDetails');

        // $orders sekarang berisi data pesanan yang dicari
        return view('pages.orders.edit', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        // Tambahkan validasi formal
        $request->validate([
            'cash_paid' => 'required|string',
            'change_amount' => 'nullable|string',
        ]);

        // 1. Bersihkan, Konversi ke INT
        // Diasumsikan format yang masuk adalah '1.000.000'
        $cashPaidInput = str_replace('.', '', $request->cash_paid);
        $cashPaid = (int) $cashPaidInput;

        // Total amount dari model (pastikan ini juga int)
        $totalAmount = (int) $orders->total_amount;

        // 2. Tentukan apakah pembayaran mencukupi
        $isPaid = $cashPaid >= $totalAmount;

        // =======================================================
        // ✅ VALIDASI UTAMA BACKEND
        // Pengecekan: Jika pembayaran kurang TAPI kita ingin mengubah status menjadi 'Dibayar'
        // Logika ini mencegah penyimpanan data kurang bayar dengan status LUNAS.
        // =======================================================
        if ($orders->payment_method == 'Tunai' && $orders->payment_status == 'Belum Dibayar' && !$isPaid) {
            // Jika nominal bayar kurang dari total amount
            return redirect()->back()
                ->withInput() // Opsional: mempertahankan input yang sudah diisi
                ->with('error', 'Nominal Bayar (Rp ' . number_format($cashPaid, 0, ',', '.') . ') kurang dari Total Pesanan (Rp ' . number_format($totalAmount, 0, ',', '.') . '). Harap periksa kembali nominal bayar!');
        }

        // 3. Re-Kalkulasi Kembalian (hanya jika pembayaran mencukupi)
        $changeAmount = $isPaid ? ($cashPaid - $totalAmount) : 0;
        $changeAmount = (int) $changeAmount;

        $updateData = [
            'cash_paid' => $cashPaid,
            'change_amount' => $changeAmount,
        ];

        // Logika Pembaruan Payment Status
        // Kita hanya set status ke 'Dibayar' JIKA pembayaran tunai dan sudah LUNAS ($isPaid)
        if ($orders->payment_method == 'Tunai' && $orders->payment_status == 'Belum Dibayar' && $isPaid) {
            $updateData['payment_status'] = 'Dibayar';
        }

        // *OPSIONAL: Jika Anda ingin menetapkan status "Kurang Bayar" jika kurang:*
        // else if ($orders->payment_method == 'Tunai' && $orders->payment_status == 'Belum Dibayar' && !$isPaid) {
        //     $updateData['payment_status'] = 'Kurang Bayar'; // Jika model Anda memiliki status ini
        // }

        // 4. Simpan Perubahan
        $orders->update($updateData);

        // 5. Redirect
        return redirect()->route('orders.index')->with('success', 'Nominal pembayaran dan status pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
