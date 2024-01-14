<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                {{ config('constants.journal_stand_for') }}
                {{ auth()->user()->user_level == 1 ? 'Admin' : (auth()->user()->user_level == 2 ? 'Author' : 'Reviewer') }}
            </div>
        </div>
        <nav class="menu">
            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                <li class="active">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-home"></i> Dashboard </a>
                </li>
                @if (Gate::any(['new_paper_submission', 'author_my_submission', 'view_assign_paper', 'view_all_submission']))
                    <li>
                        <a href="#">
                            <i class="fa fa-th-large"></i> Paper
                            <i class="fa arrow"></i>
                        </a>
                        <ul class="sidebar-nav">
                            @can('view_all_submission')
                                <li>
                                    <a href="{{ route('all_submissions_page') }}"> All Papers </a>
                                </li>
                                @foreach (App\Models\PaperSubmission::PAPER_STATUS as $key => $value)
                                    <li>
                                        <a href="{{ route('paper_status_wise', ['status' => $key + 1]) }}">
                                            {{ $value }}
                                        </a>
                                    </li>
                                @endforeach
                            @endcan
                            @can('new_paper_submission')
                                <li>
                                    <a href="{{ route('submission_step_1') }}"> New Submission</a>
                                </li>
                            @endcan
                            @can('author_my_submission')
                                <li>
                                    <a href="{{ route('my_submission', ['in_draft' => 1]) }}">My Draft </a>
                                </li>
                                <li>
                                    <a href="{{ route('my_submission') }}"> My Submission </a>
                                </li>
                            @endcan
                            @can('view_assign_paper')
                                <li>
                                    <a href="{{ route('reviewer_assign_page') }}">For Review </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                @if (Gate::any(['view_author', 'add_author']))
                    <li>
                        <a href="#">
                            <i class="fa fa-th-large"></i> Authors
                            <i class="fa arrow"></i>
                        </a>
                        <ul class="sidebar-nav">
                            @can('view_author')
                                <li>
                                    <a href="{{ route('view_author_page') }}"> View </a>
                                </li>
                            @endcan
                            @can('add_author')
                                <li>
                                    <a href="{{ route('add_author_page') }}"> Add </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                @if (Gate::any(['view_reviewer', 'add_reviewer']))
                    <li>
                        <a href="#">
                            <i class="fa fa-th-large"></i> Reviewers
                            <i class="fa arrow"></i>
                        </a>
                        <ul class="sidebar-nav">
                            @can('view_reviewer')
                                <li>
                                    <a href="{{ route('view_reviewer_page') }}"> View </a>
                                </li>
                            @endcan
                            @can('add_reviewer')
                                <li>
                                    <a href="{{ route('add_reviewer_page') }}"> Add </a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                @endif
                @if (Gate::any(['add_contributor_rule', 'view_contributor_rule']))
                    <li>
                        <a href="{{ route('contributor_rule_page') }}">
                            <i class="fa fa-pencil-square-o"></i> Contributor Role </a>
                    </li>
                @endif
                @if (Gate::any(['view_review_type', 'add_review_type']))
                    <li>
                        <a href="{{ route('review_type_page') }}">
                            <i class="fa fa-pencil-square-o"></i> Review Type </a>
                    </li>
                @endif
                @if (Gate::any(['add_paper_file_type', 'view_paper_file_type']))
                    <li>
                        <a href="{{ route('file_type_page') }}">
                            <i class="fa fa-pencil-square-o"></i> File Type </a>
                    </li>
                @endif
                @if (Gate::any(['add_paper_submission_requirement', 'view_paper_submission_requirement']))
                    <li>
                        <a href="{{ route('view_submissioin_requirement_page') }}">
                            <i class="fa fa-pencil-square-o"></i> Submission Requirement
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>
