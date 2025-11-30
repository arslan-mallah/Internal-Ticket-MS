@props(['ticket'])

<div class="flex flex-col border border-gray-300 rounded-lg p-4 bg-white shadow-sm hover:shadow-md transition-shadow duration-300">
    <a  href="{{ route('tickets.show', $ticket) }}" class="font-bold text-xl text-gray-800 mb-2 uppercase">{{ $ticket->title }}</a>
    <p class="text-gray-600 mb-4">{{ $ticket->description }}</p>

    <div class="flex justify-between items-center mb-4">
        <div class="flex space-x-2">
            @can('update', $ticket)
                <a href="{{ route('tickets.edit', $ticket) }}">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Update</button>
                </a>
            @endcan

            @can('delete', $ticket)
                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ticket?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">Delete</button>
                </form>
            @endcan
        </div>

        <p class="text-sm text-gray-500">{{ $ticket->created_at->diffForHumans() }}</p>
    </div>

    <p class="text-gray-700 font-semibold">{{ $ticket->user->name }}</p>
</div>
