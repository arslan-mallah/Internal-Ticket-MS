<x-app-layout>
    <div class="flex flex-col justify-center p-5 space-y-4">
        <h1 class="text-3xl font-bold text-center">Open Tickets</h1>

        <form action="{{ route('tickets.index') }}" method="get" class="flex justify-center space-x-4">
            @csrf
            <select name="priority" class="border border-gray-300 rounded-lg py-2 px-4">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Filter</button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
        @foreach ($tickets as $ticket)
            <x-ticket-card :ticket="$ticket" />
        @endforeach
    </div>

    <div class="p-6">
        {{ $tickets->links() }}
    </div>
</x-app-layout>
