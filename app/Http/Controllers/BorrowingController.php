<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $borrowings = Borrowing::with('details.product')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_peminjam', 'like', "%{$keyword}%")
                    ->orWhereHas('details.product', function ($q) use ($keyword) {
                        $q->where('nama_barang', 'like', "%{$keyword}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return view('borrowings.index', compact('borrowings', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('nama_barang')->get();

        return view('borrowings.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stok < $request->jumlah) {
            return back()
                ->withInput()
                ->with('error', 'Stok barang tidak mencukupi.');
        }

        $borrowing = Borrowing::create([
            'user_id' => auth()->id(),
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'Dipinjam',
        ]);

        $detail = BorrowingDetail::create([
            'borrowing_id' => $borrowing->id,
            'product_id' => $request->product_id,
            'jumlah' => $request->jumlah,
        ]);

        $product->decrement('stok', $request->jumlah);

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function return(Borrowing $borrowing)
    {
        if ($borrowing->status == 'Dikembalikan') {
            return redirect()
                ->route('borrowings.index')
                ->with('success', 'Barang sudah dikembalikan.');
        }

        foreach ($borrowing->details as $detail) {
            $product = $detail->product;

            $product->update([
                'stok' => $product->stok + $detail->jumlah,
            ]);
        }

        $borrowing->update([
            'status' => 'Dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Barang berhasil dikembalikan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
