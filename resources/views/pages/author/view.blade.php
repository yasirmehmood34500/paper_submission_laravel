@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Authors</h4>
        <div class="row sameheight-container">
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                @foreach ($author_users as $author_user)
                    <tr>
                        <td>{{ $author_user->name }}</td>
                        <td>{{ $author_user->email }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
