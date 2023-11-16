@extends('layouts.main')
@section('css')
    <style>
        .box{
            border: 1px solid #80808091;
    border-radius: 5px;
    padding: 5px;
    margin: 1px;
        }
        .box1{
            background: #ff000029;
        }
        .box2{
            background: #0080001f;
        }
        .box3{
            background: #0b064d24;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <h4>Assign Permission to ({{ $user->name }}) [{{ App\Models\User::USER_TYPE[$user->user_level] }}]</h4>
        <form action="{{ route('add_user_permission_req') }}" method="post">
            @csrf
            <input type="hidden" value="{{ request()->route('user_id') }}" name="user_id">
            <div class="row sameheight-container">
                @foreach ($roles as $role)
                    <div class="col-md-4">
                    <div class="row box box{{ $role->user_level }}">
                        <div class="col-md-9">
                            <b>{{ $role->name }}</b>
                        </div>
                        <div class="col-md-3">                            
                            <input type="checkbox" {{ $user->roles->contains($role->id) ? 'checked' : '' }} name="roles[]"
                            value="{{ $role->id }}" />
                        </div>
                        <div class="col-md-12">
                            <i><u>{{ App\Models\User::USER_TYPE[$role->user_level] }} Role</u></i>
                        </div>
                    </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </section>
@endsection
