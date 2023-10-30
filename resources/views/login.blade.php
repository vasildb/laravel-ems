@include('header')

<form class="flex flex-col w-1/3 mx-auto gap-2" method="post" action="/login">
    <input type="text" placeholder="Email" class="py-2 px-4 border" name="email">
    <input type="password" placeholder="Password" class="py-2 px-4 border" name="password">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    @if($errors->any())
    <div class="text-red-400">
        {{ implode(' ', $errors->all()) }}
    </div>
    @endif

    <button class="text-white bg-sky-500 py-2" type="submit">Login</button>
</form>

@include('footer')