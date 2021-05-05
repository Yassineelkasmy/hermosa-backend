@extends('layouts.app')

@section('content')

@foreach ($categories as $category )
    <div class="row">
    <div class="col-4">
        <h2>
        {{ ucfirst($category->name_fr) }} | {{ $category->name_ar }}
    </h2>
    </div>
</div>
<hr>


@endforeach

@endsection
