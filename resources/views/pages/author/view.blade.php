@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Authors</h4>
        <div class="row sameheight-container">
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Assign Permission</th>
                </tr>
                @foreach ($author_users as $author_user)
                    <tr>
                        <td>{{ $author_user->name }}</td>
                        <td>{{ $author_user->email }}</td>
                        <th>
                            @can('assign_user_permission')
                                <a href="{{ route('view_user_permission_page', ['user_id' => $author_user->id]) }}"
                                    class="btn btn-primary">Assign Permission</a>
                            @endcan
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
