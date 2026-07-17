<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP JogjaTouch</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #FBF9F6;
            margin: 0;
            padding: 0;
            color: #1E1B19;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(30, 27, 25, 0.05);
        }
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        h2 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .highlight {
            color: #E35D25;
            font-style: italic;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(30, 27, 25, 0.7);
            margin-bottom: 30px;
            text-align: center;
        }
        .otp-container {
            background-color: #FBF9F6;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            border: 1px dashed rgba(227, 93, 37, 0.3);
        }
        .otp-code {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 6px;
            color: #E35D25;
            margin: 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: rgba(30, 27, 25, 0.4);
            line-height: 1.5;
        }
        .footer strong {
            color: #E35D25;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <!-- Logo placeholder or text logo -->
            <div class="logo-container">
                <h3 style="font-size: 24px; font-weight: bold; margin: 0; color: #1E1B19;">
                    Jogja<span class="highlight">touch</span>
                </h3>
            </div>

            @if ($context === 'reset')
                <h2>Permintaan <span class="highlight">Reset Password</span></h2>
                <p>Kami menerima permintaan untuk mereset password akun JogjaTouch Anda. Gunakan kode OTP di bawah ini untuk melanjutkan proses reset password:</p>
            @else
                <h2>Selesaikan <span class="highlight">Pendaftaran Anda</span></h2>
                <p>Terima kasih telah bergabung dengan JogjaTouch! Tinggal satu langkah lagi, gunakan kode OTP di bawah ini untuk memverifikasi pendaftaran akun Anda:</p>
            @endif

            <!-- OTP Code -->
            <div class="otp-container">
                <h1 class="otp-code">{{ $otp }}</h1>
            </div>

            <p style="font-size: 14px; font-weight: 500; color: rgba(30, 27, 25, 0.6); margin-bottom: 20px;">
                Kode OTP ini hanya berlaku selama <strong>5 menit</strong>.<br>
                Demi keamanan, mohon <strong>jangan bagikan</strong> kode ini kepada siapa pun, termasuk pihak JogjaTouch.
            </p>

            <hr style="border: 0; border-top: 1px solid rgba(30, 27, 25, 0.05); margin: 30px 0;">

            <div class="footer">
                <p style="font-size: 12px; margin: 0;">Email ini dikirim otomatis oleh sistem keamanan <strong>JogjaTouch</strong>.</p>
            </div>
        </div>
    </div>
</body>
</html>
