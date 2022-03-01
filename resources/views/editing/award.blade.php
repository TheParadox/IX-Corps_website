@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">     
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <form method="POST" action="{{ route('editAward', ['awardID' => $award->id]) }}">
                @csrf

                <div class="mb-4">
                    <label for="title" class="">Title:</label>
                    <input type="text" name="title" id="title" placeholder="Name of the Award"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ $award['title'] }}">

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
                    <option value="0-0">Corps Wide</option>

                    @if ($data)
                        @foreach ($data as $unit)   
                            <option value="{{ $unit['id'] }}" {{ $unit['selected'] }}>{{ $unit['name'] }}</option>
                        @endforeach
                    @endif

                    </select>
                </div>


                <div class="mb-4">
                    <label for="criteria" class="">Criteria for Awarding:</label>
                    <input type="text" name="criteria" id="criteria" placeholder="What must be done to recieve this award"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('criteria') border-red-500 @enderror" value="{{ $award['awardCriteria'] }}">

                    @error('criteria')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="hidden" name="createdBy" id="createdBy" value="{{ auth()->user()->id }}">
                </div>



                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Update</button>
            </form>

        </div>
    </div>
@endsection