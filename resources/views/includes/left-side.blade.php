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
                @if (Gate::check('view_all_submission') || Gate::check('new_paper_submission') || Gate::check('author_my_submission'))
                    <li>
                        <a href="#">
                            <i class="fa fa-th-large"></i> Paper
                            <i class="fa arrow"></i>
                        </a>
                        <ul class="sidebar-nav">
                            @can('view_all_submission')
                                <li>
                                    <a href="{{ route('all_submissions_page') }}"> Received </a>
                                </li>
                            @endcan
                            @can('new_paper_submission')
                                <li>
                                    <a href="{{ route('submission_step_1') }}"> New </a>
                                </li>
                            @endcan
                            @can('author_my_submission')
                                <li>
                                    <a href="{{ route('my_submission', ['in_draft' => 1]) }}"> Draft </a>
                                </li>
                                <li>
                                    <a href="{{ route('my_submission') }}"> Sended </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                @if (Gate::check('view_author') || Gate::check('add_author'))
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
                @if (Gate::check('view_reviewer') || Gate::check('add_reviewer'))
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
                @if (Gate::check('add_contributor_rule') || Gate::check('view_contributor_rule'))
                    <li>
                        <a href="{{ route('contributor_rule_page') }}">
                            <i class="fa fa-pencil-square-o"></i> Contributor Rule </a>
                    </li>
                @endif
                @if (Gate::check('add_paper_file_type') || Gate::check('view_paper_file_type'))
                    <li>
                        <a href="{{ route('file_type_page') }}">
                            <i class="fa fa-pencil-square-o"></i> File Type </a>
                    </li>
                @endif
                @if (Gate::check('add_paper_submission_requirement') || Gate::check('view_paper_submission_requirement'))
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
