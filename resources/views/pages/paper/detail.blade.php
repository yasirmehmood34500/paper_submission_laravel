@extends('layouts.main')
@section('css')
    <style>
        .d_none {
            display: none;
        }

        .block {
            border: 1px solid gray;
            border-radius: 10px;
            padding: 10px;
            margin-top: 10px;
            box-shadow: 4px 5px 7px gray;
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
                <div class="pull-right">
                    @if (Gate::any(['assign_to_review', 'view_all_submission']) &&
                            $paper->status != App\Models\PaperSubmission::PENDING_FROM_AUTHOR_STATUS)
                        <button class="btn btn-primary assing_review_btn">Assign to Review</button>
                    @endif
                </div>
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

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 15px;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 15px;">
                {{ session('error') }}
            </div>
        @endif

        @php
            $currentProcessStatus = $paper->process_status ?? 1;
            $processStatusName = App\Models\PaperSubmission::PROCESS_STATUS[$currentProcessStatus] ?? 'Submitted';
            $processBadgeClass = App\Models\PaperSubmission::PROCESS_STATUS_BADGES[$currentProcessStatus] ?? 'badge-primary';
        @endphp

        <div class="block col-md-12" style="background-color: #f8f9fa; border-left: 5px solid #007bff; margin-top: 15px; margin-bottom: 15px;">
            <div class="row align-items-center" style="display: flex; align-items: center; flex-wrap: wrap;">
                <div class="col-md-6 col-sm-12">
                    <h5 style="margin-bottom: 5px; font-weight: 600; color: #333;">
                        <i class="fa fa-tasks" style="color: #007bff; margin-right: 5px;"></i> Paper Process Status
                    </h5>
                    <div style="font-size: 15px; margin-top: 6px;">
                        <span style="color: #666; font-weight: 500;">Current Status:</span>
                        <span id="current_process_status_badge" class="badge {{ $processBadgeClass }}" style="font-size: 14px; padding: 6px 12px; font-weight: 600; border-radius: 4px; vertical-align: middle;">
                            {{ $processStatusName }}
                        </span>
                    </div>
                </div>
                @if (auth()->check() && auth()->user()->user_level == App\Models\User::ADMIN)
                    <div class="col-md-6 col-sm-12 text-md-right mt-2 mt-md-0">
                        <form action="{{ route('update_paper_process_status') }}" method="POST" id="update_process_status_form" style="display: inline-flex; align-items: center; gap: 8px; justify-content: flex-end; flex-wrap: wrap;">
                            @csrf
                            <input type="hidden" name="paper_id" value="{{ $paper->id }}">
                            <label for="process_status_select" style="margin-bottom: 0; font-weight: 600; color: #444;">Change Status:</label>
                            <select name="process_status" id="process_status_select" class="form-control" style="width: auto; min-width: 240px; display: inline-block;">
                                @foreach (App\Models\PaperSubmission::PROCESS_STATUS as $statusCode => $statusLabel)
                                    <option value="{{ $statusCode }}" {{ $currentProcessStatus == $statusCode ? 'selected' : '' }}>
                                        {{ $statusLabel }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success" id="update_process_status_btn">
                                <i class="fa fa-check"></i> Update
                            </button>
                        </form>
                        <div id="status_update_msg" style="display: none; margin-top: 5px; font-weight: 600;"></div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row sameheight-container">
            <div class="block col-md-12">
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
                @if (Gate::check('view_all_submission') || $paper->user_id == auth()->id())
                    <b>Comment for Editor:</b>
                    <p>{{ $paper->comment_for_editor }}</p>
                @endif
                <div class="pull-right">
                    @can('login_as_user')
                        @if ($paper->user_id != auth()->id())
                            <a href="{{ route('login_as_user_link', ['user_id' => $paper->user_id]) }}"
                                class="btn btn-info">Login
                                As</a>
                        @endif
                    @endcan
                </div>
            </div>
            @if (Gate::check('view_all_submission') || $paper->user_id == auth()->id())
                <div class="block col-md-12">
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
                </div>
            @endif
            <div class="block col-md-12">
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
                                        class="download-link" data-paper-id="{{ $paper->id }}" download="">Download</a></td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>

            @if (Gate::any(['view_all_submission']) || $paper->user_id == auth()->id())
                <div class="block col-md-12">
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
                                <td>{{ $admin_decision->comment }}</td>
                                <td>
                                    @if ($admin_decision->file != '')
                                        @foreach (explode(',', $admin_decision->file) as $single_file)
                                            <a href="{{ asset('storage/uploads/admin_reply') }}/{{ $single_file }}" download="">Download</a><br>
                                        @endforeach
                                    @else
                                        No Files
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
                <div class="block col-md-12">
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
                                            <a href="{{ asset('storage/uploads/reviewer_reply') }}/{{ $assign_reviewer->file }}" download="">Download</a>
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
                <div class="block col-md-12">
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
            @endif
            @if (Gate::any(['reply_to_author', 'view_all_submission']) &&
                    $paper->status != App\Models\PaperSubmission::PENDING_FROM_AUTHOR_STATUS)
                <div class="block col-md-12">
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
                        <input type="file" class="form-control" multiple="" maxlength="5" name="file_name[]">
                        <br>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            @endif
            @if ($paper->user_id == auth()->id() && $paper->status == App\Models\PaperSubmission::PENDING_FROM_AUTHOR_STATUS)
                <div class="block col-md-12">
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
                    <div class="col-md-12">
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
                </div>
            @endif
        </div>
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

            @if(auth()->check() && auth()->user()->user_level == 1)
            $(".download-link").click(function() {
                var paper_id = $(this).data('paper-id');
                var link = $(this);
                
                $.ajax({
                    url: "{{ route('track_download') }}",
                    method: 'POST',
                    data: {
                        paper_id: paper_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                    }
                });
            });

            $("#update_process_status_form").submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var btn = $("#update_process_status_btn");
                var originalHtml = btn.html();
                var msgDiv = $("#status_update_msg");
                
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
                msgDiv.hide();

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        btn.prop('disabled', false).html(originalHtml);
                        if (response.success) {
                            var badge = $("#current_process_status_badge");
                            badge.removeClass().addClass('badge ' + response.badge_class);
                            badge.text(response.status_name);
                            msgDiv.html('<span class="text-success"><i class="fa fa-check-circle"></i> ' + response.message + '</span>').fadeIn();
                            setTimeout(function() {
                                msgDiv.fadeOut();
                            }, 4000);
                        }
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html(originalHtml);
                        var errorMsg = 'Failed to update process status.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        msgDiv.html('<span class="text-danger"><i class="fa fa-exclamation-circle"></i> ' + errorMsg + '</span>').fadeIn();
                    }
                });
            });
            @endif
        });
    </script>
@endsection
