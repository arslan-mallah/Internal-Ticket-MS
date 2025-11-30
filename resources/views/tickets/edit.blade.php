<x-app-layout>
    <div class="flex flex-col justify-center items-center p-6">
        <h1 class="text-3xl font-bold">EDIT TICKET</h1>
        <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="space-y-4 w-full max-w-md">
            @method('PUT')
            @csrf
            <!-- Ticket Title -->
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title</label>
                <input id="title" name="title" type="text" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required  value="{{ $ticket->title }}"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Ticket Description -->
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required> {{ $ticket->description }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Ticket Category -->
            <div>
                <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                <select id="category" name="category" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required >
                    <option value="IT Support">IT Support</option>
                    <option value="HR (Human Resources)">HR (Human Resources)</option>
                    <option value="Facilities / Maintenance">Facilities / Maintenance</option>
                    <option value="Finance & Accounts">Finance & Accounts</option>
                    <option value="Admin Department">Admin Department</option>
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <!-- Ticket Priority -->
            <div>
                <label for="priority" class="block mb-2 text-sm font-medium text-gray-700">Priority</label>
                <select id="priority" name="priority" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required >
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
            </div>

            <!-- Ticket Status -->
            @if($user->role === 'admin')
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="open">Open</option>
                    <option value="processing">Processing</option>
                    <option value="closed">Closed</option>
                </select>
                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
            </div>

            @endif
            <div class="text-center">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" type="submit">
                    UPDATE TICKET
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
