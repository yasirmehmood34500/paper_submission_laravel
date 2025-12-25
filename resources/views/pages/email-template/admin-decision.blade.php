<!DOCTYPE html>
<html>

<head>
    <title>Editor Decision</title>
</head>

<body>
    <p>
        Dr. / Mr. / Mrs. <b>{{ $name }}</b>
        <pre>{{ $comment }}</pre>
    </p>
    @include('pages.email-template.include.signature')
</body>

</html>
