<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex flex-col">
    <header>
        <nav class="bg-[#F0F0F0] border-1 border-slate-300 rounded-xl p-5">
            <ul class="flex flex-row ">
                <li>
                    <h1 class="text-xl text-white font-bold bg-[#1B3C53] px-8 py-1 rounded-4xl font-serif" >@yield('page-title', 'App Pegawai')</h1>
                </li>
                <li class="ml-auto flex items-center space-x-6">
                    
                    @php
                        // Dapatkan segmen pertama dari URI (misal: 'employees', 'departments', 'positions')
                        $segment = Request::segment(1);
                    @endphp
                    
                    {{-- Navigasi Employee --}}
                    <a href="{{ route('employees.index') }}" 
                       class="font-medium px-3 py-2 rounded-2xl 
                       {{ $segment == 'employees' ? 'bg-[#1B3C53] text-white font-bold' : 'text-slate-700 hover:bg-[#1B3C53] hover:text-white' }}">
                       Employee
                    </a>
                    
                    {{-- Navigasi Department --}}
                    <a href="{{ route('departments.index') }}" 
                       class="font-medium px-3 py-2 rounded-2xl 
                       {{ $segment == 'departments' ? 'bg-[#1B3C53] text-white font-bold' : 'text-slate-700 hover:bg-[#1B3C53] hover:text-white' }}">
                       Department
                    </a>
                    
                    {{-- Navigasi Position --}}
                    <a href="{{ route('positions.index') }}" 
                       class="font-medium px-3 py-2 rounded-2xl 
                       {{ $segment == 'positions' ? 'bg-[#1B3C53] text-white font-bold' : 'text-slate-700 hover:bg-[#1B3C53] hover:text-white' }}">
                       Position
                    </a> 

                    {{-- Navigasi Salaries --}}
                    <a href="{{ route('salaries.index') }}" 
                       class="font-medium px-3 py-2 rounded-2xl 
                       {{ $segment == 'salaries' ? 'bg-[#1B3C53] text-white font-bold' : 'text-slate-700 hover:bg-[#1B3C53] hover:text-white' }}">
                       Salaries
                    </a> 

                    <a href="{{ route('attendance.index') }}" 
                       class="font-medium px-3 py-2 rounded-2xl 
                       {{ $segment == 'attendance' ? 'bg-[#1B3C53] text-white font-bold' : 'text-slate-700 hover:bg-[#1B3C53] hover:text-white' }}">
                       Attendance
                    </a>

                    <a href="{{ url('/report') }}" class="text-slate-700 font-medium hover:bg-[#1B3C53] hover:text-white px-3 py-2 rounded-2xl">Report</a>
                    <a href="{{ url('/account') }}" class="text-slate-700 hover:text-[#1B3C53] flex items-center">
                        <span class="material-symbols-outlined text-xl">account_circle</span>
                    </a>
                    <a href="{{ url('/settings') }}" class="text-slate-700 hover:text-[#1B3C53] flex items-center">
                        <span class="material-symbols-outlined text-xl">settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="flex-grow">
        @yield('content')
    </main>
    <footer class="bg-gray-200 text-center py-1 fixed bottom-0 left-0 w-full shadow-inner">
        <p>&copy; {{ date('Y') }} App Pegawai</p>
    </footer>
</body>
</html>
