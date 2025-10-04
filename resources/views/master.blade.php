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
                    <h1 class="text-xl font-bold bg-[#B6CEB4] px-8 py-1 rounded-4xl font-serif" >@yield('page-title', 'App Pegawai')</h1>
                </li>
                <li class="ml-auto flex items-center space-x-6">
                    <a href="{{ url('/employee') }}" class="text-slate-700 font-medium hover:bg-[#D9E9CF] px-3 py-2 rounded-2xl">Employee</a>
                    <a href="{{ url('/department') }}" class="text-slate-700 font-medium hover:bg-[#D9E9CF] px-3 py-2 rounded-2xl">Department</a>
                    <a href="{{ url('/attendance') }}" class="text-slate-700 font-medium hover:bg-[#D9E9CF] px-3 py-2 rounded-2xl">Attendance</a>
                    <a href="{{ url('/report') }}" class="text-slate-700 font-medium hover:bg-[#D9E9CF] px-3 py-2 rounded-2xl">Report</a>
                    <a href="{{ url('/account') }}" class="text-slate-700 hover:text-[#B6CEB4] flex items-center">
                        <span class="material-symbols-outlined text-xl">account_circle</span>
                    </a>
                    <a href="{{ url('/settings') }}" class="text-slate-700 hover:text-[#B6CEB4] flex items-center">
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