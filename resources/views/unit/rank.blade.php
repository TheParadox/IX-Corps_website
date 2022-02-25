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

        </div>
    </div>
@endsection