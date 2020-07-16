@extends('layouts.mmaster')
@section('content')
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Laravel Import Export
        </div>
        <div class="card-body">
            <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
                <a class="btn btn-warning" href="{{ route('admin.export') }}">Export User Data</a>
            </form>
        </div>
    </div>
</div>
@endsection