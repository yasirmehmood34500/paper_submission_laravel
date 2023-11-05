@extends('layouts.main')
@section('css')
    <style>
        .d_none {
            display: none;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-md-6">
                <h4>Upload Files</h4>
            </div>
            <div class="col-md-6">
                <button class="pull-right btn btn-success" id="upload_btn">Upload Files +</button>
            </div>
        </div>
        <div class="new_file_upload d_none">
            <form action="{{ route('upload_file') }}" method="post" enctype="multipart/form">
                @csrf
                <label for="">FIle Name</label>
                <input type="text" name="file_name" required="" class="form-control">
                <label for="">Select File Type</label>
                <select name="submission_file_type_id" id="" class="form-control">
                    @foreach ($paper_file_types as $paper_file_type)
                        <option value="{{ $paper_file_type->id }}">{{ $paper_file_type->name }}</option>
                    @endforeach
                </select>
                <br>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
        <div class="row sameheight-container">
            @if (count($paper_files) > 0)
                <table class="table table-striped">
                    <tr>
                        <th>File Type</th>
                        <th>Remove</th>
                    </tr>
                    @foreach ($paper_files as $paper_file)
                        <tr>
                            <td>{{ $paper_file->file_type->name }}</td>
                            <td><a href="{{ route('delete_file', ['id' => $paper_file->id]) }}"
                                    class="btn btn-danger">Remove</a></td>
                        </tr>
                    @endforeach
                </table>
                <form action="{{ route('submission_step_4_req') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Submit Paper</button>
                </form>
            @endif
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $("#upload_btn").click(function() {
                if ($('.new_file_upload').hasClass('d_none')) {
                    $('.new_file_upload').removeClass('d_none');
                } else {
                    $('.new_file_upload').addClass('d_none');
                }
            });
        });
    </script>
@endsection
