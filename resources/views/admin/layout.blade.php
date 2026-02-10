<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tanger Clinique</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-xl">
            <div class="h-16 flex items-center justify-center border-b border-slate-800 bg-slate-900">
                <h1 class="text-xl font-bold tracking-wider text-blue-400">CLINIQUE ADMIN</h1>
            </div>

            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Tableau de bord</span>
                </a>

              

                <a href="{{ route('admin.blogs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.blogs.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span>Articles Blog</span>
                </a>
                
                </nav>
            
            </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50">
            
            <header class="h-16 bg-white shadow-sm flex justify-between items-center px-6 lg:px-8 z-20 relative">
                
                <h2 class="text-xl font-semibold text-gray-800">
                    @yield('title', 'Administration')
                </h2>

                <div x-data="{ open: false }" class="relative">
                    
                    <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-blue-600 focus:outline-none transition-colors">
                        <span class="font-medium text-sm">{{ Auth::user()->name }}</span> <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>

                    <div x-show="open" 
                         @click.outside="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100 z-50"
                         style="display: none;">
                        
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                            <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                            Mon Profil
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                                Déconnexion
                            </button>
                        </form>
                    </div>

                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>