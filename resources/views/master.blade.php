<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Pegawai</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        
        html {
            font-family: 'Inter', sans-serif;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #1B3C53, #456882);
            transform: translateX(-50%);
            transition: width 0.3s ease;
            border-radius: 2px 2px 0 0;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Simulating Active State for Navigation */
        .nav-link.active {
            background-color: #1B3C53;
            color: white !important; 
        }
        
        .nav-link.active::after {
            width: 0;
        }
        
        .logo-gradient {
            background: linear-gradient(135deg, #1B3C53 0%, #456882 100%);
        }
        
        .icon-button {
            transition: all 0.2s ease;
        }
        
        .icon-button:hover {
            transform: scale(1.1);
            background-color: rgba(27, 60, 83, 0.1);
        }

        /* --- New Dropdown Styles --- */
        .icon-button-container {
            position: relative;
            cursor: pointer;
        }

        .profile-dropdown {
            position: absolute;
            top: 100%; 
            right: 0;
            margin-top: 12px; 
            width: 300px;
            z-index: 60; 
            transform-origin: top right;
            transition: opacity 0.2s ease-out, transform 0.2s ease-out;
        }
        
        .dropdown-link {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            font-weight: 500;
            color: #333;
            transition: background-color 0.15s ease, color 0.15s ease;
            border-radius: 8px; 
        }
        
        .dropdown-link:hover {
            background-color: #f3f4f6;
            color: #1B3C53;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">
    <header class="sticky top-0 z-50">
        <nav class="bg-white shadow-lg">
            <div class="container mx-auto px-6">
                <div class="flex items-center justify-between h-20">
                    <!-- Logo Section -->
                    <div class="flex items-center gap-3">
                        <div class="logo-gradient text-white px-6 py-2.5 rounded-xl font-bold text-xl shadow-md hover:shadow-lg transition-all duration-300 cursor-pointer">
                            App Pegawai
                        </div>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div id="nav-links" class="hidden md:flex items-center gap-2">
                        
                        <a href="{{ route('employees.index') }}" data-segment="employees"
                           class="nav-link px-5 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('employees.*') ? 'active' : 'text-gray-700 hover:bg-gray-100' }}">
                            Employee
                        </a>

                        <a href="{{ route('departments.index') }}" data-segment="departments"
                           class="nav-link px-5 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('departments.*') ? 'active' : 'text-gray-700 hover:bg-gray-100' }}">
                            Department
                        </a>

                        <a href="{{ route('positions.index') }}" data-segment="positions"
                           class="nav-link px-5 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('positions.*') ? 'active' : 'text-gray-700 hover:bg-gray-100' }}">
                            Position
                        </a>

                        <a href="{{ route('salaries.index') }}" data-segment="salaries"
                           class="nav-link px-5 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('salaries.*') ? 'active' : 'text-gray-700 hover:bg-gray-100' }}">
                            Salaries
                        </a>

                        <a href="{{ route('attendance.index') }}" data-segment="attendance"
                           class="nav-link px-5 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('attendance.*') ? 'active' : 'text-gray-700 hover:bg-gray-100' }}">
                            Attendance
                        </a>

                        <a href="{{ route('reports.index') }}" data-segment="reports"
                           class="nav-link px-5 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('reports.*') ? 'active' : 'text-gray-700 hover:bg-gray-100' }}">
                            Report
                        </a>
                    </div>
                    
                    <!-- Right Section - Icons and Profile Dropdown Container -->
                    <div class="flex items-center gap-2 relative">
                        <!-- Notifications Icon -->
                        <div class="relative">
                            <a href="#" class="icon-button p-2.5 rounded-lg text-gray-600 hover:text-[#1B3C53]">
                                <span class="material-symbols-outlined">notifications</span>
                            </a>
                            <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-blue-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                                3
                            </span>
                        </div>
                        
                        <!-- User Account Icon -->
                        <div id="profile-menu-button" class="icon-button-container p-1 rounded-lg">
                            <a href="#" class="icon-button p-1.5 rounded-lg text-gray-600 hover:text-[#1B3C53] flex items-center" 
                                onclick="event.preventDefault(); toggleProfileMenu()">
                                <span class="material-symbols-outlined">account_circle</span>
                            </a>
                        </div>

                        <!-- Profile Dropdown Menu -->
                        <div id="profile-menu" class="profile-dropdown bg-white rounded-xl shadow-2xl p-2 hidden opacity-0 translate-y-2">
                            
                            <!-- User Info -->
                            <div class="p-3 mb-2 flex items-center border-b border-gray-100">
                                <a href="#" class="dropdown-link group">
                                    <span class="material-symbols-outlined mr-3 text-lg text-gray-500 group-hover:text-[#1B3C53]">person</span>
                                </a>
                                <div>
                                    <p class="font-bold text-gray-800">Zahrin Savana</p>
                                    <p class="text-xs text-gray-500">zahrinsavana@gmail.com</p>
                                </div>
                            </div>
                            
                            <!-- Links -->
                            <div class="space-y-1"> 
                                <!-- Show Profile -->
                                <a href="#" class="dropdown-link group">
                                    <span class="material-symbols-outlined mr-3 text-lg text-gray-500 group-hover:text-[#1B3C53]">visibility</span>
                                    Show Profile
                                </a>
                                
                                <!-- Settings -->
                                <a href="#" class="dropdown-link group">
                                    <span class="material-symbols-outlined mr-3 text-lg text-gray-500 group-hover:text-[#1B3C53]">settings</span>
                                    Settings
                                </a>
                            </div>

                            <!-- Sign Out -->
                            <div class="mt-2 pt-2 border-t border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" 
                                    class="dropdown-link group logout-link hover:bg-red-50"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <span class="material-symbols-outlined mr-3 text-lg">logout</span>
                                        Sign out
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    <main class="flex-grow pb-16">
        @yield('content')
    </main>

    <footer class="bg-gray-200 text-center py-3 fixed bottom-0 left-0 w-full shadow-inner">
        <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} App Pegawai</p>
    </footer>

    <script>
        const profileMenu = document.getElementById('profile-menu');
        const profileMenuButton = document.getElementById('profile-menu-button');

        /**
         * Toggles the visibility of the profile menu with a smooth transition effect.
         */
        window.toggleProfileMenu = function() {
            const isHidden = profileMenu.classList.contains('hidden');
            
            if (isHidden) {
                // Show the menu: remove 'hidden', then run transition
                profileMenu.classList.remove('hidden');
                // Timeout ensures 'display: block' registers before transition starts
                setTimeout(() => {
                    profileMenu.classList.remove('opacity-0', 'translate-y-2');
                    profileMenu.classList.add('opacity-100', 'translate-y-0');
                }, 10);
            } else {
                // Hide the menu: run transition, then add 'hidden'
                profileMenu.classList.remove('opacity-100', 'translate-y-0');
                profileMenu.classList.add('opacity-0', 'translate-y-2');
                
                // Wait for the transition to finish before setting display: none
                profileMenu.addEventListener('transitionend', function handler() {
                    profileMenu.classList.add('hidden');
                    profileMenu.removeEventListener('transitionend', handler);
                }, { once: true });
            }
        }

        // Close the dropdown when clicking outside of it
        document.addEventListener('click', (event) => {
            const isMenuOpen = !profileMenu.classList.contains('hidden');
            const isClickInsideMenu = profileMenu.contains(event.target);
            const isClickOnButton = profileMenuButton.contains(event.target);

            if (isMenuOpen && !isClickInsideMenu && !isClickOnButton) {
                // Trigger the hiding transition
                profileMenu.classList.remove('opacity-100', 'translate-y-0');
                profileMenu.classList.add('opacity-0', 'translate-y-2');
                
                profileMenu.addEventListener('transitionend', function handler() {
                    profileMenu.classList.add('hidden');
                    profileMenu.removeEventListener('transitionend', handler);
                }, { once: true });
            }
        });
    </script>
</body>
</html>