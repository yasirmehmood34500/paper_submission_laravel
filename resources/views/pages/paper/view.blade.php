@extends('layouts.main')
@section('content')
    <section class="section">
        <h2>
            @can('view_all_submission')
                All Submissions
            @else
                My {{ request()->route('in_draft') == 1 ? 'Draft' : 'Sended' }}
            @endcan
        </h2>
        <div class="row sameheight-container">
            <table class="table table-striped">
                <tr>
                    <th>Paper no</th>
                    @can('view_all_submission')
                        <th>Email</th>
                    @endcan
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
                        @can('view_all_submission')
                            <td>{{ @$my_submission?->user?->email }}</td>
                        @endcan
                        <td>{{ $my_submission->title }}</td>
                        <td>
                            @if ($my_submission->in_draft)
                                Draft
                            @else
                                {{ App\Models\PaperSubmission::PAPER_STATUS[$my_submission->status == 'Pending' ? 0 : $my_submission->status] }}
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
