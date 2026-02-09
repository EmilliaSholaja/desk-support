<x-layout>
    <div class="max-w-7xl mx-auto py-6">


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- LEFT: Conversation (Span 2) -->
            <div class="md:col-span-2">

                <!-- Conversation -->
                <div class="shadow-md rounded-lg p-4 bg-white">
                    <h3 class="font-semibold text-2xl text-blue-800 mb-4">Feedback</h3>
                    <div class="space-y-4">

                        {{-- Original Ticket Message --}}
                        <div class="flex w-full items-center gap-2 mb-4 justify-end">
                            <div x-data="{ open: false }" class="max-w-lg rounded-lg p-4 shadow-md bg-blue-100 text-blue-900">
                                <p class="text-sm">
                                    <span x-show="!open">
                                        {{ Str::limit($ticket->message, 200) }}
                                    </span>

                                    <span x-show="open">
                                        {{ $ticket->message }}
                                    </span>
                                </p>

                                @if(strlen($ticket->message) > 150)
                                    <button 
                                        @click="open = !open"
                                        class="mt-1 text-xs font-medium text-blue-700 hover:underline focus:outline-none"
                                        type="button"
                                    >
                                        <span x-show="!open">Read more</span>
                                        <span x-show="open">Read less</span>
                                    </button>
                                @endif

                                <small class="block mt-2 text-right text-xs text-blue-700">
                                    {{ $ticket->user->name }} • {{ $ticket->created_at->format('d M Y H:i') }}
                                </small>
                            </div>
                        </div>

                        {{-- Replies --}}
                        @foreach ($ticket->replies as $reply)
                            @php
                                $isAdmin = $reply->user->role === 'admin';
                            @endphp

                            <div class="flex w-full items-center gap-2 mb-4 {{ $isAdmin ? 'justify-start' : 'justify-end' }}">
                                <div x-data="{ open: false }" class="max-w-lg rounded-lg p-4 shadow-md {{ $isAdmin ?  'bg-gray-100 text-gray-900' : 'bg-blue-100 text-blue-900' }}">

                                    <p class="text-sm">
                                        <span x-show="!open">
                                            {{ Str::limit($reply->body, 200) }}
                                        </span>

                                        <span x-show="open">
                                            {{ $reply->body }}
                                        </span>
                                    </p>

                                    @if(strlen($reply->body) > 150)
                                        <button 
                                            @click="open = !open"
                                            class="mt-1 text-xs font-medium text-blue-700 hover:underline focus:outline-none"
                                            type="button"
                                        >
                                            <span x-show="!open">Read more</span>
                                            <span x-show="open">Read less</span>
                                        </button>
                                    @endif

                                    <small class="block mt-2 {{ $isAdmin ? 'text-left text-gray-900' : 'text-right text-blue-700' }} text-xs ">
                                        {{ $reply->user->name }} • {{ $reply->created_at->format('d M Y H:i') }}
                                    </small>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Admin Reply --}}
                @if($ticket->status !== 'closed')
                    <div class="mt-4 shadow-md rounded-lg p-4 bg-white">
                        <form action="{{ route('admin.tickets.reply', $ticket) }}" method="POST">
                            @csrf

                            <label class="block text-sm font-medium mb-1">Admin Reply</label>
                            <textarea 
                                name="body" 
                                rows="3" 
                                class="w-full border rounded-md p-2"
                                placeholder="Type your response..."
                                required
                            ></textarea>

                            <button 
                                type="submit" 
                                class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
                            >
                                Send Reply
                            </button>
                        </form>
                    </div>
                @endif

            </div>

            <!-- RIGHT: Control Panel (Sticky) -->
            <div class="md:col-span-1">
                <div class="sticky top-4 space-y-6">

                    <!-- User Info -->
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="font-semibold mb-2">User Info</h3>

                        <div class="flex items-center gap-3">
                            <img 
                                src="https://ui-avatars.com/api/?name={{ urlencode($ticket->user->name) }}" 
                                class="w-12 h-12 rounded-full"
                            >
                            <div>
                                <p class="font-medium">{{ $ticket->user->name }}</p>
                                <a href="mailto:{{ $ticket->user->email }}" class="text-sm text-blue-600 hover:underline">
                                    {{ $ticket->user->email }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket Info -->
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="font-semibold mb-2">Ticket Info</h3>
                        <p>Status: <strong>{{ ucfirst($ticket->status) }}</strong></p>
                        <p>Priority: <strong>{{ ucfirst($ticket->priority) }}</strong></p>
                        <p>Created: {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>

                    <!-- Attachments -->
                    @if($ticket->attachments->isNotEmpty())
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="font-semibold mb-2">Attachments</h3>

                            <div class="grid grid-cols-2 gap-2">
                                @foreach($ticket->attachments as $file)
                                    <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank">
                                        <img 
                                            src="{{ asset('storage/'.$file->file_path) }}" 
                                            class="rounded border hover:opacity-80"
                                        >
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="bg-white p-4 rounded-lg shadow space-y-4">
                        <h3 class="font-semibold">Actions</h3>

                        <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}">
                            @csrf
                            @method('PATCH')

                            <label class="block text-sm mb-1">Status</label>
                            <select name="status" class="w-full border rounded-md p-2">
                                <option value="open" @selected($ticket->status === 'open')>Open</option>
                                <option value="closed" @selected($ticket->status === 'closed')>Closed</option>
                            </select>

                            <button class="mt-2 w-full bg-gray-800 text-white py-2 rounded-md">
                                Update Status
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.tickets.updatePriority', $ticket) }}">
                            @csrf
                            @method('PATCH')

                            <label class="block text-sm mb-1">Priority</label>
                            <select name="priority" class="w-full border rounded-md p-2">
                                <option value="low" @selected($ticket->priority === 'low')>Low</option>
                                <option value="medium" @selected($ticket->priority === 'medium')>Medium</option>
                                <option value="high" @selected($ticket->priority === 'high')>High</option>
                            </select>

                            <button class="mt-2 w-full bg-gray-800 text-white py-2 rounded-md">
                                Update Priority
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>
</x-layout>
