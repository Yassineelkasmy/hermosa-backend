@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('colors.store') }}" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col-4">
        <label for="">NameFr</label>
        <input class="form-control" type="text" name="nameFr">
    </div>
    <div class="col-4">
        <label for="">NameAr</label>
        <input class="form-control" required type="text" name="nameAr">
    </div>

    <div class="col-4">
        <label for="">Color</label>
        <input class="form-control" required name="value" type="color">
    </div>
</div>

</div>
    <button class='btn btn-primary btn-block' style="margin-top: 10px" type="submit">Create</button>

</form>
<style>
    .input-group button {
        width: 200px;
        margin-left:30px;
    }


</style>

@endsection
