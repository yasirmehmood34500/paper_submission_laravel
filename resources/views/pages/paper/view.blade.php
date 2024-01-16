@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
@endsection
@section('content')
    <section class="section">
        <h2>
            @can('view_all_submission')
                @if (request()->route('status'))
                    {{ App\Models\PaperSubmission::PAPER_STATUS[request()->route('status') - 1] }}
                @else
                    All Submissions
                @endif
            @else
                My {{ request()->route('in_draft') == 1 ? 'Draft' : 'Submission' }}
            @endcan
        </h2>
        <div class="sameheight-container">
            <table class="table table-striped" id="paper_table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Paper no</th>
                        @can('view_all_submission')
                            <th>Email</th>
                        @endcan
                        <th>Title</th>
                        <th>Status</th>
                        <th>Submited Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($my_submissions as $my_submission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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
                                    {{ App\Models\PaperSubmission::PAPER_STATUS[$my_submission->status] }}
                                @endif
                            </td>
                            <td>
                                @if ($my_submission->in_draft)
                                    Not Submitted
                                @else
                                    {{ Carbon\Carbon::parse($my_submission->created_at)->format('d M Y h:i A') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#paper_table').dataTable({
                // iDisplayLength: 100
                lengthMenu: [
                    [100, 200, 300, 400, 500, -1],
                    [100, 200, 300, 400, 500, "All"]
                ]
            });
        });
    </script>
@endsection
