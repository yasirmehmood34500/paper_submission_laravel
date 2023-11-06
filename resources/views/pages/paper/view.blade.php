@extends('layouts.main')
@section('content')
    <section class="section">
        <h2>
            @if (auth()->user()->user_level == 1)
                All Submissions
            @else
                My {{ request()->route('in_draft') == 1 ? 'Draft' : 'Sended' }}
            @endif
        </h2>
        <div class="row sameheight-container">
            <table class="table table-striped">
                <tr>
                    <th>Paper no</th>
                    @if (auth()->user()->user_level == 1)
                        <th>Email</th>
                    @endif
                    <th>Title</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>Submit Date</th>
                </tr>
                @foreach ($my_submissions as $my_submission)
                    <tr>
                        <td>
                            @if ($my_submission->in_draft)
                                <a
                                    href="{{ route('continue_draft', ['id' => $my_submission->id]) }}"><b>{{ $my_submission->paper_no }}</b></a>
                            @else
                                <a
                                    href="{{ route('view_paper_detail', ['id' => $my_submission->id]) }}"><b>{{ $my_submission->paper_no }}</b></a>
                            @endif
                        </td>
                        @if (auth()->user()->user_level == 1)
                            <td>{{ @$my_submission?->user?->email }}</td>
                        @endif
                        <td>{{ $my_submission->title }}</td>
                        <td>
                            @if ($my_submission->in_draft)
                                Draft
                            @else
                                {{ $my_submission->status }}
                            @endif
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($my_submission->start_date)->format('d M Y') }}
                        </td>
                        <td>
                            @if ($my_submission->in_draft)
                                Not Submitted
                            @else
                                {{ Carbon\Carbon::parse($my_submission->send_date)->format('d M Y') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
