<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Feed</title>
</head>

<body>
    <h1>Social Media Feed</h1>

    <div>
        @foreach ($posts as $post)
        <div>
            <h2>{{ $post['title'] }}</h2>
            <p>{{ $post['body'] }}</p>
            <h3>Comments:</h3>
            <ul>
                @foreach ($post['comments'] as $comment)
                <li>{{ $comment['name'] }}: {{ $comment['body'] }}</li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</body>

</html>