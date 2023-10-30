Hey {{$user->name}},
<br />
Someone have reviewed your talk proposal "{{$talkProposal->title}}",
go <a href="{{app('url')->to('/speakers/dashboard')}}">check it out</a>.