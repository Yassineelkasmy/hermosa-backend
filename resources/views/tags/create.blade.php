@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('tags.store') }}" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col-6">
        <label for="">Name_fr</label>
        <input class="form-control" type="text" name="name_fr">
    </div>
    <div class="col-6">
        <label for="">Name_ar</label>
        <input class="form-control" required type="text" name="name_ar">
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
