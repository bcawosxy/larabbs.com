<li>
    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
    <a href="{{ route('user::show', $user->id )}}" class="username">{{ $user->name }}</a>
</li>