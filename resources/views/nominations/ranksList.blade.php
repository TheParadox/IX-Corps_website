@extends('layouts.app')

@section('title', 'Promotions')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12  p-6 rounded-lg">
        
        @foreach ($data as $rank)
            <div class=" bg-blue-100 pb-6 mb-4 rounded-lg">
                <ul>
                    <li>
                        Nominee: <a href="{{ route('member', ['memberID' => $rank['userID']]) }}" class="text-blue-700">{{ $rank['username'] }}</a>
                    </li>
                    <li>
                        Rank: <a href="{{ route('specificRank', ['rankID' => $rank['rankID']]) }}" class="text-blue-700">{{ $rank['rankName'] }}</a>
                    </li>
                    <li>
                        Nominator: <a href="{{ route('member', ['memberID' => $rank['nominatorID']]) }}" class="text-blue-700">{{ $rank['nominatorName'] }}</a>
                    </li>

                    <li>
                        <a href="{{ route('specificRanksNomination', ['nominationID' => $rank['nominationID']]) }}" class="text-blue-700">View Full Nomination</a>
                    </li>
                </ul>
            </div>
        @endforeach

        </div>
    </div>
@endsection