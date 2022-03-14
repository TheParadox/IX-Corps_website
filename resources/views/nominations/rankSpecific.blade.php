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
                        Rank: <a href="{{ route('specificRank', ['rankID' => $data['rank']]) }}" class="text-blue-700">{{ $extra['rankName'] }}</a>
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

                @if (auth()->user()->permissions >= $data['requiredApprovalPermission'])
                    <form method="POST" action="{{ route('editAwardNomination', ['nominationID' => $data['id']]) }}">
                        @csrf
        
                        <div class="mb-4">
                            <label for="approved" class="">Approve:</label>
                            <select type="select" name="approved" id="approved" placeholder="approved"
                            class="bg-gray-100 border-2 p-2 mt-4 rounded-lg " value="">
        
                            <option hidden disabled selected value> -- select an option -- </option>
                            <option value="1">Approved</option>
                            <option value="2">Denied</option>
        
                            </select>
                        </div>
        
        
                        <div class="mb-4">
                            <label for="approvedReason" class="">Reason:</label>
                            <textarea name="approvedReason" id="approvedReason" placeholder="(Optional) Feedback on why it was or wasn't accepted"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('approvedReason') border-red-500 @enderror" value="{{ old('approvedReason') }}"></textarea>
        
                            @error('approvedReason')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
        
                        <div class="mb-4">
                            <input type="hidden" name="approvedBy" id="approvedBy" value="{{ auth()->user()->id }}">
                        </div>
        
        
        
                        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium ">Update</button>
                    </form>
                @endif
            </div>

        </div>
    </div>
@endsection