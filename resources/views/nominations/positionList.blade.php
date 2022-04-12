@extends('layouts.app')

@section('title', 'Accolades')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12  p-6 rounded-lg">

        @foreach ($data as $nomination)
            <div class=" bg-blue-100 pb-6 mb-4 rounded-lg">
                <ul>
                    <li>
                        Nominee: <a href="{{ route('member', ['memberID' => $nomination['userID']]) }}" class="text-blue-700">{{ $nomination['username'] }}</a>
                    </li>
                    <li>
                        Position: {{ $nomination['position'] }} 
                    </li>
                    <li>
                        Nominator: <a href="{{ route('member', ['memberID' => $nomination['nominatorID']]) }}" class="text-blue-700">{{ $nomination['nominatorName'] }}</a>
                    </li>

                    <li>
                        <a href="{{ route('specificPositionNomination', ['nominationID' => $nomination['nominationID']]) }}" class="text-blue-700">View Full Nomination</a>
                    </li>
                </ul>
            </div>
        @endforeach

        </div>
    </div>
@endsection