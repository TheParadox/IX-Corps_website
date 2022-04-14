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
                        Transfer From: <a href="{{ route('regiment', ['regimentID' => $req['currentRegimentID']]) }}" class="text-blue-700">{{ $req['currentRegimentName'] }}</a> - 
                                        <a href="{{ route('company', ['companyID' => $req['currentCompanyID']]) }}" class="text-blue-700">{{ $req['currentCompanyName'] }}</a>
                    </li>
                    <li>
                        Transfer To: <a href="{{ route('regiment', ['regimentID' => $req['nextRegimentID']]) }}" class="text-blue-700">{{ $req['nextRegimentName'] }}</a> - 
                                        <a href="{{ route('company', ['companyID' => $req['nextCompanyID']]) }}" class="text-blue-700">{{ $req['nextCompanyName'] }}</a>
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