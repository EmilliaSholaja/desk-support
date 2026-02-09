<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Internal Help Desk | EmilliaSholaja</title>
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite([ 'resources/css/app.css', 'resources/js/app.js' ])
<body>
    @auth
        <header class="bg-blue-900">
            <nav class="flex flex-row items-center justify-between px-6 py-3 ">
                <div>
                    <h2 class="text-white text-lg font-medium hover:text-gray-100" >
                        <a href="{{ route('home') }}">
                            Internal Desk Help
                        </a>
                    </h2>
                </div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="w-15 h-15 rounded-full overflow-hidden border-2 cursor-pointer border-blue-500  flex items-center justify-center">
                        <img  src="{{asset('images/robot.png')}}" alt="My Profile Image">
                    </button>

                    <div class="absolute top-10 right-2 bg-white flex flex-col justify-center  w-30 shadow-lg rounded-sm text-left text-sm text-blue-950 font-medium" x-show="open"  x-transition @click="open = !open">
                        <ul>
                            <li class="border-b border-gray-300 px-5 py-1"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="border-b border-gray-300 px-5 py-1"><a href="#">Profile</a></li>
                            <li class="border-b border-gray-300 px-5 py-1"><a href="{{ route('admin.tickets.index') }}">Admin</a></li>
                            <li class="border-b border-gray-300 px-5 py-1"><a href="{{ route('tickets.create') }}">Create Ticket</a></li>
                            <li class="last:border-b-0 border-b border-gray-300 px-5 py-1 hover:text-red-500">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="cursor-pointer">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>
        </header>
    @endauth
    <main class="py-8 px-4 mx-auto">
        <x-flash-msg />
        {{ $slot }}
    </main>
    <footer class=" bg-blue-950 flex flex-col md:flex-row md:items-center md:justify-between gap-6 px-4 py-6 mt-3 text-gray-500 text-center shadow-xl">
        <p class="text-sm">&copy; <span class="text-white font-semibold">Internal Help Desk.</span> All rights reserved.</p>
        <address class="not-italic">
            Email:
            <a href="mailto:support@mywebsite.com" class="text-blue-400 hover:text-blue-300 transition">
                support@mywebsite.com
            </a>
        </address>
       <!-- Middle: Links -->
        <nav class="flex gap-3 justify-center items-center text-sm">
            <a href="/about" class="hover:text-white transition">About</a>
            <span class="text-gray-500">|</span>
            <a href="/contact" class="hover:text-white transition">Contact</a>
            <span class="text-gray-500">|</span>
            <a href="/privacy" class="hover:text-white transition">Privacy Policy</a>
        </nav>
        <div class="flex gap-3 justify-center items-center">
            <a href="https://twitter.com/mywebsite" class="hover:text-white transition">Twitter</a>
            <a href="https://instagram.com/mywebsite" class="hover:text-white transition">Instagram</a>
        </div>
    </footer>

</body>
</html>