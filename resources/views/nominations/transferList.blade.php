@extends('layouts.app')

@section('title', 'Accolades')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12  p-6 rounded-lg">
        
        @foreach ($data as $req)
            <div class=" bg-blue-100 pb-6 mb-4 rounded-lg">
                <ul>
                    <li>
                        Transferee: <a href="{{ route('member', ['memberID' => $req['userID']]) }}" class="text-blue-700">{{ $req['username'] }}</a>
                    </li>
                    <li>
                        Transfer From: 
                    </li>
                    <li>
                        Transfer To: 
                    </li>
                    <li>
                        Requestor: <a href="{{ route('member', ['memberID' => $req['requesterID']]) }}" class="text-blue-700">{{ $req['requesterName'] }}</a>
                    </li>

                    <li>
                        <a href="{{ route('specificTransfer', ['transferID' => $req['requestID']]) }}" class="text-blue-700">View Full Nomination</a>
                    </li>
                </ul>
            </div>
        @endforeach

        </div>
    </div>
@endsection