<x-layout>
        <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white w-full p-10 rounded-lg shadow-md m-8">
            <div class="text-center">
                <h1 class=" text-blue-600 text-center text-3xl font-bold">Welcome Back</h1>
                    <p class="mt-2 text-sm text-gray-600">
                    Don't have an account yet?
                    <a  href="{{ route('register') }}"class="font-medium text-blue-600 transition duration-150 ease-in-out">
                        Sign up
                    </a>
                </p>
            </div>
           
            <form action="{{ route('login') }}" class="mt-8 space-y-8" method="post">
                @csrf


                <div>
                    <label for="email" class=" block text-sm font-medium mt-1 text-blue-500">Email</label>
                    <input type="text" aria-label="Email" placeholder="emilliasholaja@example.com" name="email" value="{{ old('email') }}"
                        class=" appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-grey-200 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out {{ $errors->has('email') ? 'border-red-500 text-red-900' : 'border-gray-300' }}">
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class=" block text-sm font-medium mt-1 text-blue-500">Password</label>
                    <input type="password" aria-label="Password" placeholder="••••••••" name="password" autocomplete="new-password"
                        class=" appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-grey-200 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out {{ $errors->has('password') ? 'border-red-500 text-red-900' : 'border-gray-300' }}">
                    @error('password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </div>

                @error('failed')
                    <p class="error">{{ $message }}</p>
                @enderror
                
                <div>
                    <button class="w-full flex border-transparent bg-blue-600 hover:bg-blue-700 justify-center py-2 px-4 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors duration-200 text-sm font-medium rounded-md" type="submit">Sign in</button>
                </div>


            </form>
        </div>
    </div>
</x-layout>