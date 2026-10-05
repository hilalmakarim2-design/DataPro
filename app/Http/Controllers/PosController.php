<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Expense;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function landing()
    {
        $totalRevenue = Transaction::sum('total_price');
        $totalExpenses = Expense::sum('amount');
        $totalProfit = Transaction::sum('total_profit') - $totalExpenses;
        $totalSalesCount = Transaction::sum('quantity');

        return view('landing', compact('totalRevenue', 'totalProfit', 'totalSalesCount'));
    }

    public function index()
    {
        $products = Product::latest()->get();
        $transactions = Transaction::with('product')->latest()->get();
        $expenses = Expense::latest()->get();

        // Peringatan Stok Menipis (Kurang dari atau sama dengan 5)
        $lowStockProducts = Product::where('stock', '<=', 5)->get();

        // Perhitungan Finansial
        $totalRevenue = Transaction::sum('total_price');
        $totalExpenses = Expense::sum('amount');
        $grossProfit = Transaction::sum('total_profit');
        $netProfit = $grossProfit - $totalExpenses; // Laba Bersih Aktual
        $totalSalesCount = Transaction::sum('quantity');

        return view('pos.index', compact(
            'products', 
            'transactions', 
            'expenses', 
            'lowStockProducts', 
            'totalRevenue', 
            'netProfit', 
            'totalExpenses', 
            'totalSalesCount'
        ));
    }

    // SIMPAN PENGELUARAN BARU
    public function storeExpense(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|integer|min:1',
            'expense_date' => 'required|date',
        ]);

        Expense::create($request->all());

        return redirect()->back()->with('success', 'Biaya pengeluaran berhasil dicatat!');
    }

    // HAPUS PENGELUARAN
    public function destroyExpense($id)
    {
        Expense::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pengeluaran berhasil dihapus!');
    }

    // ... (method storeProduct, updateProduct, destroyProduct, storeTransaction, exportRevenue tetap sama) ...
    
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|integer|min:0',
            'cost_price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()->back()->with('success', 'Barang baru berhasil ditambahkan!');
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|integer|min:0',
            'cost_price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->back()->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroyProduct($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'nullable|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi!');
        }

        $totalPrice = $product->price * $request->quantity;
        $profitPerItem = $product->price - $product->cost_price;
        $totalProfit = $profitPerItem * $request->quantity;

        $transactionDate = $request->transaction_date ? $request->transaction_date . ' ' . date('H:i:s') : now();

        Transaction::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'total_profit' => $totalProfit,
            'created_at' => $transactionDate,
            'updated_at' => $transactionDate,
        ]);

        $product->decrement('stock', $request->quantity);

        return redirect()->back()->with('success', 'Transaksi berhasil dicatat!');
    }

    public function exportRevenue()
    {
        $fileName = 'Laporan_Pendapatan_DataPro_' . date('Y-m-d_H-i-s') . '.csv';
        $transactions = Transaction::with('product')->latest()->get();

        $headers = array(
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID Transaksi', 'Tanggal & Waktu', 'Nama Produk', 'Jumlah (Qty)', 'Total Pendapatan (Rp)', 'Laba Bersih (Rp)');

        $callback = function() use($transactions, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, $columns);

            foreach ($transactions as $tx) {
                $row['ID Transaksi']     = 'TX-' . $tx->id;
                $row['Tanggal & Waktu'] = $tx->created_at->format('Y-m-d H:i:s');
                $row['Nama Produk']     = $tx->product ? $tx->product->name : 'Produk Dihapus';
                $row['Jumlah (Qty)']    = $tx->quantity;
                $row['Total Pendapatan']= $tx->total_price;
                $row['Laba Bersih']     = $tx->total_profit;

                fputcsv($file, array($row['ID Transaksi'], $row['Tanggal & Waktu'], $row['Nama Produk'], $row['Jumlah (Qty)'], $row['Total Pendapatan'], $row['Laba Bersih']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}