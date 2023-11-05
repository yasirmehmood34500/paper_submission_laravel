@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Paper File Type</h4>
        <div class="row sameheight-container">
            <div class="col-md-4">
                <form action="{{ route('add_file_type') }}" method="post">
                    @csrf
                    <label for="">File Type Name</label>
                    <input type="text" name="name" required="" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="col-md-8">
                <table class="table table-strip">
                    <tr>
                        <th>File Type</th>
                    </tr>
                    @foreach ($file_types as $file_type)
                        <tr>
                            <td>{{ $file_type->name }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection
