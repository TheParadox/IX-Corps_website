@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">     
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <form method="POST" action="{{ route('editCompany', ['companyID' => $data->id]) }}">
                @csrf

                <div class="mb-4">
                    <label for="regiment" class="">Regiment:</label>
                    <select type="select" name="regiment" id="regiment" placeholder="regiment"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="">

                    <option hidden disabled selected value> -- select an option -- </option>

                    @if ($regiments)
                        @foreach ($regiments as $reg)   
                            <option value="{{ $reg['id'] }}"
                            @if ($reg['id'] == $data['regiment_id'])
                                selected
                            @endif
                            >{{ $reg['name'] }}</option>
                        @endforeach
                    @endif

                    </select>
                </div>


                <div class="mb-4">
                    <label for="letter" class="">Letter:</label>
                    <input type="text" name="letter" id="letter" placeholder="Company Letter or 'Staff'"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('letter') border-red-500 @enderror" value="{{ $data['letter'] }}">

                    @error('letter')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="isActive" class="">Is Active?</label>
                    <input type="checkbox" name="isActive" id="isActive" 
                    class="bg-gray-100 border-2 p-4 rounded-lg @error('isActive') border-red-500 @enderror" 
                        @if ($data['isActive'] )
                            checked
                        @endif
                    >

                    @error('isActive')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>



                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Update</button>
            </form>

        </div>
    </div>
@endsection