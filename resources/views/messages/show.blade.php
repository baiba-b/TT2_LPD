<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages with {{ $user->name }}</title>
    <link rel="stylesheet" href="\css\messagesStylesheet.css">
</head>
<body>
    <div class="container">
        <h1>Chat with {{ $user->name }}</h1>
        @foreach($messages as $message)
            <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
                <p>{{ $message->content }}</p>
            </div>
        @endforeach
        <form action="{{ route('messages.store', $user->id) }}" method="POST" class="message-form">
            @csrf
            <input type="text" name="message" placeholder="..." required>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
