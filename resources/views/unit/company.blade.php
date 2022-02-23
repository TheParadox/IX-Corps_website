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
                    Regiment: <a href="{{ route('regiment', ['reg' => $regiment->id]) }}" class="text-blue-700">{{ $regiment->name }}</a>
                </li>
                <li>
                    CO: 
                    @if ($data->co_name)
                        <a href="{{ route('member', ['member' => $data->co_id]) }}" class="text-blue-700">{{ $data->co_name }}</a>
                    @else
                        Vacant
                    @endif
                </li>
                <li>
                    1stSgt: 
                    @if ($data->firstSgt_name)
                        <a href="{{ route('member', ['member' => $data->firstSgt_id]) }}" class="text-blue-700">{{ $data->firstSgt_name }}</a>
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
                                <a href="{{ route('member', ['member' => $sgt['id'] ]) }}" class="text-blue-700">{{ $sgt['name'] }}</a>
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
                                <a href="{{ route('member', ['member' => $cpl['id'] ]) }}" class="text-blue-700">{{ $cpl['name'] }}</a>
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
                                <a href="{{ route('member', ['member' => $troop['id'] ]) }}" class="text-blue-700">{{ $troop['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </ul>
        </div>
    </div>
@endsection