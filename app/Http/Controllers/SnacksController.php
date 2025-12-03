<?php

namespace App\Http\Controllers;

use App\Models\Snacks;
use Illuminate\Http\Request;

class SnacksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $snack = Snacks::latest()->paginate(5);

        return view('pages.menus.snack', compact('snack'));
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

        Snacks::create([
            'nama_menu' => $request->input('name'),
            'harga' => $request->input('price'),
            'created_at' => now(),
        ]);

        return redirect()->route($jenis . '.' . $jenis)->with('success', ucfirst($jenis) . ' baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Snacks $snacks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Snacks $snacks)
    {
        $jenis = $request->segment(2);

        $title = 'Edit ' . ucfirst($jenis);
        $url = route($jenis . '.update', $snacks->id);
        $form = collect([
            [
                'type' => 'text',
                'name' => 'name',
                'label' => 'Nama Menu',
                'placeholder' => 'Masukkan nama menu',
                'value' => $snacks->name,
                'required' => true,
            ],
            [
                'type' => 'number',
                'name' => 'price',
                'label' => 'Harga',
                'placeholder' => 'Masukkan harga menu',
                'value' => $snacks->price,
                'required' => true,
            ],
            [
                'type' => 'select',
                'name' => 'status',
                'label' => 'Status',
                'options' => ['Aktif' => 'Aktif', 'Non-aktif' => 'Non-aktif'],
                'placeholder' => 'Pilih status',
                'value' => $snacks->status,
                'required' => true,
            ]
        ]);

        return view('forms.edit', compact('title', 'url', 'form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Snacks $snacks)
    {
        $jenis = $request->segment(2);

        $snacks->update([
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
    public function destroy(Request $request, Snacks $snacks)
    {
        $snacks->delete();

        $jenis = $request->segment(2);
        return redirect()->route($jenis . '.' . $jenis)->with('success', ucfirst($jenis) . ' berhasil dihapus.');
    }
}
