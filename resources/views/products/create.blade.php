@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
    <div class="row">

        <div class="col-6">
            <label for="">Title_fr</label>
            <input class="form-control" type="text" name='title_fr' required value="{{ old('title_fr') }}">
        </div>

        <div class="col-6">
            <label for="">Title_ar</label>
            <input class="form-control" type="text" name='title_ar' required value="{{ old('title_ar') }}">
        </div>
    </div>
    </div>


    <div class="form-group">
        <div class="row">
        <div class="col-6">
        <label for="">Description_fr</label>
        <input class="form-control" type="text" name="desc_fr"  required value=" {{ old('desc_fr') }}">
    </div>
    <div class="col-6">
        <label for="">Description_ar</label>
        <input class="form-control" type="text" name="desc_ar"  required value= "{{ old('desc_ar') }}">
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
        <input class="form-control" type="number" value="0" name="stock[]" min="0" step="1" value="{{ old('price') }}">

        </div>
        <div class="col-3">
            <h4 style="margin-top: 30px">
                {{ $color->name_fr }} | {{ $color->name_ar }}
            </h4>
        </div>
        <div class="col-3">
        <div class="color" style="background-color: #<?php echo $color->value; ?>">

        </div>
    </div>
    </div>
    <hr>
    @endforeach
    <button class='btn btn-primary btn-block' style="margin-top: 10px" type="submit">Create</button>
    </div>
</form>


<style>
    .input-group button {
        width: 200px;
        margin-left:30px;
    }
    .color {
        height: 40px;
        width: 100%;
        margin-top: 25px;
    }
</style>

@endsection
