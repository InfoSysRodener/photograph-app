<x-mail::message>
    # Welcome {{$user->email}}, 
   <p>
      Your Album are Ready!
   </p>
   <p>
      {{-- <a href="http://localhost:5173/photographer/album/{{$user->album_id}}/user/{{$user->id}}/{{$hash}}">View your album </a> --}}
      <a href="http://photo-demo-app.s3-website-ap-southeast-1.amazonaws.com/photographer/album/{{$user->album_id}}/user/{{$user->id}}/{{$hash}}">View your album </a>
      
   </p>


{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

{{-- Thanks,<br> --}}
{{-- {{ config('app.name') }} --}}
</x-mail::message>
