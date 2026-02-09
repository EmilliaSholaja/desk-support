@if (session()->has('success'))
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-4 right-4 z-50 bg-green-600 text-white px-5 py-3 rounded-lg shadow-lg"
    >
        <p class="text-sm font-medium">
            {{ session('success') }}
        </p>
    </div>
@endif

@if (session()->has('error'))
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-4 right-4 z-50 bg-red-600 text-white px-5 py-3 rounded-lg shadow-lg"
    >
        <p class="text-sm font-medium">
            {{ session('error') }}
        </p>
    </div>
@endif
