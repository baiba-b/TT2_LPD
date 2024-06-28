<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\connectionsStylesheet.css">
    <title>Connections</title>
</head>
<body>
<div class="container">
        <div class="section">
            <h2>Mutual Connections</h2>
            @if($mutualConnections->isEmpty())
                <p>You have no mutual connections yet.</p>
            @else
                @foreach($mutualConnections as $connection)
                    <div class="connection">
                        <img src="{{ $connection->profile_picture }}" alt="{{ $connection->name }}" class="profile-picture">
                        <div class="user-info">
                            <h3>{{ $connection->name }}</h3>
                            <p>{{ $connection->email }}</p>
                        </div>
                        <a href="{{ route('messages.show', $connection->id) }}" class="connect-button">Message</a>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="section">
            <h2>Users You've Added</h2>
            @if($connections->isEmpty())
                <p>You have not added any users yet.</p>
            @else
                @foreach($connections as $connection)
                    @if(!$mutualConnections->contains($connection))
                        <div class="connection">
                            <img src="{{ $connection->profile_picture }}" alt="{{ $connection->name }}" class="profile-picture">
                            <div class="user-info">
                                <h3>{{ $connection->name }}</h3>
                                <p>{{ $connection->email }}</p>
                            </div>
                            <a href="{{ route('messages.show', $connection->id) }}" class="connect-button">Message</a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="section">
            <h2>Users Who Have Added You</h2>
            @if($connectedTo->isEmpty())
                <p>No users have added you yet.</p>
            @else
                @foreach($connectedTo as $connection)
                    @if(!$mutualConnections->contains($connection))
                        <div class="connection">
                            <img src="{{ $connection->profile_picture }}" alt="{{ $connection->name }}" class="profile-picture">
                            <div class="user-info">
                                <h3>{{ $connection->name }}</h3>
                                <p>{{ $connection->email }}</p>
                            </div>
                            <a href="{{ route('messages.show', $connection->id) }}" class="connect-button">Message</a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>
