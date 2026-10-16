<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify OTP | RP Jewellers</title>

    <link rel="stylesheet" href="{{ secure_asset('css/verify-otp.css') }}">
</head>

<body>

    <div class="otp-container">

        <div class="otp-card">

            <div class="otp-icon">
                <i>✉</i>
            </div>

            <h2>Verify Your Email</h2>

            <p class="otp-description">
                We have sent a 6-digit verification code to your email address.
            </p>

            @if(session('success'))
                <div class="alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert error">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('otp.verify.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="otp">Enter OTP</label>

                    <input
                        type="text"
                        name="otp"
                        id="otp"
                        maxlength="6"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                        placeholder="Enter 6-digit OTP"
                        required
                    >
                </div>

                <button type="submit" class="verify-btn">
                    Verify OTP
                </button>
            </form>

            <div class="resend-section">

                <p>Didn't receive the OTP?</p>

                <form action="{{ route('otp.resend') }}" method="POST">
                    @csrf

                    <button type="submit" class="resend-btn">
                        Resend OTP
                    </button>
                </form>

            </div>

        </div>

    </div>

</body>
</html>