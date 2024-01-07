@extends('layouts.main')
@section('content')
    <section class="section">
        <h2>For Review Paper</h2>
        <div class="row sameheight-container">
            <table class="table table-striped">
                <tr>
                    <th>Paper no</th>
                    <th>Title</th>
                    <th>Revision No</th>
                    <th>Status</th>
                    <th>Assign Date</th>
                </tr>
                @foreach ($assign_papers as $assign_paper)
                    <tr>
                        <td>
                            <a
                                href="{{ route('view_paper_detail', ['id' => @$assign_paper?->paper_submission?->id ?: 0]) }}"><b>{{ $assign_paper->paper_submission->paper_no }}</b></a>
                        </td>
                        <td>{{ @$assign_paper?->paper_submission?->title }}</td>
                        <td>R{{ @$assign_paper?->revision }}</td>
                        <td>{{ @$assign_paper?->review_type?->name ?? 'Pending' }}</td>
                        <td>
                            {{ Carbon\Carbon::parse($assign_paper->assign_date)->format('d M Y') }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
