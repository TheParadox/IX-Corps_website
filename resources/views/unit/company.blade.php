@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <ul>
                <li>
                    Name: {{$data->letter}} Company
                </li>
                <li>
                    Regiment: <a href="{{ route('regiment', ['regimentID' => $regiment->id]) }}" class="text-blue-700">{{ $regiment->name }}</a>
                </li>
                <li>
                    Status: 
                    @if ($data->isActive)
                        Combat Ready
                    @else
                        Disbanded
                    @endif
                </li>
                <li>
                    CO: 
                    @if ($data->co_name)
                        <a href="{{ route('member', ['memberID' => $data->co_id]) }}" class="text-blue-700">{{ $data->co_name }}</a>
                    @else
                        Vacant
                    @endif
                </li>
                <li>
                    1stSgt: 
                    @if ($data->firstSgt_name)
                        <a href="{{ route('member', ['memberID' => $data->firstSgt_id]) }}" class="text-blue-700">{{ $data->firstSgt_name }}</a>
                    @else
                        Vacant
                    @endif
                </li>
                <li>
            
                @if ($sgts)
                    <li>
                        Sgts:
                    </li>
                    <ul class="ml-5">
                        @foreach ($sgts as $sgt)   
                            <li>
                                <a href="{{ route('member', ['memberID' => $sgt['id'] ]) }}" class="text-blue-700">{{ $sgt['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif


                @if ($cpls)
                    <li>
                        Cpls:
                    </li>
                    <ul class="ml-5">
                        @foreach ($cpls as $cpl)   
                            <li>
                                <a href="{{ route('member', ['memberID' => $cpl['id'] ]) }}" class="text-blue-700">{{ $cpl['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif


                @if ($troops)
                    <li>
                        Troops:
                    </li>
                    <ul class="ml-5">
                        @foreach ($troops as $troop)   
                            <li>
                                <a href="{{ route('member', ['memberID' => $troop['id'] ]) }}" class="text-blue-700">{{ $troop['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </ul>

            @auth
                @if (auth()->user()->permissions > 3)
                    @if (auth()->user()->regiment_id == $data['id'])
                        <div class="pt-4">
                            <a href="{{ route('editCompany', ['companyID' => $data['id'] ]) }}" class="text-blue-600">Edit</a>
                        </div>
                        <div class="pt-4">
                            <a href="{{ route('transfersList', ['companyID' => $data['id'], 'approved' => 0 ]) }}" class="text-blue-600">Pending Transfer Requests</a>
                        </div>
                        <div class="pt-4">
                            <a href="{{ route('transfersList', ['companyID' => $data['id'], 'approved' => 1 ]) }}" class="text-blue-600">Decided Transfer Requests</a>
                        </div>
                    @endif
                @endif
            @endauth
        </div>
    </div>
@endsection