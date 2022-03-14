<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-gray-100">
        <nav class="p-4 bg-white flex justify-between">
            <ul class="flex items-center">
                <li>
                    <a href="{{ route('home') }}" class="p-3">Home</a>
                </li>
                <li>
                    <a href="{{ route('oob') }}" class="p-3">Order of Battle</a>
                </li>
                <li>
                    <a href="{{ route('listAwards') }}" class="p-3">Accolades</a>
                </li>
                <li>
                    <a href="{{ route('listRanks') }}" class="p-3">Ranks</a>
                </li>
                <li>
                    <a href="{{ route('engage') }}" class="p-3">Engagements</a>
                </li>
                @auth
                    @if (auth()->user()->permissions > 0)
                        <li>
                            <a href="{{ route('newMember') }}" class="p-3">Processing</a>
                        </li>
                        <li>
                            <a href="{{ route('nominateAward') }}" class="p-3">Nominations</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="flex items-center">
                @auth
                    <li>
                        <a href="{{ route('regiment', ['regimentID' => auth()->user()->regiment_id]) }}" class="p-3 pr-2">{{ auth()->user()::getRegimentAbrv() }}</a>
                    </li>
                    <li>
                        <a href="{{ route('company', ['companyID' => auth()->user()->company_id]) }}" class="p-3 pl-2 pr-2">{{ auth()->user()::getCompanyAbrv() }}</a>
                    </li>
                    <li>
                        <a href="{{ route('member', ['memberID' => auth()->user()->id]) }}" class="p-3 pl-2">{{ auth()->user()::getRankAbrv() }} {{ auth()->user()->name }}</a>
                    </li>
                    <form action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <button type="submit" class="pt-4 pl-2 pr-2 inline">Logout</button>
                    </form>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login') }}" class="p-3">Login</a>
                    </li>
                @endguest

                
            </ul>
        </nav>

        <aside class="">
            @yield('content')
        </aside>

        <footer>
            
        </footer>
    </body>
</html>