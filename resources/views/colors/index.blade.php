@extends('layouts.app')

@section('content')

@foreach ($colors as $color )
    <div class="row">
    <div class="col-6">
        <h2>
        {{ $color->nameFr }} | {{ $color->nameAr }}
    </h2>
    </div>
    <div class="col-6">
        <div class="view" style="background-color: #<?php echo $color->value; ?>">

        </div>
    </div>
</div>
<hr>



@endforeach
<style>
    .view {
        height: 50px;
        width: 100%;
        margin: 10px;
    }
    h2{
        margin: 10px;
    }
</style>
@endsection
