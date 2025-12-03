<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use Illuminate\Http\Request;

class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $makanan = Foods::latest()->paginate(5);

        return view('pages.menus.makanan', compact('makanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = request()->segment(2);

        $title = 'Tambah ' . ucfirst($jenis);
        $url = route($jenis . '.store');
        $form = collect(value: [
            [
                'type' => 'text',
                'name' => 'name',
                'label' => 'Nama Menu',
                'placeholder' => 'Masukkan nama menu',
                'required' => true,
            ],
            [
                'type' => 'number',
                'name' => 'price',
                'label' => 'Harga',
                'placeholder' => 'Masukkan harga menu',
                'required' => true,
            ],
        ]);
        
        return view('forms.create', compact('title', 'url', 'form'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jenis = request()->segment(2);

        Foods::create([
            'nama_menu' => $request->input('name'),
            'harga' => $request->input('price'),
            'created_at' => now(),
        ]);

        return redirect()->route($jenis . '.' . $jenis)->with('success', ucfirst($jenis) . ' baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Foods $foods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Foods $foods)
    {
        $jenis = $request->segment(2);

        $title = 'Edit ' . ucfirst($jenis);
        $url = route($jenis . '.update', $foods->id);
        $form = collect([
            [
                'type' => 'text',
                'name' => 'name',
                'label' => 'Nama Menu',
                'placeholder' => 'Masukkan nama menu',
                'value' => $foods->name,
                'required' => true,
            ],
            [
                'type' => 'number',
                'name' => 'price',
                'label' => 'Harga',
                'placeholder' => 'Masukkan harga menu',
                'value' => $foods->price,
                'required' => true,
            ],
            [
                'type' => 'select',
                'name' => 'status',
                'label' => 'Status',
                'options' => ['Aktif' => 'Aktif', 'Non-aktif' => 'Non-aktif'],
                'placeholder' => 'Pilih status',
                'value' => $foods->status,
                'required' => true,
            ]
        ]);

        return view('forms.edit', compact('title', 'url', 'form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foods $foods)
    {
        $jenis = $request->segment(2);

        $foods->update([
            'nama_menu' => $request->input('nama_menu'),
            'harga' => $request->input('harga'),
            'status' => $request->input('status'),
            'updated_at' => now(),
        ]);

        return redirect()->route($jenis . '.' . $jenis)->with('success', ucfirst($jenis) . ' berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Foods $foods)
    {
        $foods->delete();

        $jenis = $request->segment(2);
        return redirect()->route($jenis . '.' . $jenis)->with('success', ucfirst($jenis) . ' berhasil dihapus.');
    }
}
