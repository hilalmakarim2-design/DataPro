<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataPro — Otomasi & Digitalisasi Spreadsheet UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen selection:bg-indigo-500 selection:text-white">

    <!-- NAVIGATION BAR -->
    <nav class="border-b border-slate-800/80 bg-slate-900/50 backdrop-blur-xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-slate-950 border border-slate-800 rounded-xl flex items-center justify-center font-bold text-indigo-400">
                    <span class="text-transparent bg-clip-text bg-gradient-to-tr from-indigo-400 to-cyan-300 font-extrabold text-xl">D</span>
                </div>
                <span class="font-extrabold text-xl text-white">DataPro<span class="text-indigo-400">.io</span></span>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-slate-300 hover:text-white font-semibold px-4 py-2 text-xs transition">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs transition shadow-lg shadow-indigo-600/20">
                    Daftar Akun Baru
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="max-w-7xl mx-auto px-6 py-16 text-center relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-indigo-600/15 rounded-full blur-3xl pointer-events-none"></div>

        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 mb-6">
            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-ping"></span> Jasa Otomasi Spreadsheet & Kasir UMKM
        </span>

        <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-tight max-w-4xl mx-auto">
            Solusi Pencatatan Keuangan & Stok UMKM Tanpa Biaya Bulanan
        </h1>
        <p class="text-slate-400 text-base max-w-2xl mx-auto mt-4">
            Ubah sistem manual tokomu jadi otomatis berbasis Google Sheets, Excel, & Aplikasi POS Kasir. Sekali bayar, pakai selamanya!
        </p>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white font-bold px-8 py-3.5 rounded-xl text-sm shadow-xl shadow-indigo-500/25 transition">
                Mulai Daftar Sekarang
            </a>
            <a href="{{ route('login') }}" class="bg-slate-900 border border-slate-800 hover:bg-slate-800 text-slate-200 font-bold px-8 py-3.5 rounded-xl text-sm transition">
                Masuk ke Portal
            </a>
        </div>
    </section>

    <!-- REALTIME STATS OVERVIEW -->
    <section class="max-w-7xl mx-auto px-6 py-8">
        <div class="border border-slate-800/80 rounded-3xl p-6 bg-slate-900/60 backdrop-blur-md">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-4">Statistik Transaksi Terintegrasi Realtime</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-2xl">
                    <p class="text-xs text-slate-400 font-semibold">Total Omzet Penjualan</p>
                    <p class="text-2xl font-extrabold text-white mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-2xl">
                    <p class="text-xs text-slate-400 font-semibold">Total Keuntungan Bersih</p>
                    <p class="text-2xl font-extrabold text-emerald-400 mt-1">Rp {{ number_format($totalProfit, 0, ',', '.') }}</p>
                </div>
                <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-2xl">
                    <p class="text-xs text-slate-400 font-semibold">Item Terjual</p>
                    <p class="text-2xl font-extrabold text-cyan-400 mt-1">{{ $totalSalesCount }} Unit</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>