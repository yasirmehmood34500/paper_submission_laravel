<!DOCTYPE html>
<html>

<head>
    <title>Send to Reviewer</title>
</head>

<body>
    <p>
        Dr. / Mr. / Mrs. <b>{{ $name }}</b><br>
        I invite you to peer review a recent manuscript entitled <b>{{ $paper_no }}</b> entitled
        "<b>{{ $title }}</b>" You have been identified as highly qualified. Content matter experts and our
        journal staff would appreciate your service of a timely review. The manuscript and review sheet are attached.
        for your valuable review notes.</p>
    @include('pages.email-template.include.signature')
</body>

</html>
