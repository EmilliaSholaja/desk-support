<x-layout>
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Ticket Header -->
        <div class="shadow-md rounded-lg p-4 bg-white">
            <div class="mb-4 flex items-center gap-4">
                <h1 class="uppercase text-3xl font-semibold">{{ $ticket->title }}</h1>
                <h3 class="capitalize inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $ticket->status_color }}">
                    {{ $ticket->status }}
                </h3>
            </div>

            <!-- Attachments -->
            @if($ticket->attachments->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">
                    @foreach($ticket->attachments as $file)
                        <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank">
                            <img 
                                src="{{ asset('storage/'.$file->file_path) }}" 
                                class="rounded border hover:opacity-80"
                            >
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 italic">No Attachment(s)</p>
            @endif
        </div>

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
                            You • {{ $ticket->created_at->format('d M Y H:i') }}
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

                            <small class="block mt-2 {{ $isAdmin ? 'text-left text-gray-900' : 'text-right text-blue-700' }} text-xs text-blue-700">
                                {{ $isAdmin ?  $reply->user->name: 'You' }} • {{ $reply->created_at->format('d M Y H:i') }}
                            </small>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($ticket->status !== 'closed')
            <div class=" shadow-lg rounded-lg p-4 bg-white">
                <div>
                  
                    <form action="{{ route('tickets.replies.store', $ticket) }}"  method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                            <textarea name="body" id="body" rows="4" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm rounded-md p-2 border border-gray-300 @error('body') border-red-500 @enderror" placeholder="Type your message here..."></textarea>
                            @error('body')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button class="w-full flex border-transparent bg-blue-600 hover:bg-blue-700 justify-center py-2 px-4 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors duration-200 text-sm font-medium rounded-md" type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center text-gray-500 italic">This ticket is closed. No further replies can be added.</p>
        @endif

    </div>
</x-layout>
