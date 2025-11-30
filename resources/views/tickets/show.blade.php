<x-app-layout>
    <div class="max-w-4xl mt-4 mx-auto p-6 bg-white rounded-lg shadow-lg">
        <!-- Ticket Title -->
        <h1 class="text-3xl font-semibold text-center text-gray-900 mb-4">{{ $ticket->title }}</h1>
        <h3 class="text-xl font-semibold text-center text-gray-900 mb-4">{{ $ticket->category }}</h3>
        
        <!-- Ticket Details -->
        <div class="flex flex-col items-center space-y-3 mb-6">
            <p class="text-lg font-medium text-gray-700">{{ $ticket->status }} | {{ $ticket->priority }}</p>
            <p class="text-sm text-gray-500">{{ $ticket->created_at->format('F j, Y, g:i a') }}</p>
            <p class="text-md text-gray-800">{{ $ticket->user->name }}</p>
        </div>
        
        <!-- Ticket Description -->
        <div class="prose prose-lg text-gray-800 mb-6">
            <p>{{ $ticket->description }} </p>
        </div>

        <!-- Buttons -->
        <div class="flex justify-center space-x-4 mb-6">
            <a href="{{ route('tickets.index') }}">
                <button class="bg-green-600 font-bold text-center rounded-lg py-2 px-4 text-white">BACK TO TICKETS</button>
            </a>
            @can('update', $ticket)
                <a href="{{ route('tickets.edit', $ticket) }}">
                    <button class="bg-blue-600 font-bold text-center rounded-lg py-2 px-4 text-white">UPDATE</button>
                </a>
            @endcan
            
            @can('delete', $ticket)
                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 font-bold text-center rounded-lg py-2 px-4 text-white">DELETE</button>
                </form>

                
            @endcan

        </div>

    @if(session('success'))
    <div id="success-msg" class="mb-4 px-4 py-2 bg-green-500 text-white rounded">
        {{ session('success') }}
    </div>

    <script>
        // Wait 2 seconds then remove the message
        setTimeout(function() {
            const msg = document.getElementById('success-msg');
            if(msg) {
                msg.style.transition = "opacity 0.5s ease";
                msg.style.opacity = 0;
                setTimeout(() => msg.remove(), 500); // remove after fade out
            }
        }, 2000);
    </script>
@endif


        <form action="{{ route('tickets.transfer', $ticket) }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-2">
                    <label for="category" class="block mb-1 font-medium text-gray-700">Transfer to Department</label>
                    <select id="category" name="category" class="block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Select Department</option>
                        <option value="IT Support">IT Support</option>
                        <option value="HR">HR</option>
                        <option value="Facilities">Facilities</option>
                        <option value="Finance">Finance</option>
                        <option value="Admin">Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('category')" class="mt-1" />
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Transfer Ticket
                </button>
            </form>

        <!-- Comments Section -->
            <div class="border-t border-gray-300 pt-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Comments</h2>

                <!-- Comment Form -->
                <form action="{{ route('tickets.comments.store', $ticket) }}" method="POST" class="space-y-4 mb-6" enctype="multipart/form-data">
                    @csrf
                    <textarea name="content" rows="4" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Add a comment..."></textarea>
                    <input type="file" name="attachment" class="border border-gray-300 rounded-lg p-2 w-full">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Add Comment</button>
                </form>

                <!-- @if ($user->isAdmin())
                <form action="{{ route('tickets.comments.store', $ticket) }}" method="POST" class="space-y-4 mb-6">
                    @csrf
                    <textarea name="content" rows="4" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Add a comment..."></textarea>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Add Comment</button>
                </form>
                @endif -->
                <!-- Existing Comments -->
                @foreach ($ticket->comments as $comment)
                    <div class="border border-gray-300 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-gray-700 font-semibold">{{ $comment->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $comment->created_at->format('F j, Y, g:i a') }}</p>
                        </div>
                        <p>{{ $comment->content }}</p>
                        @if($comment->attachment)
            @if($comment->attachment)
                <a href="{{ asset('storage/' . $comment->attachment) }}" 
                target="_blank" 
                class="text-blue-600 hover:underline">
                    View Attachment
                </a>
            @endif

        @endif
                    </div>
                @endforeach
            </div>
    </div>
</x-app-layout>
