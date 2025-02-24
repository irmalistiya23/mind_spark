@extends('master')
@section('konten')
<div class="container-fluid">
    <div class="row">
        <!-- Main content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Manage Books</h3>
                    <a href="{{ route('manage.books.create') }}" class="btn btn-primary float-end">Add New Book</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>{{ $book->NamaBuku }}</td>
                                <td>{{ $book->penulis }}</td>
                                <td>{{ $book->penerbit }}</td>
                                <td>
                                    <a href="{{ route('manage.books.edit', $book->id) }}" 
                                       class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('manage.books.destroy', $book->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection