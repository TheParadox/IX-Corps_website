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
                            <div class="bg-blue-200 border-2 w-full rounded-lg">
                                <a href="{{ route('newCompany') }}" class="p-3">New Company</a>
                            </div>
                        </li>
                    @endif
                    @if (auth()->user()->permissions > 2)
                        <li>
                            <a href="{{ route('newRank') }}" class="p-3">New Rank</a>
                        </li>
                    @endif
                </ul>
    
            </nav>



            <form method="POST" action="{{ route('newCompany') }}">
                @csrf

                <div class="mb-4">
                    <label for="regiment" class="">Regiment:</label>
                    <select type="select" name="regiment" id="regiment" placeholder="regiment"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="">

                    <option hidden disabled selected value> -- select an option -- </option>

                    @if ($data)
                        @foreach ($data as $reg)   
                            <option value="{{ $reg['id'] }}">{{ $reg['name'] }}</option>
                        @endforeach
                    @endif

                    </select>
                </div>


                <div class="mb-4">
                    <label for="letter" class="">Letter:</label>
                    <input type="text" name="letter" id="letter" placeholder="Company Letter or 'Staff'"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('letter') border-red-500 @enderror" value="{{ old('letter') }}">

                    @error('letter')
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