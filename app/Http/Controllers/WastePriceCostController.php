<?php

namespace App\Http\Controllers;

use App\Models\WastePriceCost;
use App\Models\WasteCategory;
use Illuminate\Http\Request;

class WastePriceCostController extends Controller
{
    /**
     * Menampilkan formulir untuk membuat biaya limbah.
     */
    public function create()
    {
        // Ambil semua kategori limbah untuk ditampilkan di dropdown
        $wasteCategories = WasteCategory::all();
        dd($wasteCategories);
        return view('waste-price-cost.create', compact('wasteCategories'));
    }

    /**
     * Menampilkan formulir untuk mengedit biaya limbah yang ada.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        // Ambil data WastePriceCost dan relasinya
        $wastePriceCost = WastePriceCost::with('waste')->findOrFail($id);
        $wasteCategories = WasteCategory::all(); // Ambil kategori limbah juga

        return view('waste-price-cost.edit', compact('wastePriceCost', 'wasteCategories'));
    }

    /**
     * Menyimpan data biaya limbah baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi dan simpan data WastePriceCost
        $data = $request->validate([
            'waste_id' => 'required|exists:waste_categories,id',
            'amount' => 'required|numeric',
            'unit' => 'required|string|max:255', // Tambahkan batas maksimum
            'price_cost' => 'required|numeric',
        ]);

        WastePriceCost::create($data);

        return redirect()->route('waste-price-cost.create')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Memperbarui data biaya limbah yang ada.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        // Validasi dan update data WastePriceCost
        $data = $request->validate([
            'waste_id' => 'required|exists:waste_categories,id',
            'amount' => 'required|numeric',
            'unit' => 'required|string|max:255',
            'price_cost' => 'required|numeric',
        ]);

        $wastePriceCost = WastePriceCost::findOrFail($id);
        $wastePriceCost->update($data);

        return redirect()->route('waste-price-cost.edit', $id)->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Menghapus data biaya limbah yang ada.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        // Hapus data WastePriceCost
        $wastePriceCost = WastePriceCost::findOrFail($id);
        $wastePriceCost->delete();

        return redirect()->route('waste-price-cost.create')->with('success', 'Data berhasil dihapus.');
    }
}
