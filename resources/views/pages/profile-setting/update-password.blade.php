@extends('layouts.main')
@section('content')
    <section class="section">
        <h3>Change Password</h3>
        <div class="row sameheight-container">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form action="{{ route('update_password_req') }}" method="POST">
                    @csrf
                    <label for="">New Password</label>
                    <input type="password" name="new_password" required="" minlength="8" class="form-control">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confirm_password" required="" minlength="8" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-info">Change Password</button>
                </form>
            </div>
        </div>
    </section>
@endsection
