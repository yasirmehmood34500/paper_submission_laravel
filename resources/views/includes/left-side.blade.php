<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                {{ config('app.name') }}
                {{ auth()->user()->user_level == 1 ? 'Admin' : (auth()->user()->user_level == 2 ? 'Author' : 'Reviewer') }}
            </div>
        </div>
        <nav class="menu">
            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                <li class="active">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-home"></i> Dashboard </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-th-large"></i> Submission
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li>
                            <a href="{{ route('submission_step_1') }}"> New </a>
                        </li>
                        <li>
                            <a href="{{ route('my_submission', ['in_draft' => 1]) }}"> Draft </a>
                        </li>
                        <li>
                            <a href="{{ route('my_submission') }}"> Sended </a>
                        </li>
                        @if (auth()->user()->user_level == 1)
                            <li>
                                <a href="{{ route('all_submissions_page') }}"> Received </a>
                            </li>
                        @endif


                    </ul>
                </li>
                @if (auth()->user()->user_level == 1)
                    <li>
                        <a href="#">
                            <i class="fa fa-th-large"></i> Authors
                            <i class="fa arrow"></i>
                        </a>
                        <ul class="sidebar-nav">
                            <li>
                                <a href="{{ route('view_author_page') }}"> View </a>
                            </li>
                            <li>
                                <a href="{{ route('add_author_page') }}"> Add </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('contributor_rule_page') }}">
                            <i class="fa fa-pencil-square-o"></i> Contributor Rule </a>
                    </li>
                    <li>
                        <a href="{{ route('file_type_page') }}">
                            <i class="fa fa-pencil-square-o"></i> File Type </a>
                    </li>
                @endif
                
            </ul>
        </nav>
    </div>
</aside>
