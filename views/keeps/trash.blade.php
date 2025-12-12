@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Trash (Soft Deleted Keeps)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('keeps.index') }}" class="btn btn-secondary mb-3">Back</a>

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
                    <a href="{{ route('keeps.restore', $keep->id) }}" class="btn btn-sm btn-success">Restore</a>

                    <form action="{{ route('keeps.forceDelete', $keep->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete permanently?')">Force Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $keeps->links() }}

</div>
@endsection

