@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Reviewers</h4>
        <div class="row sameheight-container">
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Assign Permission</th>
                </tr>
                @foreach ($reviewer_users as $reviewer_user)
                    <tr>
                        <td>{{ $reviewer_user->name }}</td>
                        <td>{{ $reviewer_user->email }}</td>
                        <th>
                            @if ($author_user->id != auth()->id())
                                @can('assign_user_permission')
                                    <a href="{{ route('view_user_permission_page', ['user_id' => $reviewer_user->id]) }}"
                                        class="btn btn-primary">Assign Permission</a>
                                @endcan
                            @endif
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
