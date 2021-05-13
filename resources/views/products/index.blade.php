@extends('layouts.app')

@section('content')

@foreach ($products as $product )

    <p>
        <a href="{{ route('products.show',['product'=>$product->id]) }}"><h2>{{ $product->title_fr }}</h2></a>
        <div class="row">
        <div class="col">
        <p>
            {{ $product->desc_fr }}
        </p>
        </div>
        <div class="col">
            <p>
                {{ $product->desc_ar }}
            </p>
        </div>
    </div>

    <div class="row">
        @foreach ($product->pictures as $picture)

        <div class="col-4 col-sm-12">
            <img class="rounded mx-2" src="{{$picture->thumbnail_url() }}" alt="">
        </div>

        @endforeach

    </div>


    <div class="row">
        @foreach ($product->colors as $color )
            <div class="col-3 col-sm-6">
                <div class="view" style="background-color: #<?php echo $color->value; ?>">

                    <span>{{ $color->name_fr."|".$color->name_ar }}
                                <strong>{{ $color->pivot->stock }}</strong></span>

                </div>
            </div>

        @endforeach
    </div>


    <div class="row">
        @foreach ($product->sizes as $size )
            <div class="col">
                <div class="btn btn-info my-1">
                    {{ $size->name." | ".$size->pivot->stock }}
            </div>
            </div>

        @endforeach
    </div>


    <div class="row">
        @foreach ($product->categories as $category )
            <div class="col">
                <div class="btn btn-warning my-1">
                    {{$category->name_fr." | ".$category->name_ar}}
                </div>

            </div>

        @endforeach
    </div>





    <div class="text-right">
        <a href="{{ route('products.edit',['product'=>$product->id]) }}" class="btn btn-primary my-3">Edit</a>
        <a href="" class="btn btn-danger my-3">Delete</a>
    </div>
    </p>

<hr>
@endforeach

<style>
    .view {
        height: 40px;
        width:  40px;
        margin: 10px;
        border-radius: 50%;
        position: relative;
    }

    span{
        position: absolute;
        left: 50px;
        width: auto;
    }

</style>

@endsection


