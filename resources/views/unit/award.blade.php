@extends('layouts.app')

@section('title', 'Accolades')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <ul>
                <li>
                    Title: {{ $data['title'] }}
                </li>
                <li>
                    Awarded by: 
                    @if ($data['regID'] == 0)
                        Available to the whole Corps
                    @else
                        <a href="{{ route('regiment', ['regimentID' => $data['regID']]) }}" class="text-blue-700">{{ $data['regName'] }}</a>

                        @if ($data['compID'] == 0)
                            Regimental
                        @else
                            - <a href="{{ route('company', ['companyID' => $data['compID']]) }}" class="text-blue-700">{{ $data['compID'] }}</a>
                        @endif
                    @endif
                </li>
                <li>
                    Award Criteria: {{ $data['criteria'] }}
                </li>

            </ul>

        </div>
    </div>
@endsection