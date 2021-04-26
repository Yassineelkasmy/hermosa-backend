@extends('layouts.app')

@section('content')

@foreach ($products as $product )

    <p>
        <a href="{{ route('products.show',['product'=>$product->id]) }}"><h2>{{ $product->title }}</h2></a>
        <a href="{{ route('products.edit',['product'=>$product->id]) }}" class="btn btn-primary">Edit</a>
    </p>

@endforeach

@endsection
