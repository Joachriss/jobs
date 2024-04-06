<x-mail::message>
# Introduction
Congratulations {{$username}}! <br>
You are now a premium user.
<p>The following are your membership details:</p>
<p>Plan : {{$plan}}</p>
<p>Plan ends on : {{$billingEnds}}</p>

<x-mail::button :url="''">
Post a job!
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
