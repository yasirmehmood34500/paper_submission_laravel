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
                @if (Gate::any(['assign_to_review', 'view_all_submission']))
                    <button class="btn btn-primary assing_review_btn">Assign to Review</button>
                @endif
                @can('login_as_user')
                    @if ($paper->user_id != auth()->id())
                        <a href="{{ route('login_as_user_link', ['user_id' => $paper->user_id]) }}" class="btn btn-info">Login
                            As</a>
                    @endif
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
                {{-- <b>Prefix:</b>
                <p>{{ $paper->prefix }}</p> --}}
                <b>Title:</b>
                <p>{{ $paper->title }}</p>
                <b>Sub Title:</b>
                <p>{{ $paper->sub_title }}</p>
                <b>Abstract:</b>
                <p>{{ $paper->abstract }}</p>
                <b>Keywords:</b>
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
        @if ($paper->user_id == auth()->id())
            <div class="row">
                <h5>Editor Decision</h5>
                <table class="table table-striped">
                    <tr>
                        <th>Decision</th>
                        <th>Comments</th>
                        <th>File</th>
                        <th>Date</th>
                    </tr>
                    @foreach ($admin_decisions as $admin_decision)
                        <tr>
                            <td>{{ $admin_decision->review_type->name }}</td>
                            <td>R{{ $admin_decision->comment }}</td>
                            <td>
                                @if ($admin_decision->file != '')
                                    <a href="{{ asset('storage/uploads/admin_reply') }}/{{ $admin_decision->file }}"
                                        download="">Download</a>
                                @else
                                    No File
                                @endif
                            </td>
                            <td>
                                @if ($admin_decision->review_type_id)
                                    {{ Carbon\Carbon::parse($admin_decision->created_at)->format('d M Y') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
        @if (Gate::any(['assign_to_review', 'view_all_submission', 'view_assign_paper']))
            <div class="row">
                <h5>Assign for Review</h5>
                <table class="table table-striped">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Revision No</th>
                        <th>Review Status</th>
                        <th>Assign Date</th>
                        <th>File</th>
                        <th>Reply Date</th>
                    </tr>
                    @foreach ($assign_reviewers as $assign_reviewer)
                        <tr>
                            <td>{{ $assign_reviewer->user->name }}</td>
                            <td>{{ $assign_reviewer->user->email }}</td>
                            <td>R{{ $assign_reviewer->revision }}</td>
                            <td>{{ $assign_reviewer->review_type->name ?? 'Pending' }}</td>
                            <td>{{ Carbon\Carbon::parse($assign_reviewer->assign_date)->format('d M Y') }}</td>
                            <td>
                                @if ($assign_reviewer->review_type_id)
                                    @if ($assign_reviewer->file != '')
                                        <a href="{{ asset('storage/uploads/reviewer_reply') }}/{{ $assign_reviewer->file }}"
                                            download="">Download</a>
                                    @else
                                        No File
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ($assign_reviewer->review_type_id)
                                    {{ Carbon\Carbon::parse($assign_reviewer->updated_at)->format('d M Y') }}
                                @endif
                            </td>
                        </tr>
                        @if ($assign_reviewer->review_type_id)
                            <tr>
                                <th>Comment</th>
                                <td colspan="6">{{ $assign_reviewer->comment }}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        @endif
        @if (Gate::any(['view_assign_paper']) &&
                $assign_reviewers->where('review_type_id', 0)->count() > 0 &&
                $assign_reviewers->where('user_id', auth()->id())->where('review_type_id', 0)->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <h5>Reply Comments</h5>
                    <form action="{{ route('reviewer_reply_paper') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ request()->route('id') }}" name="paper_id">
                        <label for="">Revision Type</label>
                        <select name="review_type_id" id="" class="form-control">
                            @foreach ($review_types as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="">Comment</label>
                        <textarea name="comment" id="" cols="3" rows="3" class="form-control" required></textarea>
                        <label for="">File</label>
                        <input type="file" class="form-control" name="file_name">
                        <br>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        @endif
        @if (Gate::any(['reply_to_author', 'view_all_submission']) &&
                $paper->status != App\Models\PaperSubmission::PENDING_FROM_AUTHOR_STATUS)
            <div class="row">
                <div class="col-md-12">
                    <h5>Reply to Author</h5>
                    <form action="{{ route('revision_send_to_author') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ request()->route('id') }}" name="paper_id">
                        <label for="">Revision Type</label>
                        <select name="review_type_id" id="" class="form-control">
                            @foreach ($review_types as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="">Subject</label>
                        <input type="text" name="subject" class="form-control" required="">
                        <label for="">Comment</label>
                        <textarea name="comment" id="" cols="3" rows="3" class="form-control" required></textarea>
                        <label for="">File</label>
                        <input type="file" class="form-control" name="file_name">
                        <br>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        @endif

        @if ($paper->user_id == auth()->id() && $paper->status == App\Models\PaperSubmission::PENDING_FROM_AUTHOR_STATUS)
            <div class="row">
                <div class="col-md-6">
                    <h4>Upload Revision Files</h4>
                </div>
                <div class="col-md-6">
                    <button class="pull-right btn btn-success" id="upload_btn">Upload Revision Files +</button>
                </div>
            </div>
            <div class="new_file_upload d_none">
                <form action="{{ route('revision_upload_file') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ request()->route('id') }}" name="paper_id">
                    <label for="">Choose File</label>
                    <input type="file" name="file_name" required="" class="form-control">
                    <label for="">Select File Type</label>
                    <select name="submission_file_type_id" id="" class="form-control">
                        @foreach ($paper_file_types as $paper_file_type)
                            <option value="{{ $paper_file_type->id }}">{{ $paper_file_type->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
            <div class="row sameheight-container">
                @if (count($paper_files) > 0 && $paper_files->where('revision', $paper->revision)->count() > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>File Type</th>
                            <th>Remove</th>
                        </tr>
                        @foreach ($paper_files as $paper_file)
                            @if ($paper->revision == $paper_file->revision)
                                <tr>
                                    <td><a href="{{ asset('storage/uploads/submission') }}/{{ $paper_file->file_name }}"
                                            download="">{{ $paper_file->file_type->name }}</a></td>
                                    <td><a href="{{ route('delete_file', ['id' => $paper_file->id]) }}"
                                            class="btn btn-danger">Remove</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                    <form action="{{ route('revision_reply_send') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ request()->route('id') }}" name="paper_id">
                        <button type="submit" class="btn btn-primary">Send Revision Files</button>
                    </form>
                @endif
            </div>
        @endif

    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $("#upload_btn").click(function() {
                if ($('.new_file_upload').hasClass('d_none')) {
                    $('.new_file_upload').removeClass('d_none');
                } else {
                    $('.new_file_upload').addClass('d_none');
                }
            });

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
