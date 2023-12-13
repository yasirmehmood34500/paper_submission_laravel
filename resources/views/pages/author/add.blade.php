@extends('layouts.main')
@section('content')
    <section class="section">
        <h4>Add Author</h4>
        <form action="{{ route('add_author_req') }}" method="post">
            @csrf
        <div class="row sameheight-container">
                <label for="">Name</label>
                <input type="text" name="name" min="3" required="" class="form-control">
                <label for="">Email</label>
                <input type="email" name="email" required="" class="form-control">
                <label for="">Password</label>
                <input type="password" name="password" min="8" required="" class="form-control">
                <input type="hidden" name="user_level" value="{{ App\Models\User::AUTHOR }}">
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>
@endsection
