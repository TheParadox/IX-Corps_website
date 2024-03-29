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
                            <a href="{{ route('newRegiment') }}" class="p-3">New Regiment</a>
                        </li>
                    @endif
                    @if (auth()->user()->permissions > 3)
                        <li>
                            <a href="{{ route('newCompany') }}" class="p-3">New Company</a>
                        </li>
                    @endif
                    @if (auth()->user()->permissions > 2)
                        <li>
                            <div class="bg-blue-200 border-2 w-full rounded-lg">
                                <a href="{{ route('newRank') }}" class="p-3">New Rank</a>
                            </div>
                        </li>
                    @endif
                </ul>
    
            </nav>



            <form method="POST" action="{{ route('newRank') }}">
                @csrf

                <div class="mb-4">
                    <label for="title" class="">Title:</label>
                    <input type="text" name="title" id="title" placeholder="Name of the Rank"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}">

                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="abrv" class="">Abbreviation:</label>
                    <input type="text" name="abrv" id="abrv" placeholder="What is the shortended version of the rank?"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('abrv') border-red-500 @enderror" value="{{ old('abrv') }}">

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
                                <option value="{{ $perm['id'] }}">{{ $perm['name'] }}</option>
                            @endif
                        @endforeach


                        @error('level')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </select>
                </div>

                <div class="mb-4">
                    <input type="hidden" name="createdBy" id="createdBy" value="{{ auth()->user()->id }}">
                </div>



                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Register</button>
            </form>

        </div>
    </div>
@endsection