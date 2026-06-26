<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TechFix - Solusi IT & Servis Komputer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-800 font-sans selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 bg-gradient-to-tr from-slate-800 to-slate-600 rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-md group-hover:scale-105 transition-transform">
                            TF
                        </div>
                        <span class="font-bold text-xl tracking-tight text-slate-900">Tech<span class="text-indigo-600">Fix</span></span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#layanan" class="text-sm text-slate-600 hover:text-indigo-600 font-medium transition-colors">Layanan</a>
                    <a href="#katalog" class="text-sm text-slate-600 hover:text-indigo-600 font-medium transition-colors">Katalog Produk</a>
                    
                    <div class="h-5 w-px bg-slate-200"></div>
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="/dashboard" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">Masuk Dashboard &rarr;</a>
                        @else
                            <a href="/profile" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">Profil Saya</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-slate-600 hover:text-red-600 font-medium transition-colors">Keluar</button>
                        </form>
                    @else
                        <a href="/login" class="text-sm text-slate-600 hover:text-slate-900 font-medium transition-colors">Masuk</a>
                        <a href="/register" class="px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 hover:shadow-md transition-all">Daftar</a>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden gap-4">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="/dashboard" class="text-sm font-semibold text-indigo-600">Dashboard</a>
                        @else
                            <a href="/profile" class="text-sm font-semibold text-indigo-600">Profil</a>
                        @endif
                    @else
                        <a href="/login" class="text-sm font-medium text-slate-700">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-24 pb-16 lg:pt-32 lg:pb-20 overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute inset-0 z-0 opacity-40">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:24px_24px]"></div>
            <div class="absolute right-0 top-0 -z-10 m-auto h-[250px] w-[250px] rounded-full bg-indigo-200 blur-[80px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-slate-200 text-slate-600 text-xs font-semibold mb-6 shadow-sm">
                <span class="flex h-1.5 w-1.5 rounded-full bg-green-500"></span>
                Servis IT Terpercaya
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
                Solusi Cerdas Untuk <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-700 to-indigo-600">Semua Masalah IT-mu</span>
            </h1>
            
            <p class="mt-4 text-base md:text-lg text-slate-500 max-w-2xl mx-auto mb-8 leading-relaxed">
                Dari perbaikan laptop lambat hingga perakitan PC Gaming impian. Kami menyediakan layanan profesional dengan harga transparan dan komponen berkualitas.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center gap-3">
                <a href="#katalog" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-slate-900 text-white font-medium text-sm hover:bg-slate-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    Lihat Produk Kami
                </a>
                <a href="#layanan" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-white text-slate-700 font-medium text-sm border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all duration-300">
                    Pelajari Layanan
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="py-16 bg-white relative border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-3">Layanan Unggulan</h2>
                <p class="text-sm text-slate-500 max-w-xl mx-auto">Kami tidak hanya memperbaiki, tapi juga memberikan solusi performa terbaik.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="group bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:border-indigo-100 hover:bg-white hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center mb-5 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Servis Laptop & PC</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Perbaikan hardware, mati total, ganti LCD, hingga upgrade SSD & RAM.</p>
                </div>

                <!-- Card 2 -->
                <div class="group bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:border-indigo-100 hover:bg-white hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center mb-5 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Instalasi Software</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Instal ulang OS, aktivasi Office, Antivirus original, dan software desain.</p>
                </div>

                <!-- Card 3 -->
                <div class="group bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:border-indigo-100 hover:bg-white hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center mb-5 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Penjualan Komponen</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Sedia berbagai macam sparepart, aksesoris, hingga perakitan PC Kustom.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Catalog Section -->
    <section id="katalog" class="py-16 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">Katalog Produk</h2>
                    <p class="text-sm text-slate-500">Koleksi sparepart dan aksesoris terbaru kami.</p>
                </div>
                <a href="/login" class="hidden sm:block text-sm font-semibold text-indigo-600 hover:text-indigo-800">Lihat Semua &rarr;</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @forelse($products as $product)
                <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow group flex flex-col">
                    <div class="h-40 bg-slate-100 flex items-center justify-center relative overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <svg class="w-10 h-10 text-slate-300 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @endif
                        
                        @if($product->stock <= 0)
                            <div class="absolute top-2 right-2 bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-md shadow-sm">Habis</div>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <div class="text-xs text-slate-400 mb-1 font-medium">{{ $product->category->name ?? 'Uncategorized' }}</div>
                        <h3 class="font-bold text-slate-800 text-sm leading-tight mb-2 line-clamp-2">{{ $product->name }}</h3>
                        <div class="mt-auto pt-3 flex flex-col gap-3 border-t border-slate-50">
                            <span class="font-extrabold text-indigo-600 text-sm">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                            @auth
                                @if($product->stock > 0)
                                    <a href="/checkout/{{ $product->id }}" class="text-center w-full px-3 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-lg transition-colors">Beli Sekarang</a>
                                @else
                                    <button disabled class="w-full px-3 py-2 bg-slate-100 text-slate-400 text-xs font-semibold rounded-lg cursor-not-allowed">Stok Habis</button>
                                @endif
                            @else
                                <a href="/login" class="text-center w-full px-3 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-lg transition-colors">Login untuk Beli</a>
                            @endauth
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-12 text-center text-slate-500 bg-white rounded-2xl border border-slate-100">
                    <p>Belum ada produk yang tersedia.</p>
                </div>
                @endforelse
            </div>
            
            <div class="mt-8 text-center sm:hidden">
                <a href="/login" class="inline-block px-6 py-2 rounded-lg bg-slate-100 text-slate-700 font-medium text-sm hover:bg-slate-200">Lihat Semua Produk</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center text-white font-bold text-sm mx-auto mb-4">TF</div>
            <p class="text-slate-500 text-sm">&copy; {{ date('Y') }} TechFix. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
