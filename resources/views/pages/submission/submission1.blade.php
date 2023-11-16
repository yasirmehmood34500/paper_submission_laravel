@extends('layouts.main')
@section('css')
    <style>
        .line {
            background: #8080801c;
            padding: 10px;
            border-radius: 5px;
            margin-top: 5px;
            border: 1px solid #808080a3;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <h4>Submission Requirements</h4>
        <form action="{{ route('submission_step_1_req') }}" method="post">
            @csrf
            <div class="sameheight-container">
                @foreach ($submission_requirements as $submission_requirement)
                    <div class="row line">
                        <div class="col-md-1">
                            <input type="checkbox" @required(true)>
                        </div>
                        <div class="col-md-11">
                            {{ $submission_requirement->text }}
                        </div>
                    </div>
                @endforeach
            </div>
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
