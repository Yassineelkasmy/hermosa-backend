@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
    <div class="row">

        <div class="col-6">
            <label for="">TitleFr</label>
            <input class="form-control" type="text" name='titleFr' required value="{{ old('titleFr') }}">
        </div>

        <div class="col-6">
            <label for="">TitleAr</label>
            <input class="form-control" type="text" name='titleAr' required value="{{ old('titleAr') }}">
        </div>
    </div>
    </div>


    <div class="form-group">
        <div class="row">
        <div class="col-6">
        <label for="">DescriptionFr</label>
        <input class="form-control" type="text" name="descFr"  required value=" {{ old('descFr') }}">
    </div>
    <div class="col-6">
        <label for="">DescriptionAr</label>
        <input class="form-control" type="text" name="descAr"  required value= "{{ old('descAr') }}">
    </div>
    </div>

    <div class="form-group">
        <div class="row">
    <div class="col-6">

        <label for="">Price</label>

        <input class="form-control" type="number" required name="price" min="0" value="0" step="0.5" value="{{ old('price') }}">
    </div>
</div>
    </div>




    <h2>Images</h2>
    @foreach ($colors as $color )
    <div class="row">

        <div class="col-3">
            <input style="margin-top: 30px" type="file" name="filename[]">
        </div>
        <div class="col-3">
            <label for="">Stock</label>
        <input class="form-control" type="number" value="0" name="color_stock[]" min="0" step="1" >

        </div>
        <div class="col-3">
            <h4 style="margin-top: 30px">
                {{ $color->nameFr }} | {{ $color->nameAr }}
            </h4>
        </div>
        <div class="col-3">
        <div class="color" style="background-color: #<?php echo $color->value; ?>">

        </div>
    </div>
    </div>
    <hr>
    @endforeach
    <h2>Sizes</h2>
    <div class="row">
    @foreach ($sizes as $size)
        <div class="col-md-3 col-sm-6">
        <label for="">{{ strtoupper($size->name)  }}</label>
        <input class="form-control" type="number" value="0" name="size_stock[]" min="0" step="1" >
        </div>

    @endforeach
    </div>

    <hr>
    <h2>Categories</h2>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-3 col-sm-6">
            <label for="">{{ ucfirst($category->nameFr) }} | {{  $category->nameAr}}</label>
            <input type="checkbox" name="category[]">
        </div>
        @endforeach
    </div>


    <button class='btn btn-primary btn-block' style="margin-top: 10px" type="submit">Create</button>
    </div>
</form>



@endsection
