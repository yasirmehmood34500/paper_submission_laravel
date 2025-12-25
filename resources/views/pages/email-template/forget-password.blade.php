<!DOCTYPE html>
<html>

<head>
    <title>Forget Password</title>
</head>

<body>
    <p>
        Dr. / Mr. / Mrs. <b>{{ $name }}</b><br>
        If you want to reset your password, click on the link below (or copy and paste the URL into your browser): <a
            href="{{ config('constants.journal_submission_url') }}/reset-password/{{ $token }}">{{ config('constants.journal_submission_url') }}/reset-password/{{ $token }}</a>
    </p>
    @include('pages.email-template.include.signature')
</body>

</html>
