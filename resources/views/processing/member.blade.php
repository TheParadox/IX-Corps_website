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
                        <a href="{{ route('newAward') }}" class="p-3">New Award</a>
                    </li>
                    <li>
                        <div class="bg-blue-200 border-2 w-full rounded-lg">
                            <a href="{{ route('newMember') }}" class="p-3">New Member</a>
                        </div>
                    </li>
                </ul>
    
            </nav>



            <form action="{{ route('newMember') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="">Display name:</label>
                    <input type="text" name="name" id="name" placeholder="What you are refered to, as"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">

                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="discordName" class="">Discord Username:</label>
                    <input type="text" name="discordName" id="discordName" placeholder="Username#number"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('discordName') border-red-500 @enderror" value="{{ old('discordName') }}">

                    @error('discordName')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="companyToolName" class="">Company Tool Name:</label>
                    <input type="text" name="companyToolName" id="companyToolName" placeholder="Tool Name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('companyToolName') border-red-500 @enderror" value="{{ old('companyToolName') }}">

                    @error('companyToolName')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="joinDate" class="">Date Joined:</label>
                    <input type="date" name="joinDate" id="joinDate" placeholder="Date Joined"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="">
                </div>

                <div class="mb-4">
                    <label for="unit" class="">Unit:</label>
                    <select type="select" name="unit" id="unit" placeholder="Unit"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="">

                    <option hidden disabled selected value> -- select an option -- </option>

                    @foreach ($data as $reg)
                        <optgroup label="{{ $reg['name'] }}">
                            @if ($reg['companies'])
                                @foreach ($reg['companies'] as $comp)   
                                    <option value="{{ $comp['id'] }}">{{ $comp['name'] }}</option>
                                @endforeach
                            @endif
                        </optgroup>
                    @endforeach

                    </select>
                </div>

                <div class="mb-4">
                    <label for="recruiter" class="">Recruiter:</label>
                    <input type="text" name="recruiter" id="recruiter" placeholder="Recruiters Display Name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('recruiter') border-red-500 @enderror" value="{{ old('recruiter') }}">

                    @error('recruiter')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="processor" class="">Processor:</label>
                    <input type="text" name="processor" id="processor" placeholder="Processors Display Name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('processor') border-red-500 @enderror" value="{{ old('processor') }}">

                    @error('processor')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Register</button>
            </form>

        </div>
    </div>
@endsection