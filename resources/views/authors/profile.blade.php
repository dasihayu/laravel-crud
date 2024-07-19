@extends('layouts.app')

@section('title', 'Detail Author')
@section('body')

    @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ofice
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Age
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hobbies
                    </th>
                </tr>
            </thead>
            <tbody>   
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap cursor-pointer">
                            <a href="{{ route('author.profile', ['id' => $author->id]) }}">
                                {{ $author->name }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $author->email }}
                        </td>
                        @if ($author->profile)
                            <td class="px-6 py-4">{{ $author->profile->office }}</td>
                            <td class="px-6 py-4">{{ $author->profile->age }}</td>
                            <td class="px-6 py-4">{{ $author->profile->bio }}</td>
                        @else
                            
                        @endif
                        
                        <td class="px-6 py-4">
                            @forelse ($author->hobbies as $hobby)
                                <ul>
                                    <li>{{ $hobby->name }}</li>
                                </ul>
                                @empty
                                <td>No hobbies found</td>
                            @endforelse
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
@endsection