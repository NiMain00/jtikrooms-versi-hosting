<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', "JTIK ROOM'S")</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            "darkMode": "class", 
            "theme": {
                "extend": {
                    "colors": {
                        "on-primary-fixed-variant": "#004395", "surface-variant": "#dae2fd", "inverse-surface": "#283044", 
                        "on-primary-container": "#fefcff", "on-primary": "#ffffff", "primary-fixed": "#d8e2ff", 
                        "on-tertiary-container": "#fefcff", "on-secondary-fixed-variant": "#753400", "on-primary-fixed": "#001a42", 
                        "surface-container-lowest": "#ffffff", "surface-tint": "#005ac2", "on-error-container": "#93000a", 
                        "outline": "#727785", "secondary-container": "#fb7800", "tertiary-container": "#5c769e", 
                        "on-secondary-container": "#592600", "on-error": "#ffffff", "on-surface": "#131b2e", 
                        "error-container": "#ffdad6", "surface-container": "#eaedff", "on-tertiary-fixed": "#001c3b", 
                        "tertiary-fixed": "#d5e3ff", "secondary-fixed": "#ffdbc8", "outline-variant": "#c2c6d6", 
                        "on-tertiary": "#ffffff", "on-secondary-fixed": "#321200", "primary": "#0058be", 
                        "primary-fixed-dim": "#adc6ff", "primary-container": "#2170e4", "on-background": "#131b2e", 
                        "secondary-fixed-dim": "#ffb68b", "surface": "#faf8ff", "secondary": "#994700", "on-secondary": "#ffffff", 
                        "tertiary": "#435d84", "surface-bright": "#faf8ff", "surface-container-low": "#f2f3ff", 
                        "inverse-on-surface": "#eef0ff", "surface-container-high": "#e2e7ff", "surface-dim": "#d2d9f4", 
                        "on-tertiary-fixed-variant": "#2d486d", "background": "#faf8ff", "error": "#ba1a1a", 
                        "tertiary-fixed-dim": "#adc8f5", "inverse-primary": "#adc6ff", "on-surface-variant": "#424754", 
                        "surface-container-highest": "#dae2fd"
                    }, 
                    "borderRadius": {
                        "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"
                    }, 
                    "spacing": {
                        "gutter-desktop": "1.5rem", "space-xl": "2rem", "margin-desktop": "2rem", "gutter-mobile": "1rem", 
                        "space-md": "1rem", "space-2xs": "0.25rem", "space-3xl": "4rem", "space-sm": "0.75rem", 
                        "space-2xl": "3rem", "space-lg": "1.5rem", "margin-mobile": "1rem", "space-xs": "0.5rem"
                    }, 
                    "fontFamily": {
                        "display-lg": ["Outfit"], "headline-xl-mobile": ["Outfit"], "label-sm": ["Outfit"], "label-lg": ["Outfit"], 
                        "body-md": ["Outfit"], "headline-lg": ["Outfit"], "display-lg-mobile": ["Outfit"], "headline-md": ["Outfit"], 
                        "headline-xl": ["Outfit"], "title-md": ["Outfit"], "title-lg": ["Outfit"], "headline-sm": ["Outfit"], 
                        "body-lg": ["Outfit"], "body-sm": ["Outfit"], "label-md": ["Outfit"]
                    },
                    "fontSize": {
                        "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "800"}], 
                        "headline-xl-mobile": ["28px", {"lineHeight": "36px", "letterSpacing": "-0.01em", "fontWeight": "700"}], 
                        "label-sm": ["10px", {"lineHeight": "14px", "letterSpacing": "0.04em", "fontWeight": "700"}], 
                        "label-lg": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}], 
                        "body-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0em", "fontWeight": "400"}], 
                        "headline-lg": ["30px", {"lineHeight": "38px", "letterSpacing": "-0.01em", "fontWeight": "700"}], 
                        "display-lg-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "800"}], 
                        "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}], 
                        "headline-xl": ["36px", {"lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700"}], 
                        "title-md": ["16px", {"lineHeight": "24px", "letterSpacing": "0.005em", "fontWeight": "600"}], 
                        "title-lg": ["18px", {"lineHeight": "26px", "letterSpacing": "0em", "fontWeight": "600"}], 
                        "headline-sm": ["20px", {"lineHeight": "28px", "letterSpacing": "0em", "fontWeight": "600"}], 
                        "body-lg": ["16px", {"lineHeight": "24px", "letterSpacing": "0em", "fontWeight": "400"}], 
                        "body-sm": ["12px", {"lineHeight": "18px", "letterSpacing": "0.01em", "fontWeight": "400"}], 
                        "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "600"}]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface antialiased" x-data="{ sidebarOpen: false }">
    
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" class="fixed inset-0 bg-on-surface/50 backdrop-blur-sm z-40 lg:hidden" 
         x-transition.opacity 
         @click="sidebarOpen = false"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed left-0 top-0 h-full w-[260px] bg-inverse-surface z-50 flex flex-col justify-between shadow-[4px_0_24px_rgba(15,23,42,0.06)] transform transition-transform duration-300 lg:translate-x-0">
        <div class="flex flex-col">
            <div class="p-space-lg flex items-center gap-space-sm bg-surface-container-lowest/5 backdrop-blur-md relative">
                <!-- Close Button on Mobile -->
                <button @click="sidebarOpen = false" class="lg:hidden absolute top-4 right-4 text-surface-variant hover:text-white">
                    <span class="material-symbols-outlined">close</span>
                </button>

                <img alt="JTIK ROOM'S Logo" class="h-8 w-auto object-contain" src="{{ asset('img/logo1.png') }}"/>
                <div class="flex flex-col min-w-0 flex-1">
                    <div class="flex items-center gap-space-xs">
                        <span class="font-title-md text-title-md text-on-primary truncate tracking-tight">JTIK ROOM'S</span>
                        <span class="px-1.5 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm uppercase font-bold tracking-wider">v2.4</span>
                    </div>
                    <span class="font-body-sm text-body-sm text-surface-variant/70 truncate">Sistem Peminjaman Ruang</span>
                </div>
            </div>
            <div class="px-space-md py-space-sm">
                <p class="font-label-sm text-label-sm uppercase tracking-wider text-surface-variant/50 px-space-sm mb-space-xs font-semibold">Menu Navigasi</p>
                <nav class="flex flex-col gap-space-xs" data-active-classes="bg-primary-container text-on-primary-container font-semibold rounded-xl shadow-[0_8px_16px_-4px_rgba(33,112,228,0.4)]">
                    <a class="flex items-center gap-space-sm px-space-sm py-space-xs transition-all {{ request()->routeIs('home') ? 'bg-primary-container text-on-primary-container font-semibold rounded-xl shadow-[0_8px_16px_-4px_rgba(33,112,228,0.4)]' : 'rounded-xl text-surface-variant hover:bg-surface-container-highest/20 hover:text-on-primary' }}" href="{{ route('home') }}">
                        <span class="material-symbols-outlined text-primary-fixed">meeting_room</span>
                        <span class="font-label-lg text-label-lg">Ruangan</span>
                    </a>
                    
                    @if(session('role') === 'admin')
                    <a class="flex items-center gap-space-sm px-space-sm py-space-xs transition-all {{ request()->routeIs('dashboard.admin') || request()->is('admin/*') ? 'bg-primary-container text-on-primary-container font-semibold rounded-xl shadow-[0_8px_16px_-4px_rgba(33,112,228,0.4)]' : 'rounded-xl text-surface-variant hover:bg-surface-container-highest/20 hover:text-on-primary' }}" href="{{ route('dashboard.admin') }}">
                        <span class="material-symbols-outlined text-primary-fixed">admin_panel_settings</span>
                        <span class="font-label-lg text-label-lg">Administrator</span>
                    </a>
                    @endif
                    
                    @if(session()->has('user'))
                    <a class="flex items-center gap-space-sm px-space-sm py-space-xs transition-all {{ request()->routeIs('dashboard.kelas') ? 'bg-primary-container text-on-primary-container font-semibold rounded-xl shadow-[0_8px_16px_-4px_rgba(33,112,228,0.4)]' : 'rounded-xl text-surface-variant hover:bg-surface-container-highest/20 hover:text-on-primary' }}" href="{{ route('dashboard.kelas') }}">
                        <span class="material-symbols-outlined text-primary-fixed">school</span>
                        <span class="font-label-lg text-label-lg">Kelas</span>
                    </a>
                    @endif
                    
                    <a class="flex items-center gap-space-sm px-space-sm py-space-xs transition-all {{ request()->routeIs('informasi') ? 'bg-primary-container text-on-primary-container font-semibold rounded-xl shadow-[0_8px_16px_-4px_rgba(33,112,228,0.4)]' : 'rounded-xl text-surface-variant hover:bg-surface-container-highest/20 hover:text-on-primary' }}" href="{{ route('informasi') }}">
                        <span class="material-symbols-outlined text-primary-fixed">info</span>
                        <span class="font-label-lg text-label-lg">Informasi</span>
                    </a>
                </nav>
            </div>
        </div>
        <div class="p-space-md flex flex-col gap-space-sm bg-surface-container-lowest/5 backdrop-blur-md">
            <div class="flex items-center gap-space-sm p-space-xs rounded-xl bg-surface-container-lowest/10">
                <img alt="Profile" class="w-8 h-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(session('user') ?? 'User') }}&background=0058be&color=fff&rounded=true&bold=true"/>
                <div class="flex flex-col min-w-0 flex-1">
                    <span class="font-label-md text-label-md text-on-primary truncate font-bold">{{ session('user') ?? 'User' }}</span>
                    <span class="font-body-sm text-body-sm text-secondary-fixed truncate">{{ session('role') === 'admin' ? 'Administrator' : 'Perwakilan Kelas' }}</span>
                </div>
            </div>
            
            @if(session()->has('user'))
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            <a class="flex items-center justify-center gap-space-xs w-full py-space-xs px-space-md rounded-full bg-secondary-container text-on-secondary-container font-label-lg text-label-lg font-semibold hover:bg-secondary hover:text-on-secondary shadow-[0_8px_16px_-4px_rgba(251,120,0,0.35)] transition-all cursor-pointer" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="material-symbols-outlined">logout</span>
                <span>Keluar Sistem</span>
            </a>
            @else
            <a href="{{ route('login') }}" id="login-btn-sidebar" class="flex items-center justify-center gap-space-xs w-full py-space-xs px-space-md rounded-full bg-primary-container text-on-primary-container font-label-lg text-label-lg font-semibold hover:bg-primary hover:text-on-primary transition-all shadow-sm">
                <span class="material-symbols-outlined">login</span>
                <span>Masuk Sistem</span>
            </a>
            @endif
        </div>
    </aside>
    
    <div class="lg:pl-[260px] transition-all duration-300 w-full overflow-x-hidden">
        <header class="fixed top-0 lg:left-[260px] left-0 right-0 h-16 bg-surface/80 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-30 flex items-center justify-between px-space-md lg:px-space-xl">
            <div class="flex items-center gap-space-sm lg:gap-space-md">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 text-primary hover:bg-surface-container rounded-lg focus:outline-none transition-colors flex items-center justify-center">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <img alt="JTIK ROOM'S Logo" class="h-8 w-auto object-contain hidden sm:block" src="{{ asset('img/logo1.png') }}"/>
                <span class="font-headline-sm text-headline-sm text-primary font-bold">JTIK ROOM'S</span>
                <span class="hidden md:inline-block px-space-xs py-0.5 rounded-full bg-surface-container text-primary font-label-sm text-label-sm font-semibold truncate max-w-[200px] xl:max-w-none">Jurusan Teknologi Informasi & Komputer</span>
            </div>
            <div class="flex items-center gap-space-xs lg:gap-space-md">
                <div class="flex items-center gap-space-xs px-space-sm py-1.5 rounded-full bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm">
                    @php
                        $month = (int) date('m');
                        $year = (int) date('Y');
                        
                        // Agustus s/d Desember -> Ganjil tahun ini / tahun depan
                        if ($month >= 8) {
                            $semester = 'Ganjil';
                            $tahunAjaran = $year . '/' . ($year + 1);
                        } 
                        // Januari -> Ganjil tahun lalu / tahun ini
                        elseif ($month <= 1) {
                            $semester = 'Ganjil';
                            $tahunAjaran = ($year - 1) . '/' . $year;
                        } 
                        // Februari s/d Juli -> Genap tahun lalu / tahun ini
                        else {
                            $semester = 'Genap';
                            $tahunAjaran = ($year - 1) . '/' . $year;
                        }
                    @endphp
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse shrink-0"></span>
                    <span class="hidden sm:inline">Semester {{ $semester }} {{ $tahunAjaran }}</span>
                    <span class="sm:hidden">{{ $semester }} {{ $tahunAjaran }}</span>
                </div>
                <img alt="Profile" class="w-8 h-8 rounded-full object-cover shrink-0" src="https://ui-avatars.com/api/?name={{ urlencode(session('user') ?? 'User') }}&background=0058be&color=fff&rounded=true&bold=true"/>
            </div>
        </header>
        
        <main class="relative pt-16 bg-surface min-h-screen overflow-hidden">
            @yield('content')
        </main>
    </div>
    
</body>
</html>
