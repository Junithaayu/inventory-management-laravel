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
    public function index()
    {
        $borrowings = Borrowing::with('details.product')
            ->latest()
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
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


        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
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
