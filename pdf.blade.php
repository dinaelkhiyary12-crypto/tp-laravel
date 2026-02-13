<div>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
     <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $event->title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { text-align: center; }
        p { margin: 5px 0; }
        ul { margin: 0; padding-left: 20px; }
    </style>
</head>
<body>
    <h1>{{ $event->title }}</h1>
    <p><strong>Date:</strong> {{ $event->date }}</p>
    <p><strong>Location:</strong> {{ $event->location }}</p>
    <p><strong>Description:</strong> {{ $event->description }}</p>

    <h3>Speakers</h3>
    @if($event->speakers && $event->speakers->count() > 0)
        <ul>
            @foreach($event->speakers as $speaker)
                <li>{{ $speaker->name }}</li>
            @endforeach
        </ul>
    @else
        <p>No speakers assigned.</p>
    @endif
</body>
</html>
</div>
