<!DOCTYPE html>
<html>

<head>
    <title>Editor Decision</title>
</head>

<body>
    <p>
        Dr. / Mr. / Mrs. <b>{{ $name }}</b><br>
        {{ $comment }}
    </p>
    <p>User Name: <b>{{ $name }}</b></p>
    <p>Password: ********</p>
    <p>In the meantime, if you have any questions, please do not hesitate to contact us at
        {{ config('constants.journal_email') }}.</p>
    <p>Sincerely,</p>
    <p>Regards</p>
    <p>Azhar</p>
    <p>Editorial Assistant</p>
    <p>Journal of Global Innovations in Agricultural Sciences (JGIAS)</p>
</body>

</html>
