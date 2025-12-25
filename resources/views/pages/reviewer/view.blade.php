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
                    <th>Login As</th>
                </tr>
                @foreach ($reviewer_users as $reviewer_user)
                    <tr>
                        <td>{{ $reviewer_user->name }}</td>
                        <td>{{ $reviewer_user->email }}</td>
                        <td>
                            @if ($reviewer_user->id != auth()->id())
                                @can('assign_user_permission')
                                    <a href="{{ route('view_user_permission_page', ['user_id' => $reviewer_user->id]) }}"
                                        class="btn btn-primary">Assign Permission</a>
                                @endcan
                            @endif
                        </td>
                        <td>
                            @if ($reviewer_user->id != auth()->id())
                                @can('login_as_user')
                                    <a href="{{ route('login_as_user_link', ['user_id' => $reviewer_user->id]) }}"
                                        class="btn btn-info">Login As</a>
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
