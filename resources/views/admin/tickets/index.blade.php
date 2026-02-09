<x-layout>
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">

        <h2 class="text-2xl font-semibold text-gray-800 my-4 px-4">All Support Tickets</h2>
        
        <div>
            <form action="{{ route('admin.tickets.index') }}" method="GET" class="flex gap-2 items-center mx-4 mb-4">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search tickets..." 
                    value="{{ request('search') }}"
                    class="border border-gray-300 rounded-md px-3 py-2 w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <select name="status" class="border border-gray-300 rounded-md px-3 py-2">
                    <option value="">All Statuses</option>
                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>

                <button 
                    type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
                >
                    Search
                </button>
            </form>
        </div>

        <table class="w-full border-collapse text-sm text-gray-700">
            <thead class="bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wide">
                <td class="px-4 py-3">Ticket ID</td>
                <td class="px-4 py-3">Ticket Title</td>
                <td class="px-4 py-3">Ticket Subject</td>
                <td class="px-4 py-3">User Full Name</td>
                <td class="px-4 py-3">Category</td>
                <td class="px-4 py-3">Status</td>
                <td class="px-4 py-3">Priority</td>
                <td class="px-4 py-3">Created At</td>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ( $tickets as $ticket )
                    <tr class="hover:bg-gray-50 transition-colors duration-150 text-sm">
                        <td class="px-4 py-3 font-medium text-gray-900">
                            <a href="{{ route('admin.tickets.show', ['ticket'=> $ticket->uuid]) }}">#{{ $ticket->id }}</a> 
                        </td>

                        <td class="px-4 py-3 text-gray-700 max-w-xs truncate">
                            {{ $ticket->title}}
                        </td>

                        <td class="px-4 py-3 text-gray-700 max-w-xs truncate">
                            {{ $ticket->message }}
                        </td>

                        <td class="px-4 py-3 text-gray-700 max-w-xs truncate">
                            {{ $ticket->user->name }}
                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            {{ $ticket->category->name }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $ticket->status_color }}">
                                {{ $ticket->status }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            {{ $ticket->priority }}
                        </td>

                        <td class="px-4 py-3 whitespace-nowrap text-gray-500">
                            {{ $ticket->created_at->format('d M Y H:m:s') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $tickets->links() }}
        </div>
    </div>
</x-layout>