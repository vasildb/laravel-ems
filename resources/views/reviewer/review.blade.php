@include('header')
<div>
    <h1 class="ml-12 text-xl">Review talk proposal: {{$talkProposal->title}}</h1>
    <form class="flex flex-col w-fit m-12" method="post">
        @if(!empty($success))
        <div class="bg-green-200">
            {{$success}} <a href="/reviewer/dashboard">Go back to dashboard</a>
        </div>
        @endif

        <label class="mt-12">Your comment</label>
        <textarea class="border" name="comment"></textarea>
        <label class="mt-12">Rating</label>
        <div class="flex flex-row">
            <input type="radio" value="1" name="rating" />
            <input type="radio" value="2" name="rating" />
            <input type="radio" value="3" name="rating" />
            <input type="radio" value="4" name="rating" />
            <input type="radio" value="5" name="rating" />
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        @if($errors->any())
        <div class="text-red-400">
            {{ implode(' ', $errors->all()) }}
        </div>
        @endif

        <button class="text-white bg-sky-500 py-2 mt-8" type="submit">Add</button>
    </form>

    <hr />
    <div class="flex flex-col">
        <h2 class="text-lg">{{$talkProposal->reviews()->count()}} Previous reviews</h2>
        <table class="table-auto text-center">
            <thead>
                <tr>
                    <th>Comment</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($talkProposal->reviews as $r)
                <tr>
                    <td>{{$r->comments}}</td>
                    <td>{{$r->rating}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('footer')