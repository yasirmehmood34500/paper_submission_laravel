@extends('layouts.main')
@section('css')
    <style>
        .d_none {
            display: none;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $paper->paper_no }}</h2>
            </div>
            <div class="col-md-6">
                @can(['assign_to_review', 'view_all_submission'])
                    <button class="btn btn-primary assing_review_btn">Assign to Review</button>
                @endcan
            </div>
        </div>
        <div class="assing_review_box d_none">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" id="search_reviewer" placeholder="Search Reviewer" class="form-control">
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="show_data">

                    </table>
                </div>
            </div>
        </div>

        <div class="row sameheight-container">
            <div class="col-md-12">
                <p>{{ $paper->prefix }}</p>
                <p>{{ $paper->title }}</p>
                <p>{{ $paper->sub_title }}</p>
                <p>{{ $paper->abstract }}</p>
                <p>{{ $paper->keywords }}</p>
            </div>
            <br>
            @if (Gate::check('view_all_submission') || $paper->user_id == auth()->id())
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
            @endif
            <h5>Paper Files</h5>
            <table class="table table-striped">
                <tr>
                    <th>File Type</th>
                    <th>Revision</th>
                    <th>Action</th>
                </tr>
                @foreach ($paper_files as $paper_file)
                    @if (in_array((int) $paper_file->revision, $allow_revision_file_no->toArray()) ||
                            $paper->user_id == auth()->id() ||
                            Gate::check('view_all_submission'))
                        <tr>
                            <td>{{ $paper_file->file_type->name }}</td>
                            <td>R{{ $paper_file->revision }}</td>
                            <td><a href="{{ asset('storage/uploads/submission') }}/{{ $paper_file->file_name }}"
                                    download="">Download</a></td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
        @can(['assign_to_review', 'view_all_submission'])
            <div class="row">
                <h5>Assign Reviewers</h5>
                <table class="table table-striped">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Revision No</th>
                        <th>Reply Status</th>
                        <th>Assign Date</th>
                    </tr>
                    @foreach ($assign_reviewers as $assign_reviewer)
                        <tr>
                            <td>{{ $assign_reviewer->user->name }}</td>
                            <td>{{ $assign_reviewer->user->email }}</td>
                            <td>R{{ $assign_reviewer->revision }}</td>
                            <td>{{ $assign_reviewer->reply ? 'Replied' : 'Pending' }}</td>
                            <td>{{ Carbon\Carbon::parse($assign_reviewer->assign_date)->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endcan

    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(".assing_review_btn").click(function() {
                if ($('.assing_review_box').hasClass('d_none')) {
                    $('.assing_review_box').removeClass('d_none');
                } else {
                    $('.assing_review_box').addClass('d_none');
                }
            });
            $("#search_reviewer").keyup(function() {
                var text = $(this).val();

                if (text.length == 0) {
                    return false;
                }
                $.ajax({
                    url: "{{ route('search_reviewer_req') }}",
                    method: 'POST',
                    data: {
                        text: text,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        var show_data = `<tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Assign</th>
                        </tr>`;
                        data.user.forEach(element => {
                            var sendUrl =
                                "{{ route('send_to_reviewer', ['paper_id' => ':paper_id', 'user_id' => ':user_id']) }}"
                                .replace(':paper_id', "{{ request()->route('id') }}")
                                .replace(':user_id', element.id);

                            show_data += `<tr>
                                <td>${element.name}</td>
                                <td>${element.email}</td>
                                <td><a href="${sendUrl}" class="btn btn-info">Send</a></td>
                            </tr>`;
                        });
                        $("#show_data").html(show_data);
                    }
                });
            });
        });
    </script>
@endsection
