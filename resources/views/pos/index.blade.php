<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard App — DataPro Automation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen p-4 sm:p-8 selection:bg-indigo-500 selection:text-white">

    <div class="max-w-7xl mx-auto space-y-8">
        
        <!-- HEADER BANNER BRANDING -->
        <div class="bg-gradient-to-r from-slate-900 via-indigo-950/50 to-slate-900 border border-slate-800/80 rounded-3xl p-6 sm:p-8 shadow-2xl relative overflow-hidden backdrop-blur-xl">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-slate-950 rounded-2xl flex items-center justify-center border border-slate-800 shadow-xl">
                        <span class="text-transparent bg-clip-text bg-gradient-to-tr from-indigo-400 to-cyan-300 font-extrabold text-2xl">D</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-white">DataPro<span class="text-indigo-400">POS</span></h1>
                        <p class="text-slate-400 text-xs">Sistem Management Keuangan & Stok Terintegrasi</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('export.revenue') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2 rounded-xl text-xs transition">
                        📊 Ekspor (.CSV / Sheets)
                    </a>
                    <a href="{{ route('landing') }}" class="bg-slate-900 border border-slate-800 text-slate-300 px-3.5 py-2 rounded-xl text-xs font-semibold">
                        Beranda
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-rose-500/20 text-rose-300 border border-rose-500/30 px-3.5 py-2 rounded-xl text-xs font-bold">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ALERT STOK MENIPIS -->
        @if(count($lowStockProducts) > 0)
            <div class="bg-amber-500/10 border border-amber-500/30 text-amber-300 p-4 rounded-2xl text-xs">
                <p class="font-bold flex items-center gap-2">⚠️ Peringatan Stok Menipis (Kurang dari 5 unit):</p>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach($lowStockProducts as $lsp)
                        <span class="bg-amber-500/20 px-2.5 py-1 rounded-lg border border-amber-500/40">
                            {{ $lsp->name }} (Sisa: <strong>{{ $lsp->stock }}</strong>)
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- CARDS RINGKASAN FINANSIAL (4 KOLOM) -->
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                <p class="text-[10px] font-bold uppercase text-slate-400">Total Omzet</p>
                <p class="text-xl font-extrabold text-white mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                <p class="text-[10px] font-bold uppercase text-slate-400">Total Pengeluaran</p>
                <p class="text-xl font-extrabold text-rose-400 mt-1">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</p>
            </div>
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                <p class="text-[10px] font-bold uppercase text-slate-400">Laba Bersih Aktual</p>
                <p class="text-xl font-extrabold text-emerald-400 mt-1">Rp {{ number_format($netProfit, 0, ',', '.') }}</p>
            </div>
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4">
                <p class="text-[10px] font-bold uppercase text-slate-400">Total Item Terjual</p>
                <p class="text-xl font-extrabold text-cyan-400 mt-1">{{ $totalSalesCount }} Unit</p>
            </div>
        </div>

        <!-- INPUT TRANSAKSI KASIR -->
        <div class="bg-slate-900/90 border border-slate-800 rounded-3xl p-6">
            <h2 class="text-sm font-bold text-white mb-3">Input Transaksi Penjualan Kasir</h2>
            <form action="{{ route('pos.transaction') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end">
                @csrf
                <div class="sm:col-span-4">
                    <label class="block text-[10px] font-bold text-slate-400 mb-1">PRODUK</label>
                    <select name="product_id" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-200" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                [{{ $product->category }}] {{ $product->name }} (Stok: {{ $product->stock }}) - Rp {{ number_format($product->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-bold text-slate-400 mb-1">QTY</label>
                    <input type="number" name="quantity" min="1" value="1" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-200 text-center font-bold" required>
                </div>
                <div class="sm:col-span-3">
                    <label class="block text-[10px] font-bold text-slate-400 mb-1">TANGGAL</label>
                    <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-200" required>
                </div>
                <div class="sm:col-span-3">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded-xl text-xs transition">
                        + Transaksi Kasir
                    </button>
                </div>
            </form>
        </div>

        <!-- MAIN SPLIT: KATALOG PRODUK & CATAT BIAYA OPERASIONAL -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- SEKSI BIAYA OPERASIONAL / PENGELUARAN -->
            <div class="lg:col-span-4 bg-slate-900/90 border border-slate-800 rounded-3xl p-5 space-y-4">
                <h2 class="text-sm font-bold text-white">+ Catat Pengeluaran Usaha</h2>
                <form action="{{ route('expense.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-[10px] text-slate-400 mb-1">Keterangan Biaya</label>
                        <input type="text" name="description" placeholder="misal: Cetak Stiker Brosur" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-1.5 text-xs text-slate-200" required>
                    </div>
                    <div>
                        <label class="block text-[10px] text-slate-400 mb-1">Jumlah Biaya (Rp)</label>
                        <input type="number" name="amount" placeholder="50000" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-1.5 text-xs text-slate-200" required>
                    </div>
                    <div>
                        <label class="block text-[10px] text-slate-400 mb-1">Tanggal Biaya</label>
                        <input type="date" name="expense_date" value="{{ date('Y-m-d') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-1.5 text-xs text-slate-200" required>
                    </div>
                    <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-2 rounded-xl text-xs transition">
                        Simpan Biaya Pengeluaran
                    </button>
                </form>

                <!-- TABEL PENGELUARAN TERAKHIR -->
                <div class="pt-3 border-t border-slate-800">
                    <p class="text-xs font-bold text-slate-400 mb-2">Riwayat Pengeluaran:</p>
                    <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                        @forelse($expenses as $exp)
                            <div class="flex justify-between items-center bg-slate-950 p-2.5 rounded-xl border border-slate-800 text-xs">
                                <div>
                                    <p class="font-semibold text-slate-200">{{ $exp->description }}</p>
                                    <p class="text-[10px] text-slate-500">{{ $exp->expense_date }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-rose-400">-Rp {{ number_format($exp->amount, 0, ',', '.') }}</span>
                                    <form action="{{ route('expense.destroy', $exp->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[10px] text-rose-500 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-[10px] text-slate-500 text-center py-2">Belum ada pengeluaran recorded.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- SEKSI KATALOG PRODUK & STOK -->
            <div class="lg:col-span-8 bg-slate-900/90 border border-slate-800 rounded-3xl p-5 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-sm font-bold text-white">Daftar Stok & Katalog Barang</h2>
                </div>

                <!-- FORM TAMBAH BARANG -->
                <form action="{{ route('product.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-5 gap-2 bg-slate-950 p-3 rounded-2xl border border-slate-800">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Barang" class="bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-200" required>
                    <select name="category" class="bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-200" required>
                        <option value="Minuman">Minuman</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Jasa/Template">Jasa/Template</option>
                        <option value="Umum">Umum</option>
                    </select>
                    <input type="number" name="cost_price" placeholder="Modal" class="bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-200" required>
                    <input type="number" name="price" placeholder="Harga Jual" class="bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-200" required>
                    <div class="flex gap-1">
                        <input type="number" name="stock" placeholder="Stok" class="bg-slate-900 border border-slate-800 rounded-lg px-2 py-1.5 text-xs text-slate-200 w-16" required>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-1.5 rounded-lg text-xs flex-1">
                            + Tambah
                        </button>
                    </div>
                </form>

                <!-- TABEL BARANG -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-800">
                                <th class="pb-2">Barang</th>
                                <th class="pb-2">Kategori</th>
                                <th class="pb-2">Modal</th>
                                <th class="pb-2">Jual</th>
                                <th class="pb-2">Stok</th>
                                <th class="pb-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50">
                            @forelse($products as $product)
                                <tr class="hover:bg-slate-800/30">
                                    <td class="py-2 font-medium text-slate-200">{{ $product->name }}</td>
                                    <td class="py-2 text-slate-400"><span class="bg-slate-800 px-2 py-0.5 rounded-md text-[10px]">{{ $product->category }}</span></td>
                                    <td class="py-2 text-slate-400">Rp {{ number_format($product->cost_price, 0, ',', '.') }}</td>
                                    <td class="py-2 text-indigo-300 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $product->stock <= 5 ? 'bg-amber-500/20 text-amber-300' : 'bg-slate-800 text-slate-300' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="py-2 text-center">
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-400 hover:underline text-[10px]">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-3 text-center text-slate-500">Katalog masih kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</body>
</html>