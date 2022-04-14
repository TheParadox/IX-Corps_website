@extends('layouts.app')

@section('title', 'Accolades')
    
@section('content')
    <div class="flex justify-center">    
        <div class="w-8/12  p-6 rounded-lg">
    
            <div class=" bg-blue-100 pb-6 mb-4 rounded-lg">
                <ul>
                    <li>
                        Transferee: <a href="{{ route('member', ['memberID' => $data['transferee']]) }}" class="text-blue-700">{{ $extra['nomineeName'] }}</a>
                    </li>
                    <li>
                        Requestor: <a href="{{ route('member', ['memberID' => $data['requester']]) }}" class="text-blue-700">{{ $extra['nominatorName'] }}</a>
                    </li>
                    <li>
                        Reason for transfer: {{ $data['reason'] }}
                    </li>
                    <br>
                    <li>
                        Moving from:
                    </li>
                    <li>
                        Regiment: <a href="{{ route('regiment', ['regimentID' => $data['currentRegiment']]) }}" class="text-blue-700">{{ $extra['currentRegiment'] }}</a> 
                    </li>
                    <li>
                        Company: <a href="{{ route('company', ['companyID' => $data['currentCompany']]) }}" class="text-blue-700">{{ $extra['currentCompany'] }}</a>
                    </li>
                    <br>
                    <li>
                        Status: 
                        @if ($data['currentApproval'] == 0)
                            Not Yet Reviewed
                        @elseif($data['currentApproval'] == 1)
                            Approve, by <a href="{{ route('member', ['memberID' => $data['currentCO']]) }}" class="text-blue-700">{{ $extra['currentSigner'] }}</a>
                        @elseif($data['currentApproval'] == 2)
                            Denied, by <a href="{{ route('member', ['memberID' => $data['currentCO']]) }}" class="text-blue-700">{{ $extra['currentSigner'] }}</a>
                        @else 
                            Unknown Approval Code!
                        @endif
                    </li>
                    <li>
                        Reason given by CO: {{ $data['currentReason'] }}
                    </li>

                    <br>
                    <br>

                    <li>
                        Moving To:
                    </li>
                    <li>
                        Regiment: <a href="{{ route('regiment', ['regimentID' => $data['nextRegiment']]) }}" class="text-blue-700">{{ $extra['nextRegiment'] }}</a> 
                    </li>
                    <li>
                        Company: <a href="{{ route('company', ['companyID' => $data['nextCompany']]) }}" class="text-blue-700">{{ $extra['nextCompany'] }}</a>
                    </li>
                    <br>
                    <li>
                        Status: 
                        @if ($data['nextApproval'] == 0)
                            Not Yet Reviewed
                        @elseif($data['nextApproval'] == 1)
                            Approve, by <a href="{{ route('member', ['memberID' => $data['nextCO']]) }}" class="text-blue-700">{{ $extra['nextSigner'] }}</a>
                        @elseif($data['nextApproval'] == 2)
                            Denied, by <a href="{{ route('member', ['memberID' => $data['nextCO']]) }}" class="text-blue-700">{{ $extra['nextSigner'] }}</a>
                        @else 
                            Unknown Approval Code!
                        @endif
                    </li>
                    <li>
                        Reason given by CO: {{ $data['nextReason'] }}
                    </li>


                </ul>

                @if (auth()->user()->permissions >= $data['requiredApprovalPermission'])
                    <form method="POST" action="{{ route('editTransferRequest', ['transferID' => $data['id']]) }}">
                        @csrf
        
                        <div class="mb-4">
                            <label for="approved" class="">Approve:</label>
                            <select type="select" name="approved" id="approved" placeholder="approved"
                            class="bg-gray-100 border-2 p-2 mt-4 rounded-lg " value="">
        
                            <option hidden disabled selected value> -- select an option -- </option>
                            <option value="1"
                                @if ($extra['approved'] == 1)
                                    selected
                                @endif
                            >Approved</option>

                            <option value="2"                                
                                @if ($extra['approved'] == 2)
                                    selected
                                @endif
                            >Denied</option>
        
                            </select>
                        </div>
        
        
                        <div class="mb-4">
                            <label for="approvedReason" class="">Reason:</label>
                            <textarea name="approvedReason" id="approvedReason" placeholder="(Optional) Feedback on why it was or wasn't accepted"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('approvedReason') border-red-500 @enderror" >@if ($extra['approvedReason'] !== null){{ $extra['approvedReason'] }}@else{{ old('approvedReason') }}@endif</textarea>
        
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