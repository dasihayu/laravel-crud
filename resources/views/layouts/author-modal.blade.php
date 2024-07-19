<div x-data="{ open: false }">
    <!-- Button to open the modal -->
    <button @click="open = true" class="px-4 py-2 bg-blue-500 text-white rounded">View Author Details</button>

    <!-- Modal Background -->
    <div x-show="open" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <!-- Modal Content -->
        <div @click.away="open = false" class="bg-white rounded-lg shadow-lg p-6 w-1/2">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold">Author Details</h2>
                <button @click="open = false" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-4">
                <!-- Author details here -->
                <p><strong>Name:</strong> {{ $author->name }}</p>
                <p><strong>Email:</strong> {{ $author->email }}</p>
                <!-- Add more fields as needed -->
            </div>
        </div>
    </div>
</div>
