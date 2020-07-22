<h1> {{$user->name}} {{$user->email}} </h1>
<a href="http://localhost:8080/reset?token={{ $token }}&email={{$user->email}}">link</a>
