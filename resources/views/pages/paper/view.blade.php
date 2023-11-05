@extends('layouts.main')
@section('content')
    <section class="section">
        <h2>My Submissions</h2>
        <div class="row sameheight-container">
            <table class="table table-striped">
                <tr>
                    <th>Paper no</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($my_submissions as $my_submission)
                    <tr>
                        <td>{{ $my_submission->paper_no }}</td>
                        <td>{{ $my_submission->title }}</td>
                        <td>{{ $my_submission->status }}</td>
                        <td>
                            @if ($my_submission->in_draft)
                                <a href="{{ route('continue_draft', ['id' => $my_submission->id]) }}">Continue</a>
                            @else
                                <a href="{{ route('view_paper_detail', ['id' => $my_submission->id]) }}">Detail</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
