@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">     
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <nav class="p-4 pb-10 bg-white flex justify-between">
                <ul class="flex items-center">
                    <li>
                        <a href="{{ route('newRegiment') }}" class="p-3">New Regiment</a>
                    </li>
                    <li>
                        <a href="{{ route('newCompany') }}" class="p-3">New Company</a>
                    </li>
                    <li>
                        <div class="bg-blue-200 border-2 w-full rounded-lg">
                            <a href="{{ route('newAward') }}" class="p-3">New Award</a>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('newMember') }}" class="p-3">New Member</a>
                    </li>
                </ul>
    
            </nav>



            <form method="POST" action="{{ route('newAward') }}">
                @csrf

                <div class="mb-4">
                    <label for="title" class="">Title:</label>
                    <input type="text" name="title" id="title" placeholder="Name of the Award"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}">

                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="unit" class="">Award level:</label>
                    <select type="select" name="unit" id="unit" placeholder="unit"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="">

                    <option hidden disabled selected value> -- select an option -- </option>
                    <option value="0-0"></option>

                    @if ($data)
                        @foreach ($data as $reg)   
                            <option value="{{ $reg['id'] }}">{{ $reg['name'] }}</option>
                        @endforeach
                    @endif

                    </select>
                </div>


                <div class="mb-4">
                    <label for="criteria" class="">Criteria for Awarding:</label>
                    <input type="text" name="criteria" id="criteria" placeholder="What must be done to recieve this award"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('criteria') border-red-500 @enderror" value="{{ old('criteria') }}">

                    @error('criteria')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="hidden" name="createdBy" id="createdBy" value="{{ auth()->user()->id }}">
                </div>



                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Register</button>
            </form>

        </div>
    </div>
@endsection