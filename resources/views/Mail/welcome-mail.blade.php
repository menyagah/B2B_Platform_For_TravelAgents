<x-mail::message >
# Welcome {{ $name }}!!

Congratulations on joining the x-team. We are pleased to have you onboard!

Thanks.<br>
{{ config('app.name') }}
<x-mail::button :url="''">
    click Here for Onboarding
</x-mail::button>
</x-mail::message>







