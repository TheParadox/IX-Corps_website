@extends('layouts.app')

@section('title', 'Accolades')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <ul>
                <li>
                    Grade: {{ $data['grade'] }}
                </li>
                <li>
                    Abbreviation: {{ $data['abrv'] }}
                </li>
                <li>
                    Icon: NOT YET AVAILABLE
                </li>

            </ul>
            @auth
                @if (auth()->user()->permissions > 2)
                    <div class="pt-4">
                        <a href="{{ route('editRank', ['rankID' => $data['id'] ]) }}" class="text-blue-600">Edit</a>
                    </div>
                @endif
            @endauth
        </div>
    </div>
@endsection