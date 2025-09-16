<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program->title }} - {{ $trainee->name }}</title>
    <style>
        body {
            font-family: arial !important;
            line-height: 1.6;
            color: #e1e1e1;
            margin: 0;
            padding: 0;
            direction: rtl;
            text-align: right;
            font-size: 14px;
            background-color: #000000;
        }

        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #1e1e1e;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .trainee-info {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #1e1e1e;
            border-radius: 5px;
        }

        .day-card {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .day-header {
            background-color: #0d47a1;
            color: white;
            padding: 10px 15px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
        }

        .day-body {
            padding: 15px;
            border: 1px solid #333;
            border-top: none;
            border-radius: 0 0 5px 5px;
            background-color: #1e1e1e;
        }

        .exercise {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #333;
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
            color: #90caf9;
        }

        .exercise-details {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .detail {
            margin-left: 15px;
            background-color: #252525;
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
            border-top: 1px solid #333;
            font-size: 12px;
            color: #9e9e9e;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/level-up-dark.jpg') }}" alt="ليفل أب لايف" class="logo">
        <h1>{{ $program->title }}</h1>
    </div>

    <div class="trainee-info">
        <h2>معلومات المتدرب</h2>
        <p><strong>الاسم:</strong> {{ $trainee->name }}</p>
        @if ($trainee->age)
            <p><strong>العمر:</strong> {{ $trainee->age }} سنة</p>
        @endif
        @if ($trainee->height)
            <p><strong>الطول:</strong> {{ $trainee->height }} سم</p>
        @endif
        @if ($trainee->weight)
            <p><strong>الوزن:</strong> {{ $trainee->weight }} كجم</p>
        @endif
        @if ($trainee->gender)
            <p><strong>الجنس:</strong>
                @if ($trainee->gender == 'male')
                    ذكر
                @elseif($trainee->gender == 'female')
                    أنثى
                @else
                    آخر
                @endif
            </p>
        @endif
        @if ($trainee->notes)
            <p><strong>ملاحظات:</strong> {{ $trainee->notes }}</p>
        @endif
    </div>

    @foreach ($days as $day)
        <div class="day-card">
            <div class="day-header">
                اليوم {{ $day->day_number }}
            </div>
            <div class="day-body">
                @forelse($day->exercises as $exercise)
                    <div class="exercise">
                        <div class="exercise-name">{{ $exercise->name }}</div>
                        @if ($exercise->description)
                            <p>{{ $exercise->description }}</p>
                        @endif
                        <div class="exercise-details">
                            <div class="detail"><strong>المجموعات:</strong> {{ $exercise->pivot->sets }}</div>
                            <div class="detail"><strong>التكرارات:</strong> {{ $exercise->pivot->reps }}</div>
                            @if ($exercise->pivot->rpe)
                                <div class="detail"><strong>شدة الجهد:</strong> {{ $exercise->pivot->rpe }}</div>
                            @endif
                            @if ($exercise->pivot->rest)
                                <div class="detail"><strong>الراحة:</strong> {{ $exercise->pivot->rest }}</div>
                            @endif
                        </div>
                        @if ($exercise->pivot->notes)
                            <p><strong>ملاحظات:</strong> {{ $exercise->pivot->notes }}</p>
                        @endif
                        @if ($exercise->hasMedia('exercise_image'))
                            <img src="{{ $exercise->getFirstMediaPath('exercise_image') }}"
                                alt="{{ $exercise->name }}" class="exercise-image">
                        @endif
                    </div>
                @empty
                    <p>لا توجد تمارين مجدولة لهذا اليوم.</p>
                @endforelse
            </div>
        </div>
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

    <div class="footer">
        <p>تم إنشاؤه بواسطة ليفل أب لايف في {{ now()->format('Y/m/d') }}</p>
    </div>
</body>

</html>
