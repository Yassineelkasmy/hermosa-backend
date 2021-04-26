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
        <input class="form-control" type="text" name="desc_ar"  required value "{{ old('descr_ar') }}">
    </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-6">
        <label for="">Stock</label>
        <input class="form-control" type="number" min='0' name='stock' required value="{{ old('stock') }}">
    </div>
    <div class="col-6">

        <label for="">Price</label>

        <input class="form-control" type="number" required name="price" min="0" value="0" step="0.5" value="{{ old('price') }}">
    </div>
</div>
    </div>




    <label for="">Images</label>
    <div class="input-group control-group increment" >
        <input type="file" name="filename[]" class="form-control">
          <button class="btn btn-success" type="button"> + Add</button>

    </div>
      <div class="clone hide">
        <div class="control-group input-group" style="margin-top:10px">
          <input type="file" name="filename[]" class="form-control">

            <button class="btn btn-danger" type="button"> - Remove</button>

        </div>
      </div>
    <button class='btn btn-primary btn-block' style="margin-top: 10px" type="submit">Create</button>
</form>

<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){
          $(this).parents(".control-group").remove();
      });

    });

</script>

<style>
    .input-group button {
        width: 200px;
        margin-left:30px;
    }
</style>

@endsection
