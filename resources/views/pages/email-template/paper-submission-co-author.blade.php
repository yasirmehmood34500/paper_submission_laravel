<!DOCTYPE html>
<html>

<head>
    <title>Paper Submission Co Authors</title>
</head>

<body>
    <p>
        Dr. / Mr. / Mrs. <b>{{ $name }}</b><br>
        I have included you as a {{ $contributor_rule }} on my paper titled "<b>{{ $title }}</b>" which I have recently
        submitted to <b>{{ config('constants.journal_name') }} ({{ config('constants.journal_stand_for') }})</b>. Your
        contributions and support have been very valuable, and I truly appreciate your involvement.
    </p>
    @include('pages.email-template.include.signature')
</body>

</html>
