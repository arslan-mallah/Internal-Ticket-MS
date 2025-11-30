<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @php
        $tickets = \App\Models\Ticket::all();
        $usertickets = \App\Models\Ticket::where('user_id', Auth::user()->id)->get();
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::user()->role === 'admin')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col justify-center items-center">
                    <h1 class="text-3xl font-bold">OPEN TICKETS</h1>
                    <p class="text-xl font-bold">{{ $tickets->where('status','open')->count() }}</p>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <h1 class="text-3xl font-bold">CLOSED TICKETS</h1>
                    <p class="text-xl font-bold">{{ $tickets->where('status','closed')->count() }}</p>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <h1 class="text-3xl font-bold">TICKETS IN PROCESS</h1>
                    <p class="text-xl font-bold">{{ $tickets->where('status','processing')->count() }}</p>
                </div>
            </div>
            <a href="{{ route('tickets.index') }}">
                <button class="bg-green-600 font-bold text-center rounded-lg py-2 px-4 m-4 text-white">VIEW ALL TICKETS</button>
            </a>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                @foreach($usertickets as $ticket)
                <div class="flex flex-col justify-center items-center border border-black p-4">
                    <h1 class="font-bold text-2xl uppercase">
                        {{ $ticket->title }}
                    </h1>
                    <p>{{ $ticket->description }}</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('tickets.show', $ticket->id) }}">
                        <button class="bg-green-600 font-bold text-center rounded-lg py-2 px-4 text-white">VIEW</button>
                        </a>
                        @can('update', $ticket)
                        <a href="{{ route('tickets.edit', $ticket) }}">                              
                            <button class="bg-blue-500 font-bold text-center rounded-lg py-2 px-4 text-white">UPDATE</button>
                        </a>
                        @endcan
                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 font-bold text-center rounded-lg py-2 px-4 text-white">DELETE</button>
                        </form>
                    </div>                  
                    <p>{{ $ticket->user->name }}</p>
                    
                </div>
                @endforeach
                
            </div>
            <a href="{{ route('tickets.create') }}">
                <button class="bg-green-600 font-bold text-center rounded-lg py-2 px-4 m-4 text-white">CREATE TICKET</button>
            </div>
            @endif
        </div>
        
    </div>
</x-app-layout>
