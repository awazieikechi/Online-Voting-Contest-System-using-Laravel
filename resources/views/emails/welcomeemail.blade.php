@component('mail::message')

# Hello {{ $user['name']}}

Welcome to the Contest.


<br>
## Username: {{ $user['email']}}
## Password: password chosen
<br>

Go vote on the platform<br><br>


To login to your account, <a href="{{url('/login')}}"> CLICK HERE. </a><br><br>

Thanks,<br>
Management
@endcomponent