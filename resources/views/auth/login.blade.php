<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — DataPro Automation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-4 relative">

    <div class="w-full max-w-md bg-slate-900 border border-slate-800/80 rounded-3xl p-8 shadow-2xl relative z-10">
        <div class="text-center mb-6">
            <div class="inline-flex w-14 h-14 bg-slate-950 border border-slate-800 rounded-2xl items-center justify-center mb-3">
                <span class="text-transparent bg-clip-text bg-gradient-to-tr from-indigo-400 to-cyan-300 font-black text-2xl">D</span>
            </div>
            <h1 class="text-2xl font-bold text-white">Masuk ke DataPro</h1>
            <p class="text-slate-400 text-xs mt-1">Sistem Otomasi Spreadsheet & Kasir UMKM</p>
        </div>

        @if(session('error'))
            <div class="bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs p-3 rounded-xl mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Email</label>
                <input type="email" name="email" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:border-indigo-500 focus:outline-none" placeholder="nama@email.com" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-1">Password</label>
                <input type="password" name="password" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:border-indigo-500 focus:outline-none" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl shadow-lg transition text-sm">
                Masuk Sekarang →
            </button>
        </form>

        <p class="mt-6 text-center text-xs text-slate-400">
            Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-400 font-semibold hover:underline">Daftar Akun Baru</a>
        </p>
    </div>

</body>
</html>