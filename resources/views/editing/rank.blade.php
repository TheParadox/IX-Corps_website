@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">     
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <form method="POST" action="{{ route('editRank', ['rankID' => $data->id]) }}">
                @csrf

                <div class="mb-4">
                    <label for="title" class="">Title:</label>
                    <input type="text" name="title" id="title" placeholder="Name of the Rank"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ $data['grade'] }}">

                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="abrv" class="">Abbreviation:</label>
                    <input type="text" name="abrv" id="abrv" placeholder="What is the shortended version of the rank?"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('abrv') border-red-500 @enderror" value="{{ $data['abrv'] }}">

                    @error('abrv')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="level" class="">Permissions Level:</label>
                    <select type="select" name="level" id="level" placeholder="level"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="">

                        <option hidden disabled selected value> -- select an option -- </option>

                        @foreach ($perms as $perm)  
                            @if ($perm['level'] <= auth()->user()->permissions)
                                <option value="{{ $perm['id'] }}" 
                                @if ($perm['id'] == $data['level'])
                                    selected
                                @endif
                                >{{ $perm['name'] }}</option>
                            @endif
                        @endforeach


                        @error('level')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Update</button>
            </form>

        </div>
    </div>
@endsection