<!DOCTYPE html>
<html>

<head>
    <title>Paper Submission</title>
</head>

<body>
    <p>
        Dr. / Mr. / Mrs. <b>{{ $name }}</b><br>
        Thank you for submitting your manuscript, "<b>{{ $title }}</b>" to
        <b>{{ config('constants.journal_name') }} ({{ config('constants.journal_stand_for') }})</b>. We have received
        your paper and it is currently undergoing the initial editorial review process. You can track the progress of
        your manuscript through our online submission system at <a href="{{ config('constants.journal_url') }}">Login
            Link</a>. We will aim to provide you with a decision within [Four weeks].
    </p>
    @include('pages.email-template.include.signature')
</body>

</html>
