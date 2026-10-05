<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DataPro Automation System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col md:flex-row">

    <!-- SIDEBAR APP NAVIGATION -->
    <aside class="w-full md:w-64 bg-slate-900 border-r border-slate-800/80 p-6 flex flex-col justify-between shrink-0">
        <div>
            <!-- BRAND LOGO -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-slate-950 border border-slate-800 rounded-xl flex items-center justify-center font-bold text-indigo-400">
                    <span class="text-transparent bg-clip-text bg-gradient-to-tr from-indigo-400 to-cyan-300 font-extrabold text-xl">D</span>
                </div>
                <div>
                    <h2 class="font-extrabold text-base text-white">DataPro<span class="text-indigo-400">.io</span></h2>
                    <p class="text-[10px] text-slate-400">Spreadsheet Automation</p>
                </div>
            </div>

            <!-- MENU NAVIGATION -->
            <nav class="space-y-1.5">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    📊 Dashboard Analytics
                </a>

                <a href="{{ route('templates.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('templates.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    📑 Katalog Template UMKM
                </a>

                <a href="{{ route('clients.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('clients.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    👥 Client UMKM & Order
                </a>

                <a href="{{ route('pos.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('pos.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    🛒 Kasir POS Order Penjualan
                </a>
            </nav>
        </div>

        <!-- LOGOUT USER FOOTER -->
        <div class="border-t border-slate-800 pt-4 mt-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-white">Hilal Makarim</p>
                    <p class="text-[10px] text-slate-500">Admin DataPro</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs text-rose-400 hover:underline">Exit</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- CONTENT BODY CONTAINER -->
    <main class="flex-1 p-6 sm:p-8 overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>