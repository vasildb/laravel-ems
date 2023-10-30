@include('header')

<form class="flex flex-col w-1/3 mx-auto gap-2" method="post" enctype="multipart/form-data">

    @if(!empty($success))
    <div class="bg-green-200">
        {{$success}} <a href="/speaker/dashboard">Go back to dashboard</a>
    </div>
    @endif

    <input type="text" placeholder="Title" class="py-2 px-4 border" name="title" />
    <input type="file" name="file" />

    <div class="flex flex-row">
        @foreach($tags as $t)
        <input type="checkbox" value="{{$t->id}}" id="tag_{{$t->id}}" name="tags[]" /><label for="tag_{{$t->id}}" class="mr-4">{{$t->title}}</label>
        @endforeach
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    @if($errors->any())
    <div class="text-red-400">
        {{ implode(' ', $errors->all()) }}
    </div>
    @endif

    <button class="text-white bg-sky-500 py-2" type="submit">Add</button>
</form>

@include('footer')