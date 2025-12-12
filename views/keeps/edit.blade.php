@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Edit Keep</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('keeps.update', $keep->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name *</label>
            <input type="text" name="name" class="form-control" value="{{ $keep->name }}" required>
        </div>

        <div class="mb-3">
            <label>Description *</label>
            <textarea name="description" class="form-control" required>{{ $keep->description }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('keeps.index') }}" class="btn btn-secondary">Back</a>

    </form>

</div>
@endsection
