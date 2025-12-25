@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Contributor Roles</h4>
        <div class="row sameheight-container">
            @can('add_contributor_rule')
                <div class="col-md-4">
                    <form action="{{ route('add_contributor_rule') }}" method="post">
                        @csrf
                        <label for="">Role Name</label>
                        <input type="text" name="name" required="" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            @endcan
            @can('view_contributor_rule')
                <div class="col-md-8">
                    <table class="table table-strip">
                        <tr>
                            <th>Role</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($contributor_rules as $contributor_rule)
                            <tr>
                                <td>{{ $contributor_rule->name }}</td>
                                <td>
                                    @can('delete_contributor_rule')
                                        <a href="{{ route('contributor_rule_delete', ['id' => $contributor_rule->id]) }}"
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
