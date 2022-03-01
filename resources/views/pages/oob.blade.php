@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12  p-6 rounded-lg">

            @foreach ($oob as $reg)
                <div class=" bg-blue-100 pb-6 mb-4 rounded-lg">
                    <ul>
                        <li>
                            Name: <a href="{{ route('regiment', ['regimentID' => $reg['id']]) }}" class="text-blue-700">{{ $reg['name'] }}</a>
                        </li>
                        <li>
                            Type: {{ $reg['type'] }}
                        </li>
                        <li>
                            Strength: {{ $reg['strength'] }} {{ $reg['descriptor'] }}
                        </li>

                        @if ($reg['companies'])
                            <li>
                                Companies:
                            </li>
                            <ul class="ml-5">
                            @foreach ($reg['companies'] as $comp)   
                                <li>
                                    @if ($comp['active'] == 0)
                                        Disbanded: 
                                    @endif
                                    <a href="{{ route('company', ['companyID' => $comp['id'] ]) }}" class="text-blue-700">{{ $comp['name'] }} Company</a>, with {{ $comp['strength'] }} {{ $reg['descriptor'] }}
                                </li>
                            @endforeach
                            </ul>
                        @endif

                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection