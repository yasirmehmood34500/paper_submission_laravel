@extends('layouts.main')
@section('css')
    <style>
        .line {
            background: #80808040;
            padding: 10px;
            border-radius: 5px;
            margin-top: 5px;
        }

        .d_none {
            display: none;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-md-6">
                <h4>Author Contributor ({{ @$submission_paper?->paper_no }})</h4>
            </div>
            <div class="col-md-6">
                <button class="pull-right btn btn-success" id="add_contributor">Add Contributor +</button>
            </div>
        </div>
        <div class="new_contributor d_none">
            <form action="{{ route('add_contributor') }}" method="post">
                @csrf
                <label for="">Name</label>
                <input type="text" name="name" required="" class="form-control">
                <label for="">Email</label>
                <input type="email" name="email" required="" class="form-control">
                <label for="">ORIC ID</label>
                <input type="text" name="oric_id" class="form-control">
                <label for="">Affiliation</label>
                <input type="text" name="affiliation" class="form-control">
                <label for="">Bio Statement</label>
                <textarea name="bio_statement" id="" cols="3" rows="3" maxlength="450" class="form-control"></textarea>
                <label for="">Contributor's Rule</label>
                <select name="author_contributor_rule_id" class="form-control" id="">
                    @foreach ($contributor_rules as $contributor_rule)
                        <option value="{{ $contributor_rule->id }}">{{ $contributor_rule->name }}</option>
                    @endforeach
                </select>
                <br>
                <button type="submit" class="btn btn-success">Save Contributor</button>
            </form>
        </div>
        @if (count($paper_contributors) > 0)
            <form action="{{ route('submission_step_3_req') }}" method="post">
                @csrf
                <div class="sameheight-container">
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Rule</th>
                            <th>Remove</th>
                        </tr>
                        @foreach ($paper_contributors as $paper_contributor)
                            <tr>
                                <td>{{ $paper_contributor->name }}</td>
                                <td>{{ $paper_contributor->email }}</td>
                                <td>{{ $paper_contributor->contributor_rule->name }}</td>
                                <td><a href="{{ route('delete_contributor', ['id' => $paper_contributor->id]) }}"
                                        class="btn btn-danger">Remove</a></td>
                            </tr>
                        @endforeach
                    </table>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('submission_step_2_req') }}" class="btn btn-primary">Back</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info pull-right">Next</button>
                        </div>
                    </div>
            </form>
        @endif

    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $("#add_contributor").click(function() {
                if ($('.new_contributor').hasClass('d_none')) {
                    $('.new_contributor').removeClass('d_none');
                } else {
                    $('.new_contributor').addClass('d_none');
                }
            });
        });
    </script>
@endsection
