@include('header')

<form method="get" class="flex flex-col gap-2 rounded border w-1/3 m-2">
    <input type="text" name="q" placeholder="Example: speaker:vasil tag:tech,health" class="p-2" value="{{$q}}" />
    <input type="submit" value="Search" class="bg-sky-500 text-sky-50 p-2 m-2 rounded" />
</form>
Talk proposals to review
<table class="table-auto w-1/3 text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Speaker</th>
            <th>Title</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($talkProposals as $tp)
        <tr>
            <td>{{$tp->id}}</td>
            <td>{{$tp->speaker->user->name}}</td>
            <td>{{$tp->title}}</td>
            <td>{{$tp->created_at->diffForHumans()}}</td>
            <td><a href="/review/{{$tp->id}}" class="text-sky-500">Review</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('footer')