<ul class="register_login__errors-{{$input}}">
    @if($errors->has($input))
        @foreach($errors->get($input) as $message)
        <li>{{ $message }}</li>
        @endforeach
    @endif
</ul>