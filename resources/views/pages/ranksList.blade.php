@extends('layouts.app')

@section('title', 'Accolades')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12  p-6 rounded-lg">
        
        @foreach ($data as $rank)
            <div class=" bg-blue-100 pb-6 mb-4 rounded-lg">
                <ul>
                    <li>
                        Title: <a href="{{ route('specificRank', ['rankID' => $rank['id']]) }}" class="text-blue-700">{{ $rank['grade'] }}</a>
                    </li>
                </ul>
            </div>
        @endforeach

        </div>
    </div>
@endsection