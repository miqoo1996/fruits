@foreach($fruits as $fruit)
    <p>#{{ $fruit->id }} - {{ $fruit->name }}</p>
@endforeach
