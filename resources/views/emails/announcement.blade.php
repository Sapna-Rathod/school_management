<!DOCTYPE html>
<html>
<head>
    <title>New Announcement</title>
</head>
<body>
    <h1>{{ $announcement->title }}</h1>
    <p>{{ $announcement->content }}</p>
    <p>Posted by: {{ $announcement->user->name }}</p>
</body>
</html>
