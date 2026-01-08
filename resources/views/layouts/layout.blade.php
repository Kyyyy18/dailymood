<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DailyMood - Pelacakan Mood Harian')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #11a8d2;
            --primary-dark: #0e94ba;
            --primary-light: #3dc4e8;
            --white: #ffffff;
            --text-dark: #1a1a2e;
            --text-muted: #6c757d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #11a8d2 0%, #0e94ba 100%);
            min-height: 100vh;
            color: var(--text-dark);
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 25px;
        }

        .card {
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 8px 30px rgba(17, 168, 210, 0.15);
            padding: 35px;
            margin-bottom: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(17, 168, 210, 0.2);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin: 5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(17, 168, 210, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(17, 168, 210, 0.45);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(17, 168, 210, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(17, 168, 210, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff7675 0%, #d63031 100%);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(214, 48, 49, 0.25);
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(214, 48, 49, 0.35);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--white);
            font-size: 15px;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid rgba(17, 168, 210, 0.2);
            border-radius: 16px;
            font-size: 15px;
            font-family: inherit;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background: var(--white);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(17, 168, 210, 0.15);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 130px;
        }

        .alert {
            padding: 20px 24px;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-info {
            background: var(--white);
            color: var(--text-dark);
            box-shadow: 0 4px 20px rgba(17, 168, 210, 0.15);
        }

        .mood-emoji {
            font-size: 56px;
            margin-right: 20px;
        }

        .mood-card {
            border-left: 5px solid var(--primary);
            padding: 28px;
            margin-bottom: 20px;
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(17, 168, 210, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .mood-card:hover {
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(17, 168, 210, 0.15);
        }

        .mood-date {
            color: var(--text-muted);
            font-size: 13px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .mood-reason {
            color: #495057;
            line-height: 1.7;
            margin-top: 15px;
            font-size: 14px;
        }

        .suggestion-box {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 28px;
            border-radius: 20px;
            margin-top: 20px;
            box-shadow: 0 6px 25px rgba(17, 168, 210, 0.25);
        }

        .suggestion-box h3 {
            margin-bottom: 12px;
            font-size: 18px;
            font-weight: 700;
        }

        .suggestion-box p {
            line-height: 1.7;
            opacity: 0.95;
        }

        /* Calendar Styles */
        .calendar-container {
            background: var(--white);
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 30px rgba(17, 168, 210, 0.12);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .calendar-nav-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            transition: transform 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .calendar-nav-btn:hover {
            transform: scale(1.1);
        }

        .calendar-month {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
        }

        .calendar-day-header {
            text-align: center;
            font-weight: 600;
            color: var(--primary);
            padding: 12px;
            font-size: 13px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
            font-weight: 500;
            position: relative;
            color: var(--text-dark);
            gap: 2px;
            padding: 4px;
        }

        .calendar-day-num {
            font-size: 14px;
            line-height: 1;
        }

        .calendar-mood-icon {
            width: 18px;
            height: 18px;
            object-fit: contain;
            border-radius: 4px;
        }

        .calendar-mood-emoji {
            font-size: 12px;
            line-height: 1;
        }

        .calendar-day:hover {
            background: rgba(17, 168, 210, 0.1);
            transform: scale(1.05);
        }

        .calendar-day.today {
            background: var(--primary);
            color: var(--white);
            font-weight: 700;
        }

        .calendar-day.has-mood {
            background: var(--primary-light);
            color: var(--white);
            font-weight: 600;
        }

        .calendar-day.other-month {
            opacity: 0.3;
        }

        /* Modal Styles */
        .mood-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .mood-modal-content {
            background: var(--white);
            border-radius: 24px;
            padding: 35px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .mood-modal-close {
            position: absolute;
            top: 18px;
            right: 18px;
            background: rgba(17, 168, 210, 0.1);
            border: none;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease, color 0.2s ease;
            color: var(--primary);
        }

        .mood-modal-close:hover {
            background: var(--primary);
            color: var(--white);
        }

        

        /* Calendar Styles */
        .calendar-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 40px rgba(17, 168, 210, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .calendar-nav-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(17, 168, 210, 0.3);
        }

        .calendar-nav-btn:hover {
            transform: scale(1.15);
            box-shadow: 0 8px 25px rgba(17, 168, 210, 0.4);
        }

        .calendar-month {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
        }

        .calendar-day-header {
            text-align: center;
            font-weight: 600;
            color: var(--primary);
            padding: 12px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
            position: relative;
            color: var(--text-dark);
        }

        .calendar-day:hover {
            background: rgba(17, 168, 210, 0.1);
            transform: scale(1.1);
            color: var(--primary);
        }

        .calendar-day.today {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(17, 168, 210, 0.4);
            animation: todayPulse 2s ease-in-out infinite;
        }

        @keyframes todayPulse {
            0%, 100% { box-shadow: 0 4px 15px rgba(17, 168, 210, 0.4); }
            50% { box-shadow: 0 4px 25px rgba(17, 168, 210, 0.6); }
        }

        .calendar-day.has-mood {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            color: var(--white);
            font-weight: 600;
        }

        .calendar-day.has-mood::after {
            content: '';
            position: absolute;
            bottom: 6px;
            width: 5px;
            height: 5px;
            background: var(--white);
            border-radius: 50%;
        }

        .calendar-day.other-month {
            opacity: 0.3;
        }

        /* Modal Styles */
        .mood-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(17, 168, 210, 0.3);
            backdrop-filter: blur(8px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .mood-modal-content {
            background: var(--white);
            border-radius: 28px;
            padding: 35px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px) scale(0.95);
                opacity: 0;
            }
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .mood-modal-close {
            position: absolute;
            top: 18px;
            right: 18px;
            background: rgba(17, 168, 210, 0.1);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: var(--primary);
        }

        .mood-modal-close:hover {
            background: var(--primary);
            color: var(--white);
            transform: rotate(90deg);
        }

        
    </style>
</head>
<body>
    @include('layouts.header')

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('suggestion'))
            <div class="alert alert-info suggestion-box">
                <h3>💡 Saran untuk Anda:</h3>
                <p>{{ session('suggestion') }}</p>
            </div>
        @endif

        @yield('content')
    </div>

    @include('layouts.footer')

    @yield('scripts')
</body>
</html>
