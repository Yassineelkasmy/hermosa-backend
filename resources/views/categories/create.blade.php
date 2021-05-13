@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col-6">
        <label for="">NameFr</label>
        <input class="form-control" type="text" name="nameFr">
    </div>
    <div class="col-6">
        <label for="">NameAr</label>
        <input class="form-control" required type="text" name="nameAr">
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
