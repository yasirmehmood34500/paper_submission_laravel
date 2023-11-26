<!DOCTYPE html>
<html>

<head>
    <title>Send to Reviewer</title>
</head>

<body>
    <ol>
        <li><a href="{{ config('constants.journal_url') }}">Login Link</a></li>
        <li>Mr / Mrs, {{ $name }}</li>
    </ol>
    <p>Paper Title <b>{{ $title }}</b> for Review
        <b>{{ config('constants.journal_name') }} ({{ config('constants.journal_stand_for') }})</b>.
    </p>
    <p> Paper No: <b>{{ $paper_no }}</b>.</p>
    <p> Thank you for your valuable contribution to our journal.</p>
    <p>Best regards,</p>
    <p>Azhar</p>
    <p>Editorial Team</p>
    <p style="color: green; font-weight: bold;">Journal of Global Innovations in Agricultural Sciences (JGIAS)</p>
</body>

</html>
