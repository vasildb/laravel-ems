@include('header')

Hi!
<br /><br />
Your talk proposals
<table class="table-auto w-1/3 text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach($talkProposals as $tp)
        <tr>
            <td>{{$tp->id}}</td>
            <td>{{$tp->title}}</td>
            <td>{{$tp->created_at->diffForHumans()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br /><br />
<a href="/speaker/add-talk-proposal" class="bg-sky-500 text-sky-50 p-2 m-2 rounded">Add talk proposal</a>
@include('footer')