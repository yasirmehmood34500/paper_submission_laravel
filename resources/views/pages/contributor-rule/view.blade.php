@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Contributor Rules</h4>
        <div class="row sameheight-container">
            <div class="col-md-4">
                <form action="{{ route('add_contributor_rule') }}" method="post">
                    @csrf
                    <label for="">Rule Name</label>
                    <input type="text" name="name" required="" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="col-md-8">
                <table class="table table-strip">
                    <tr>
                        <th>Rule</th>
                    </tr>
                    @foreach ($contributor_rules as $contributor_rule)
                        <tr>
                            <td>{{ $contributor_rule->name }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection
