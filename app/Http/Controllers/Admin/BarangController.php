<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\StokBarang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::with('stokBarang')->latest()->paginate(15);
        return view('barang.index', compact('barangs'));
    }

    public function filter(Request $request)
    {
        $query = '';
        if ($request->filter == 'kosong') {
            $query = 0;
        } else if ($request->filter == 'ada') {
            $query = 1;
        } else {
            $barangs = Barang::with('stokBarang')->latest()->paginate(15);
            return view('barang.list_barang', compact('barangs'));
        }

        $barangs = Barang::with('stokBarang')->where('status', $query)->latest()->paginate(15);
        return view('barang.list_barang', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $satuans = Satuan::all();
        return view('barang.create', compact('suppliers', 'satuans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'supplier_id' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'stok' => 'required',
            'satuan_id' => 'required',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $hasImage = $image->hashName();
            $image->storeAs('barangs', $hasImage, 'public');
        }

        $request['kode_barang'] = 'BRG' . time();

        DB::transaction(function () use ($request, $hasImage) {
            $barang = Barang::create([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'deskripsi' => $request->deskripsi,
                'image' => $hasImage,
                'status' => $request->status,
            ]);

            StokBarang::create([
                'barang_id' => $barang->id,
                'supplier_id' => $request->supplier_id,
                'satuan_id' => $request->satuan_id,
                'stok' => $request->stok,
            ]);
        });

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($kode_barang)
    {
        $barang = Barang::where('kode_barang', $kode_barang)->first();
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $suppliers = Supplier::all();
        return view('barang.edit', compact('barang', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        try {
            $request->validate([
                'nama_barang' => 'required',
                'supplier_id' => 'required',
                'harga_beli' => 'required',
                'harga_jual' => 'required',
                'deskripsi' => 'required',
                'image' => 'image|mimes:jpeg,jpg,png|max:2048',
                'stok' => 'required',
                'status' => 'required',
            ]);

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('barangs/' . $barang->image);
                $image = $request->file('image');
                $hasImage = $image->hashName();
                $image->storeAs('barangs', $hasImage, 'public');
            } else {
                $hasImage = $barang->image;
            }

            $barang->update([
                'nama_barang' => $request->nama_barang,
                'supplier_id' => $request->supplier_id,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'deskripsi' => $request->deskripsi,
                'image' => $hasImage,
                'stok' => $request->stok,
                'status' => $request->status,
            ]);

            return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        Storage::disk('public')->delete('barangs/' . $barang->image);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    public function listBarang()
    {
        $barangs = Barang::with('stokBarang')->paginate(9);
        return view('barang.list_barang', compact('barangs'));
    }

    public function listSatuan()
    {
        $barangs = Barang::latest()->paginate(15);
        return view('barang.satuan.index', compact('barangs'));
    }

    public function tambahSatuan()
    {
        $barangs = Barang::latest()->get();
        return view('barang.satuan.create', compact('barangs'));
    }

    public function storeSatuan(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        Barang::create([
            'barang_id' => $request->barang_id,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('barang.satuan.index')->with('success', 'Satuan barang berhasil ditambahkan');
    }

    public function inBarang(Request $request, $barang_id)
    {
        try {
            $barang = StokBarang::where('barang_id', $barang_id)->first();
            if ($request->in_barang < 0 || $request->in_barang == 0) {
                return redirect()->back()->with('error', 'Jumlah barang masuk tidak boleh kurang dari 0');
            } else if ($request->in_barang > 0) {
                $this->updateStok($barang, $request);
                $barang->save();
                return redirect()->route('barang.list')->with('success', 'Barang berhasil ditambahkan');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function updateStok($barang, $request)
    {
        $barang->stok += $request->in_barang;
        if ($barang->stok > 0) {
            $item = Barang::find($barang->barang_id);
            $item->status = 1;
            $item->save();
        }
    }

    public function removeStok($barang, $request)
    {
        $barang->stok -= $request->out_barang;
        if ($barang->stok == 0) {
            $item = Barang::find($barang->barang_id);
            $item->status = 0;
            $item->save();
        }
    }

    public function outBarang(Request $request, $barang_id)
    {
        $barang = StokBarang::where('barang_id', $barang_id)->first();
        if ($request->out_barang < 0 || $request->out_barang == 0 || $request->out_barang > $barang->stok) {
            return redirect()->back()->with('error', 'Jumlah barang keluar tidak boleh kurang dari 0');
        } else if ($request->out_barang > 0) {
            $this->removeStok($barang, $request);
            $barang->save();
            return redirect()->route('barang.list')->with('success', 'Barang berhasil dikurangi');
        }
    }

    public function search(Request $request)
    {
        $barangs = Barang::where('nama_barang', 'like', '%' . $request->q . '%')->paginate(15);
        return view('barang.list_barang', compact('barangs'));
    }
}
