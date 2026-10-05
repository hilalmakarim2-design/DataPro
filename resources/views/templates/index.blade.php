@extends('layouts.app')

@section('title', 'Katalog Template Spreadsheet — DataPro')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Layanan & Template Spreadsheet UMKM</h1>
            <p class="text-slate-400 text-xs mt-1">Kelola katalog produk template Google Sheets & Excel otomatis</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition">
            + Tambah Template Baru
        </button>
    </div>

    <!-- GRID KATALOG TEMPLATE -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 hover:border-indigo-500/50 transition">
            <span class="text-[10px] font-bold bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 px-2 py-0.5 rounded-full">Google Sheets + Forms</span>
            <h3 class="text-base font-bold text-white mt-3">Template Kasir & Stok Otomatis UMKM</h3>
            <p class="text-slate-400 text-xs mt-2">Termasuk Form Kasir HP, Rekap Stok, & Laporan Laba Rugi Otomatis.</p>
            <div class="flex justify-between items-center mt-5 pt-3 border-t border-slate-800">
                <span class="text-sm font-bold text-emerald-400">Rp 75.000</span>
                <span class="text-[10px] text-slate-500">Sekali Bayar</span>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 hover:border-indigo-500/50 transition">
            <span class="text-[10px] font-bold bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 px-2 py-0.5 rounded-full">Apps Script Integrated</span>
            <h3 class="text-base font-bold text-white mt-3">Autorekap Utang & Piutang Toko</h3>
            <p class="text-slate-400 text-xs mt-2">DILENGKAPI skrip pengingat jatuh tempo utang via WhatsApp.</p>
            <div class="flex justify-between items-center mt-5 pt-3 border-t border-slate-800">
                <span class="text-sm font-bold text-emerald-400">Rp 100.000</span>
                <span class="text-[10px] text-slate-500">Sekali Bayar</span>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 hover:border-indigo-500/50 transition">
            <span class="text-[10px] font-bold bg-purple-500/20 text-purple-400 border border-purple-500/30 px-2 py-0.5 rounded-full">Full Custom</span>
            <h3 class="text-base font-bold text-white mt-3">Kustom Laporan Keuangan Custom</h3>
            <p class="text-slate-400 text-xs mt-2">Template kustomisasi sesuai kebutuhan alur bisnis spesifik klien.</p>
            <div class="flex justify-between items-center mt-5 pt-3 border-t border-slate-800">
                <span class="text-sm font-bold text-emerald-400">Rp 150.000</span>
                <span class="text-[10px] text-slate-500">Kustomisasi</span>
            </div>
        </div>
    </div>
</div>
@endsection