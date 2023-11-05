@extends('layouts.main')
@section('content')
    <section class="section">
        <h2>{{ $paper->paper_no }}</h2>
        <div class="row sameheight-container">
            <div class="col-md-12">
                <p>{{ $paper->prefix }}</p>
                <p>{{ $paper->title }}</p>
                <p>{{ $paper->sub_title }}</p>
                <p>{{ $paper->abstract }}</p>
                <p>{{ $paper->keywords }}</p>
            </div>
            <br>
            <h5>Contributors</h5>
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rule</th>
                </tr>
                @foreach ($paper_contributors as $paper_contributor)
                    <tr>
                        <td>{{ $paper_contributor->name }}</td>
                        <td>{{ $paper_contributor->email }}</td>
                        <td>{{ $paper_contributor->contributor_rule->name }}</td>
                    </tr>
                @endforeach
            </table>
            <h5>Paper Files</h5>
            <table class="table table-striped">
                <tr>
                    <th>File Type</th>
                    <th>Action</th>
                </tr>
                @foreach ($paper_files as $paper_file)
                    <tr>
                        <td>{{ $paper_file->file_type->name }}</td>
                        <td><a href="{{ asset('storage/uploads/submission') }}/{{ $paper_file->file_name }}"
                                download="">Download</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
