<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-slate-100">
            
            @include('layouts.sidebar')

            <div class="flex-1 flex flex-col">
                
                <header class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-center m-8 mb-0">
                    <div class="relative w-full max-w-xs">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>

                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-bold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </button>

                        <div x-show="open" 
                             x-transition
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            
                            <div class="px-4 py-2 text-sm text-gray-700">
                                <p class="font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <hr class="my-1">

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <main>
                    {{ $slot }}
                </main>
            </div>

        </div>
        @if (session('success'))
        <div 
            x-data 
            x-init="
                Toastify({
                    text: '{{ session('success') }}',
                    duration: 3000,
                    // ...style lainnya
                }).showToast();
            ">
        </div>
    @endif
        
    </body>
</html>