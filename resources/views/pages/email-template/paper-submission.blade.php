<!DOCTYPE html>
<html>

<head>
    <title>Paper Submission</title>
</head>

<body>
    <ol>
        <li><a href="{{ config('constants.journal_url') }}">Login Link</a></li>
        <li>{{ $name }}</li>
    </ol>
    <p>We are delighted to announce that your manuscript titled <b>{{ $title }}</b> has been received for
        publication in the <b>{{ config('constants.journal_name') }} ({{ config('constants.journal_stand_for') }})</b>.
    </p>
    <p> The assigned manuscript number is <b>{{ $paper_no }}</b>.</p>
    <p>Please provide us with the official email address of the corresponding author for our records.</p>
    <p> Should you have any queries or require further assistance, please do not hesitate to contact us.</p>
    <p> Thank you for your valuable contribution to our journal.</p>
    <p>Best regards,</p>
    <p>Azhar</p>
    <p>Editorial Team</p>
    <p style="color: green; font-weight: bold;">Journal of Global Innovations in Agricultural Sciences (JGIAS)</p>
</body>

</html>
