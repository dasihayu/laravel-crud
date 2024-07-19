@extends('layouts.app')

@section('title', 'Authors')
@section('body')

    <form class="max-w-sm mx-auto m-4" action="/authors" method="GET">
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Authros" required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
        </div>
    </form>
    <div class="flex item-center justify-between">
        <h1 class="text-2xl font-medium">Authors</h1>
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            <a href="{{ route('authors.create') }}" class="button">New Author</a>
        </button>
        
    </div>

    @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author)    
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap cursor-pointer">
                            <a href="{{ route('author.profile', ['id' => $author->id]) }}">
                                {{ $author->name }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $author->email }}
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('authors.edit', $author->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <button onclick="deleteAuthor({{ $author->id }})" class="font-medium text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $authors->links() }}
    </div>
    <script>
        function deleteAuthor(authorId) {
            event.preventDefault(); // Mencegah reload halaman
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/authors/${authorId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            console.log('Response:', response);
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Data:', data);
                            if (data.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'The author has been deleted.',
                                    'success'
                                );
                                location.reload();
                        } else {
                            throw new Error('Failed to delete author');
                        }
                        })
                        .catch(error => {
                            console.error('Error:', error.message);
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the author.',
                                'error'
                            );
                        });
                    }
                });
        }
</script>


@endsection