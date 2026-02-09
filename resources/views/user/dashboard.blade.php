<x-layout>
    <div class="grid">
        <h1 class="text-blue-700 text-3xl font-bold mb-8">Welcome, <span class="text-blue-800">{{ Auth::user()->name}}</span></h1>
        @if ($tickets->count() == 0)
            <div class="mb-8 flex flex-col items-center justify-center gap-4 border border-dashed border-gray-500 rounded-lg shadow-sm p-6 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">No tickets yet.</h3>
                <p class="text-gray-500">You haven't created any tickets.</p>
                <a href="{{ route('tickets.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md transition duration-200">
                    + Create Ticket
                </a>
            </div>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="w-full border-collapse text-sm text-gray-700">
                    <thead class="bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wide">
                        <td class="px-4 py-3">Ticket ID</td>
                        <td class="px-4 py-3">Ticket Subject</td>
                        <td class="px-4 py-3">Category</td>
                        <td class="px-4 py-3">Status</td>
                        <td class="px-4 py-3">Last Updated</td>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ( $tickets as $ticket )
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 py-3 font-medium text-gray-900">
                                   <a href="{{ route('tickets.show', ['ticket'=> $ticket->uuid]) }}">#{{ $ticket->id }}</a> 
                                </td>

                                <td class="px-4 py-3 text-gray-700 max-w-xs truncate">
                                    {{ $ticket->message }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $ticket->category->name }}
                                </td>

                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $ticket->status_color }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-gray-500 whitespace-nowrap">
                                    {{ $ticket->updated_at->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layout>