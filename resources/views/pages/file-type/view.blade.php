@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Paper File Type</h4>
        <div class="row sameheight-container">
            @can('add_paper_file_type')
                <div class="col-md-4">
                    <form action="{{ route('add_file_type') }}" method="post">
                        @csrf
                        <label for="">File Type Name</label>
                        <input type="text" name="name" required="" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            @endcan
            @can('view_paper_file_type')
                <div class="col-md-8">
                    <table class="table table-strip">
                        <tr>
                            <th>File Type</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($file_types as $file_type)
                            <tr>
                                <td>{{ $file_type->name }}</td>
                                <td>
                                    @can('delete_paper_file_type')
                                        <a href="{{ route('file_type_delete', ['id' => $file_type->id]) }}"
                                            class="btn btn-danger">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endcan
        </div>
    </section>
@endsection
