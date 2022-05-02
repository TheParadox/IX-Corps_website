@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">     
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <form method="POST" action="{{ route('createPositionNomination') }}">
                @csrf

                <div class="mb-4">
                    <label for="nominee" class="">Nominee:</label>
                    <input type="text" name="nominee" id="title" placeholder="Who should get the position"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('nominee') border-red-500 @enderror" value="{{ old('nominee') }}">

                    @error('nominee')
                        <div class="text-red-500 mt-2 text-m">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="position" class="">Position: {{ $position }}</label>
                </div>


                <div class="mb-4">
                    <label for="reason" class="">Reason:</label>
                    <textarea name="reason" id="reason" placeholder="Why they deserve this position?"
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



                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium ">Nominate</button>
            </form>

        </div>
    </div>
@endsection