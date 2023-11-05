@extends('layouts.main')
@section('css')
    <style>
        .line {
            background: #80808040;
            padding: 10px;
            border-radius: 5px;
            margin-top: 5px;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <h4>Submission Metadata</h4>
        <form action="{{ route('submission_step_2_req') }}" method="post">
            @csrf
            <input type="hidden" name="paper_no" value="{{ @$submission_paper?->paper_no ?: 'none' }}">
            <div class="sameheight-container">
                <label for="">Prefix</label>
                <input type="text" name="prefix" required="" value="{{ @$submission_paper?->prefix }}" class="form-control" min="3">
                <label for="">Title</label>
                <input type="text" name="title" required="" value="{{ @$submission_paper?->title }}" class="form-control" min="10">
                <label for="">Sub Title</label>
                <input type="text" name="sub_title" required="" value="{{ @$submission_paper?->sub_title }}" class="form-control" min="5">
                <label for="">Abstract</label>
                <textarea name="abstract" id="" cols="3" rows="3" required="" class="form-control">{{ @$submission_paper?->abstract }}</textarea>
                <label for="">Keywords</label>
                <input type="text" name="keywords" required="" value="{{ @$submission_paper?->keywords }}" class="form-control" min="3">
            <br>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-info pull-right">Next</button>
                </div>
            </div>
        </form>
    </section>
@endsection
