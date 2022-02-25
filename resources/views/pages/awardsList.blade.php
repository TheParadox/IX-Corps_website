@extends('layouts.app')

@section('title', 'Accolades')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12  p-6 rounded-lg">
        
        @foreach ($data as $award)
            <div class=" bg-blue-100 pb-6 mb-4 rounded-lg">
                <ul>
                    <li>
                        Title: <a href="{{ route('specificAward', ['awardID' => $award['id']]) }}" class="text-blue-700">{{ $award['title'] }}</a>
                    </li>
                    <li>
                        Awarded by: 
                        @if ($award['regID'] == 0)
                            Available to the whole Corps
                        @else
                            <a href="{{ route('regiment', ['regimentID' => $award['regID']]) }}" class="text-blue-700">{{ $award['regName'] }}</a>

                            @if ($award['compID'] == 0)
                                Regimental
                            @else
                                - <a href="{{ route('company', ['companyID' => $award['compID']]) }}" class="text-blue-700">{{ $award['compName'] }}</a>
                            @endif
                        @endif
                    </li>

                </ul>
            </div>
        @endforeach

        </div>
    </div>
@endsection