@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">     
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <form method="POST" action="{{ route('editRegiment', ['regimentID' => $data->id]) }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Full Regiment Name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ $data['name'] }}">

                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="abrv" class="">Unit Abreviation:</label>
                    <input type="text" name="abrv" id="abrv" placeholder="Shortened version of the unit name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('abrv') border-red-500 @enderror" value="{{ $data['abrv'] }}">

                    @error('abrv')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="type" class="">Unit Type:</label>
                    <input type="text" name="type" id="type" placeholder="Type of unit: Infantry, Artillery, etc..."
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('type') border-red-500 @enderror" value="{{ $data['type'] }}">

                    @error('type')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descriptor" class="">Descriptor of troops:</label>
                    <input type="text" name="descriptor" id="descriptor" placeholder="Describing the troops: Rifles, Crew, Troops, etc..."
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ $data['descriptor'] }}">
                </div>


                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Update</button>
            </form>

        </div>
    </div>
@endsection