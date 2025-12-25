@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Review Type</h4>
        <div class="row sameheight-container">
            @can('view_review_type')
                <div class="col-md-4">
                    <form action="{{ route('add_review_type') }}" method="post">
                        @csrf
                        <label for="">Type</label>
                        <input type="text" name="name" required="" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            @endcan
            @can('add_review_type')
                <div class="col-md-8">
                    <table class="table table-strip">
                        <tr>
                            <th>Type</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($review_types as $review_type)
                            <tr>
                                <td>{{ $review_type->name }}</td>
                                <td>
                                    @can('delete_review_type')
                                        <a href="{{ route('review_type_delete', ['id' => $review_type->id]) }}"
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
