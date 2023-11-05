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
                <div class="row line">
                    <div class="col-md-1">
                        <input type="checkbox" @required(true)>
                    </div>
                    <div class="col-md-11">
                        The submission has not been previously published, nor is it before another journal for consideration
                        (or an explanation has been provided in Comments to the Editor).
                    </div>
                </div>
                <div class="row line">
                    <div class="col-md-1">
                        <input type="checkbox" @required(true)>
                    </div>
                    <div class="col-md-11">
                        The submission file is in OpenOffice, Microsoft Word, or RTF document file format.
                    </div>
                </div>
                <div class="row line">
                    <div class="col-md-1">
                        <input type="checkbox" @required(true)>
                    </div>
                    <div class="col-md-11">
                        Where available, URLs for the references have been provided.
                    </div>
                </div>
                <div class="row line">
                    <div class="col-md-1">
                        <input type="checkbox" @required(true)>
                    </div>
                    <div class="col-md-11">
                        The text is single-spaced; uses a 12-point font; employs italics, rather than underlining (except
                        with URL addresses); and all illustrations, figures, and tables are placed within the text at the
                        appropriate points, rather than at the end.
                    </div>
                </div>
                <div class="row line">
                    <div class="col-md-1">
                        <input type="checkbox" @required(true)>
                    </div>
                    <div class="col-md-11">
                        The text adheres to the stylistic and bibliographic requirements outlined in the Author Guidelines.
                    </div>
                </div>

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
