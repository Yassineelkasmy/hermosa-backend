@extends('layouts.app')

@section('content')


<h1>{{ $product->title }}</h1>
<p>
    {{ $product->created_at->diffForHumans() }}
</p>
<div class="row">
@foreach ($product->pictures as $picture )
    <div class="col-5">
        <img src="{{$picture->image_url() }}" alt="">
    </div>
@endforeach
@foreach ($product->pictures as $picture )
    <div class="col-3">
        <img src="{{$picture->thumbnail_url() }}" alt="">

    </div>
@endforeach



</div>


@endsection
