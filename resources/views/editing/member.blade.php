@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">     
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <form action="{{ route('editMember', ['memberID' => $data->id]) }}" method="POST">
                @csrf

                <!-- need to add permissions and password fields - to be edited by those with specific permissions... need to make the permissions -->


                <div class="mb-4">
                    <label for="name" class="">Display name:</label>
                    <input type="text" name="name" id="name" placeholder="What you are refered to, as"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ $data['name'] }}">

                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="discordName" class="">Discord Username:</label>
                    <input type="text" name="discordName" id="discordName" placeholder="Username#number"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('discordName') border-red-500 @enderror" value="{{ $data['discordName'] }}">

                    @error('discordName')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="companyToolName" class="">Company Tool Name:</label>
                    <input type="text" name="companyToolName" id="companyToolName" placeholder="Tool Name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('companyToolName') border-red-500 @enderror" value="{{ $data['companyToolName'] }}">

                    @error('companyToolName')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if (auth()->user()->permissions > 3)
                    <div class="mb-4">
                        <label for="joinDate" class="">Date Joined:</label>
                        <input type="date" name="joinDate" id="joinDate" placeholder="Date Joined"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ $data['dateJoined'] }}">
                    </div>

                    

                    <div class="mb-4">
                        <label for="recruiter" class="">Recruiter:</label>
                        <input type="text" name="recruiter" id="recruiter" placeholder="Recruiters Display Name"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('recruiter') border-red-500 @enderror" value="{{ $rec }}">

                        @error('recruiter')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="processor" class="">Processor:</label>
                        <input type="text" name="processor" id="processor" placeholder="Processors Display Name"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('processor') border-red-500 @enderror" value="{{ $proc }}">

                        @error('processor')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                @endif

                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Update</button>
            </form>

        </div>
    </div>
@endsection