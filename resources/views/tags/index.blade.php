@extends('layouts.app')

@section('content')

@foreach ($tags as $tag )
    <div class="row">
    <div class="col-4">
        <h2>
        {{ ucfirst($tag->name_fr) }} | {{ $tag->name_ar }}
    </h2>
    </div>
</div>
<hr>


@endforeach

@endsection
