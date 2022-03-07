@extends('layouts.app')

@section('title', 'Accolades')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12  p-6 rounded-lg">
    
        <div class=" bg-blue-100 pb-6 mb-4 rounded-lg">
            <ul>
                <li>
                    Nominee: <a href="{{ route('member', ['memberID' => $data['nominee']]) }}" class="text-blue-700">{{ $extra['nomineeName'] }}</a>
                </li>
                <li>
                    Award: <a href="{{ route('specificAward', ['awardID' => $data['award']]) }}" class="text-blue-700">{{ $extra['awardName'] }}</a>
                </li>
                <li>
                    Nominator: <a href="{{ route('member', ['memberID' => $data['nominator']]) }}" class="text-blue-700">{{ $extra['nominatorName'] }}</a>
                </li>
                <li>
                    Reason: {{ $data['reason'] }}
                </li>
                <li>
                    Status: 
                    @if ($data['approved'] == 0)
                        Not Yet Reviewed
                    @elseif($data['approved'] == 1)
                        Approve, by <a href="{{ route('member', ['memberID' => $data['approvedBy']]) }}" class="text-blue-700">{{ $extra['approvedBy'] }}</a>
                    @elseif($data['approved'] == 2)
                        Denied, by <a href="{{ route('member', ['memberID' => $data['approvedBy']]) }}" class="text-blue-700">{{ $extra['approvedBy'] }}</a>
                    @else 
                        Unknown Approval Code!
                    @endif
                </li>
                @if ($data['approvedReason'] !== null)       
                    <li>
                        Notes: {{ $data['approvedReason'] }}
                    </li>
                @endif


            </ul>
        </div>

        </div>
    </div>
@endsection