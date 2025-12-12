@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Keeps List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex mb-3">
        <a href="{{ route('keeps.create') }}" class="btn btn-primary me-2">Create New</a>

        <a href="{{ route('keeps.export') }}" class="btn btn-success me-2">Export Excel</a>

        <form action="{{ route('keeps.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required>
            <button type="submit" class="btn btn-info">Import</button>
        </form>

        <a href="{{ route('keeps.trash') }}" class="btn btn-warning ms-2">Trash</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keeps as $keep)
            <tr>
                <td>{{ $keep->id }}</td>
                <td>{{ $keep->name }}</td>
                <td>{{ $keep->description }}</td>
                <td>
                    <a href="{{ route('keeps.edit', $keep->id) }}" class="btn btn-sm btn-primary">Edit</a>

                    <form action="{{ route('keeps.destroy', $keep->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Move to trash?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $keeps->links() }}

</div>
@endsection
