@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Submission Requirements</h4>
        <div class="row sameheight-container">
            @can('add_paper_submission_requirement')
                <div class="col-md-4">
                    <form action="{{ route('create_submissioin_requirement') }}" method="post">
                        @csrf
                        <label for="">Text</label>
                        <input type="text" name="text" required="" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            @endcan
            @can('view_paper_submission_requirement')
                <div class="col-md-8">
                    <table class="table table-strip">
                        <tr>
                            <th>Text</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($submission_requirements as $submission_requirement)
                            <tr>
                                <td>{{ $submission_requirement->text }}</td>
                                <td>
                                    @can('delete_paper_submission_requirement')
                                        <a href="{{ route('delete_submissioin_requirement', ['id' => $submission_requirement->id]) }}"
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
