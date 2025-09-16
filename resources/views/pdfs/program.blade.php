<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program->title }} - {{ $trainee->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #f8f9fa;
            margin-bottom: 20px;
            border-bottom: 2px solid #dee2e6;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .trainee-info {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .day-card {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .day-header {
            background-color: #343a40;
            color: white;
            padding: 10px 15px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
        }
        .day-body {
            padding: 15px;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .exercise {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .exercise:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .exercise-name {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .exercise-details {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        .detail {
            margin-right: 15px;
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 14px;
        }
        .exercise-image {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            color: #6c757d;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo-dark.png') }}" alt="Level Up Life" class="logo">
        <h1>{{ $program->title }}</h1>
    </div>

    <div class="trainee-info">
        <h2>Trainee Information</h2>
        <p><strong>Name:</strong> {{ $trainee->name }}</p>
        @if($trainee->age)
            <p><strong>Age:</strong> {{ $trainee->age }} years</p>
        @endif
        @if($trainee->height)
            <p><strong>Height:</strong> {{ $trainee->height }} cm</p>
        @endif
        @if($trainee->weight)
            <p><strong>Weight:</strong> {{ $trainee->weight }} kg</p>
        @endif
        @if($trainee->gender)
            <p><strong>Gender:</strong> {{ ucfirst($trainee->gender) }}</p>
        @endif
        @if($trainee->notes)
            <p><strong>Notes:</strong> {{ $trainee->notes }}</p>
        @endif
    </div>

    @foreach($days as $day)
        <div class="day-card">
            <div class="day-header">
                Day {{ $day->day_number }}
            </div>
            <div class="day-body">
                @forelse($day->exercises as $exercise)
                    <div class="exercise">
                        <div class="exercise-name">{{ $exercise->name }}</div>
                        @if($exercise->description)
                            <p>{{ $exercise->description }}</p>
                        @endif
                        <div class="exercise-details">
                            <div class="detail"><strong>Sets:</strong> {{ $exercise->pivot->sets }}</div>
                            <div class="detail"><strong>Reps:</strong> {{ $exercise->pivot->reps }}</div>
                            @if($exercise->pivot->rpe)
                                <div class="detail"><strong>RPE:</strong> {{ $exercise->pivot->rpe }}</div>
                            @endif
                            @if($exercise->pivot->rest)
                                <div class="detail"><strong>Rest:</strong> {{ $exercise->pivot->rest }}</div>
                            @endif
                        </div>
                        @if($exercise->pivot->notes)
                            <p><strong>Notes:</strong> {{ $exercise->pivot->notes }}</p>
                        @endif
                        @if($exercise->hasMedia('exercise_image'))
                            <img src="{{ $exercise->getFirstMediaPath('exercise_image') }}" alt="{{ $exercise->name }}" class="exercise-image">
                        @endif
                    </div>
                @empty
                    <p>No exercises scheduled for this day.</p>
                @endforelse
            </div>
        </div>
        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

    <div class="footer">
        <p>Generated by Level Up Life on {{ now()->format('F j, Y') }}</p>
    </div>
</body>
</html>