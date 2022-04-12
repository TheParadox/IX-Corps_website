@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">     
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <nav class="p-4 pb-10 bg-white flex justify-between">
                <ul class="flex items-center">
                    @if (auth()->user()->permissions > 0)
                        <li>
                            <a href="{{ route('nominateAward') }}" class="p-3">Nominate Award</a>
                        </li>
                    @endif
                    @if (auth()->user()->permissions > 2)
                        <li>
                                <a href="{{ route('nominateRank') }}" class="p-3">Nominate Promotion</a>
                        </li>
                    @endif
                    @if (auth()->user()->permissions > 2)
                        <li>
                            <a href="{{ route('nominatePosition') }}" class="p-3">Nominate Position</a>
                        </li>
                    @endif
                    @if (auth()->user()->permissions > 1)
                        <li>
                            <div class="bg-blue-200 border-2 w-full rounded-lg">
                                <a href="{{ route('transferRequest') }}" class="p-3">Transfer Request</a>
                            </div>
                        </li>
                    @endif
                </ul>
    
            </nav>

            <form method="POST" action="{{ route('transferRequest') }}">
                @csrf

                <div class="mb-4">
                    <label for="nominee" class="">Requestor:</label>
                    <input type="text" name="nominee" id="title" placeholder="Whom is wanting to get transfered"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('nominee') border-red-500 @enderror" value="{{ old('nominee') }}">

                    @error('nominee')
                        <div class="text-red-500 mt-2 text-m">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <textarea name="unitError" id="unitError"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('unitError') border-red-500 @enderror" value="{{ old('unitError') }}"></textarea>

                    @error('unitError')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="unit" class="">Unit to be transfered to:</label>
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
                    <label for="reason" class="">Reason:</label>
                    <textarea name="reason" id="reason" placeholder="Why they deserve this promotion?"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('reason') border-red-500 @enderror" value="{{ old('reason') }}"></textarea>

                    @error('reason')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="hidden" name="createdBy" id="createdBy" value="{{ auth()->user()->id }}">
                </div>



                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium">Nominate</button>
            </form>

        </div>
    </div>
@endsection