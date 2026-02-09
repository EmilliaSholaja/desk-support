<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-10 px-6">

            <!-- LEFT: Text Content -->
            <div class="flex flex-col justify-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Welcome to Internal Help Desk
                </h1>

                <p class="text-gray-600 text-lg mb-6">
                    Internal Help Desk is a simple ticketing system that helps users submit issues, track progress,
                    and communicate directly with support staff. Whether it’s a technical problem, request,
                    or complaint, everything is handled in one place.
                </p>

                <ul class="space-y-3 text-gray-700 mb-8">
                    <li>✅ Create support tickets</li>
                    <li>✅ Upload attachments</li>
                    <li>✅ Chat with support in real-time</li>
                    <li>✅ Track ticket status & priority</li>
                </ul>

                <div class="flex gap-4">
                    <a 
                        href="{{ route('register') }}" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition"
                    >
                        Get Started
                    </a>

                    <a 
                        href="{{ route('login') }}" 
                        class="border border-gray-300 text-gray-800 px-6 py-3 rounded-md hover:bg-gray-100 transition"
                    >
                        Login
                    </a>
                </div>
            </div>

            <!-- RIGHT: Visual / Card -->
            <div class="flex items-center justify-center">
                <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
                    <h2 class="text-2xl font-semibold mb-4">Why Use Internal Help Desk?</h2>

                    <div class="space-y-4 text-gray-600 text-sm">
                        <p>
                            📌 No more lost complaints or scattered messages. Everything is documented.
                        </p>
                        <p>
                            📌 Admins can manage, prioritize, and resolve tickets efficiently.
                        </p>
                        <p>
                            📌 Users stay informed with updates and replies in one place.
                        </p>
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 text-blue-700 rounded-md text-sm">
                        “Built for students, startups, and small teams that need a simple support system.”
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
