@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">     
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <nav class="p-4 pb-10 bg-white flex justify-between">
                <ul class="flex items-center">
                    <li>
                        <a href="{{ route('newMember') }}" class="p-3">New Member</a>
                    </li>
                    @if (auth()->user()->permissions > 1)
                        <li>
                            <a href="{{ route('newAward') }}" class="p-3">New Award</a>
                        </li>
                    @endif
                    @if (auth()->user()->permissions > 4)
                        <li>
                            <div class="bg-blue-200 border-2 w-full rounded-lg">
                                <a href="{{ route('newRegiment') }}" class="p-3">New Regiment</a>
                            </div>
                        </li>
                    @endif
                    @if (auth()->user()->permissions > 3)
                        <li>
                            <a href="{{ route('newCompany') }}" class="p-3">New Company</a>
                        </li>
                    @endif
                    @if (auth()->user()->permissions > 2)
                        <li>
                            <a href="{{ route('newRank') }}" class="p-3">New Rank</a>
                        </li>
                    @endif
                </ul>
    
            </nav>



            <form method="POST" action="{{ route('newRegiment') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Full Regiment Name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">

                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="abrv" class="">Unit Abreviation:</label>
                    <input type="text" name="abrv" id="abrv" placeholder="Shortened version of the unit name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('abrv') border-red-500 @enderror" value="{{ old('abrv') }}">

                    @error('abrv')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="type" class="">Unit Type:</label>
                    <input type="text" name="type" id="type" placeholder="Type of unit: Infantry, Artillery, etc..."
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('type') border-red-500 @enderror" value="{{ old('type') }}">

                    @error('type')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descriptor" class="">Descriptor of troops:</label>
                    <input type="text" name="descriptor" id="descriptor" placeholder="Describing the troops: Rifles, Crew, Troops, etc..."
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ old('descriptor') }}">
                </div>


                <div class="mb-4">
                    <input type="hidden" name="createdBy" id="createdBy" value="{{ auth()->user()->id }}">
                </div>



                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Register</button>
            </form>

        </div>
    </div>
@endsection