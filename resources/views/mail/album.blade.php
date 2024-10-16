<x-mail::message>
    # Welcome {{$user->name}}, Your Album are Ready!

    
 <p>
    <a href="http://localhost:5173/photographer/album/{{$user->album_id}}/user/{{$user->id}}/{{$hash}}">View your album </a>
 </p>


{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

{{-- Thanks,<br> --}}
{{-- {{ config('app.name') }} --}}
</x-mail::message>
