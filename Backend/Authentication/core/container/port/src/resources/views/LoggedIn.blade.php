<h1>HI {{$user->name}} {{$user->lastName}}</h1>
<h1>ip Address {{ $ip }}</h1>
<h1> Somebody just logged in on our platform via @if($client != null){{$client['type']}} {{$client['name']}}@else Unknown @endIf</h1>

<h1>@if($os != null) {{ $os['name'] }} {{ $os['version'] }} {{ $os['platform'] }}@endIf</h1>
@if($ipInfo != null)
<h1>{{ $ipInfo['iso_code'] }}</h1>
<h1>{{ $ipInfo['city'] }}<h1>
<h1>{{ $ipInfo['city'] }}<h1>
@endif