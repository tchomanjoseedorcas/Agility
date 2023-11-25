<div>
    @foreach($administrators as $administrator)
        {{ $administrator->id }}
        {{ $administrator->user->lastname }}
    @endforeach
</div>
