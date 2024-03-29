@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <ul>
                <li>
                    Name: {{$data->name}}
                </li>
                @if (auth()->user()->id == $data->id)
                <li>
                    Email: {{$data->email}}
                </li>
                @endif

                Permissions: {{ $perm->name }}

                @if ((auth()->user()->id == $data->id) || (auth()->user()->permissions > 1))
                    <li>
                        Discord Name: {{$data->discordName}}
                    </li>
                    <li>
                        Company Tool Name: {{$data->companyToolName}}
                    </li>
                @endif
                
                <li>
                    Date Joined: {{date("d M Y", strtotime($data->dateJoined))}} ({{$data->tis}})
                </li>

                <li>
                    Member status: {{$data->status}}
                </li>

                @if ($data->isDischarged)
                <li>
                    Date Discharged: {{date("d M Y", strtotime($data->dateDischarged))}}
                </li>
                <li>
                    Reason For Discharge: {{$data->reasonForDischarge}}
                </li>
                @endif

                @if ($data->isLOA)
                <li>
                    LOA range: {{date("d M Y", strtotime($data->startLOA))}} - {{date("d M Y", strtotime($data->endLOA))}}
                </li>
                <li>
                    Reason For LOA: {{$data->reasonForLOA}}
                </li>
                <li>
                    LOA Processor: {{$data->loaGranter}}
                </li>
                @endif

                @if ($data->regiment_id > 0)
                    <li>
                        Regiment: <a href="{{ route('regiment', ['regimentID' => $data->regiment_id]) }}" class="text-blue-700">{{ $data->regiment_name }}</a> 
                    </li>
                @else
                    <li>
                        Regiment: {{ $data->regiment_name }}
                    </li>
                @endif
                @if ($data->company_id > 0)
                    <li>
                        Company: <a href="{{ route('company', ['companyID' => $data->company_id]) }}" class="text-blue-700">{{ $data->company_name }}</a>
                    </li>
                @else
                    <li>
                        Company: {{ $data->company_name }}
                    </li>
                @endif
            
                <li>
                    Rank: {{$data->rank}}
                </li>
                <li>
                    Awards: 
                    <ul class="ml-5">
                        @foreach ($awards as $a)
                            <li>
                                <a href="{{ route('specificAward', ['awardID' => $a['id']]) }}" class="text-blue-700">{{ $a['name'] }}</a>
                                - Awarded: 
                                <a href="{{ route('specificAwardNomination', ['nominationID' => $a['nomination']]) }}" class="text-blue-700">{{ $a['awarded'] }}</a>
                            </li>
                        @endforeach
                    </ul>

                </li>
                <li>
                    Number Drills: {{$data->numberDrillsAttended}}
                </li>
                <li>
                    Last Drill: {{$data->lastDrill}}
                </li>
                <li>
                    Number Of Events: {{$data->numberOfEventsAttended}}
                </li>
                <li>
                    Last Event: {{$data->lastEvent}}
                </li>

            </ul>
            @if (($perm->level > 2) || ($data->id == auth()->user()->id))
                <div class="pt-4">
                    <a href="{{ route('editMember', ['memberID' => $data->id]) }}" class="text-blue-600">Edit</a>
                </div>
            @endif

        </div>
    </div>
@endsection