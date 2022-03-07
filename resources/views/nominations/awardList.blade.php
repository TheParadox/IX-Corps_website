@extends('layouts.app')

@section('title', 'Accolades')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12  p-6 rounded-lg">
        
        @foreach ($data as $award)
            <div class=" bg-blue-100 pb-6 mb-4 rounded-lg">
                <ul>
                    <li>
                        Nominee: <a href="{{ route('member', ['memberID' => $award['userID']]) }}" class="text-blue-700">{{ $award['username'] }}</a>
                    </li>
                    <li>
                        Award: <a href="{{ route('specificAward', ['awardID' => $award['awardID']]) }}" class="text-blue-700">{{ $award['awardName'] }}</a>
                    </li>
                    <li>
                        Nominator: <a href="{{ route('member', ['memberID' => $award['nominatorID']]) }}" class="text-blue-700">{{ $award['nominatorName'] }}</a>
                    </li>

                    <li>
                        <a href="{{ route('specificAwardNomination', ['nominationID' => $award['nominationID']]) }}" class="text-blue-700">View Full Nomination</a>
                    </li>
                </ul>
            </div>
        @endforeach

        </div>
    </div>
@endsection