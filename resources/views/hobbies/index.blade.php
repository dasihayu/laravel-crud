@extends('layouts.app')

@section('title', 'Hobbies')
@section('body')
    <div class="flex item-center justify-between">
        <h1 class="text-2xl font-medium">Hobbies</h1>
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            <a href="{{ route('hobbies.create') }}" class="button">New Hobby</a>
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
                        Hobby
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hobbies as $hobby)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $hobby->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $hobby->authors_count }}
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <button onclick="deleteHobby({{ $hobby->id }})" class="font-medium text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{-- {{ $hobbies->links() }} --}}
    </div>
    <script>
        function deleteHobby(hobbyId) {
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
                        fetch(`/hobbies/${hobbyId}`, {
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