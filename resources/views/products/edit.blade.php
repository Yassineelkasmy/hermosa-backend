@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('products.update',['product'=>$product->id]) }}" >

    @csrf
    @method('PUT')

   <div class="form-group">
        <label  for="">Title</label>
        <input class="form-control" type="text" name='title' required value="{{ old('title',$product->title) }}">
   </div>

   <div class="form-group">
        <label  for="">Description</label>

        <textarea class='form-control' name="description" id="" cols="30" rows="10" required  >{{ old('description',$product->description) }}</textarea>
   </div>

   <div class="form-group">
        <label  for="">Stock</label>
        <input class="form-control" type="number" min='0' name='stock' required value="{{ old('stock',$product->stock) }}">
   </div>

   <div class="form-group">
        <label  for="">Price</label>

        <input class="form-control" type="number" required name="price" min="0" value="0" step="0.5" value="{{ old('price',$product->price) }}">

   </div>


    <button type="submit" class="btn btn-primary btn-block">Update</button>
</form>

@endsection
