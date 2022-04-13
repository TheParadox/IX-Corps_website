@extends('layouts.app')

@section('title', 'IX-Corps')

@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12 bg-white p-6 rounded-lg">
            

            <img class="card-img-top h-64 w-96" src="{{ asset("/images/colors/{$data->regimentalColors}") }}" alt="Regimental Colors">
            <ul>
                <li>
                    Name: {{$data->name}}
                </li>
                <li>
                    Abreviation: {{$data->abrv}}
                </li>
                <li>
                    Type: {{$data->type}}
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
                    XO: 
                @if ($data->xo_name)
                    <a href="{{ route('member', ['memberID' => $data->xo_id]) }}" class="text-blue-700">{{ $data->xo_name }}</a>
                @else
                    Vacant
                @endif
                    
                </li>
                <li>
                    SgtMaj: 
                    @if ($data->sgtmaj_name)
                        <a href="{{ route('member', ['memberID' => $data->sgtMaj_id]) }}" class="text-blue-700">{{ $data->sgtmaj_name }}</a>
                    @else
                        Vacant
                    @endif
                </li>
                <li>
                    Strength: {{ $strength }} {{ $data->descriptor }}
                </li>

                @if ($advisors)
                    <li>
                        Advisors:
                    </li>
                    <ul class="ml-5">
                        @if ($advisors)
                            @foreach ($advisors as $adv)   
                                <li>
                                    <a href="{{ route('member', ['memberID' => $adv['id'] ]) }}" class="text-blue-700">{{ $adv['name'] }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                @endif

                @if ($companies)
                    <li>
                        Companies:
                    </li>
                    <ul class="ml-5">
                        @if ($companies)
                            @foreach ($companies as $comp)   
                                <li>
                                    @if ($comp['active'] == 0)
                                        Disbanded: 
                                    @endif
                                    <a href="{{ route('company', ['companyID' => $comp['id'] ]) }}" class="text-blue-700">{{ $comp['name'] }} Company</a>, with {{ $comp['troops'] }} {{ $data->descriptor }}
                                </li>
                            @endforeach
                        @endif
                    </ul>
                @endif

            </ul>

            @if (auth()->user()->permissions > 3)

                @if (auth()->user()->regiment_id == $data['id'])
                    <div class="pt-4">
                        <a href="{{ route('editRegiment', ['regimentID' => $data['id'] ]) }}" class="text-blue-600">Edit</a>
                    </div>
                    <div class="pt-4">
                        <a href="{{ route('awardNominationsList', ['regimentID' => $data['id'], 'approved' => 0 ]) }}" class="text-blue-600">Pending Awards</a>
                    </div>
                    <div class="pt-4">
                        <a href="{{ route('awardNominationsList', ['regimentID' => $data['id'], 'approved' => 1 ]) }}" class="text-blue-600">Decided Awards</a>
                    </div>
                @endif
            @endif

        </div>
    </div>
@endsection