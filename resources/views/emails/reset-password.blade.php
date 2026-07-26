<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — {{ $appName }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Inter', sans-serif;
            background: #f3f4f6;
            color: #1a1a2e;
            line-height: 1.6;
        }

        .wrapper {
            max-width: 560px;
            margin: 40px auto;
            padding: 0 16px 40px;
        }

        /* ── Header / Brand ── */
        .header {
            text-align: center;
            padding: 28px 0 20px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            background: #4a9d5f;
            border-radius: 8px;
            border: 2px solid #1a1a2e;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .brand-name {
            font-size: 20px;
            font-weight: 900;
            color: #1a1a2e;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── Card ── */
        .card {
            background: #ffffff;
            border: 3px solid #1a1a2e;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 6px 6px 0 #1a1a2e;
        }

        .card-top {
            background: linear-gradient(135deg, #4a9d5f 0%, #2d7a47 100%);
            padding: 32px 36px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-top::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
            top: -80px;
            right: -50px;
        }

        .card-top::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            bottom: -40px;
            left: -20px;
        }

        .card-top-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, .15);
            border: 2px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }

        .card-top h1 {
            color: #fff;
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 6px;
            position: relative;
            z-index: 1;
        }

        .card-top p {
            color: rgba(255, 255, 255, .8);
            font-size: 13px;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 32px 36px;
        }

        .greeting {
            font-size: 15px;
            color: #555;
            margin-bottom: 16px;
        }

        .greeting strong {
            color: #1a1a2e;
        }

        .message {
            font-size: 14px;
            color: #666;
            margin-bottom: 24px;
            line-height: 1.7;
        }

        /* ── CTA Button ── */
        .btn-wrap {
            text-align: center;
            margin: 28px 0;
        }

        .btn {
            display: inline-block;
            background: #4a9d5f;
            color: #fff !important;
            text-decoration: none;
            font-weight: 800;
            font-size: 15px;
            padding: 14px 36px;
            border-radius: 10px;
            border: 2.5px solid #1a1a2e;
            box-shadow: 4px 4px 0 #1a1a2e;
            letter-spacing: 0.3px;
            transition: box-shadow .15s;
        }

        /* ── URL fallback ── */
        .url-fallback {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 12px 16px;
            margin: 20px 0;
        }

        .url-fallback p {
            font-size: 12px;
            color: #888;
            margin-bottom: 6px;
        }

        .url-fallback a {
            font-size: 11px;
            color: #4a9d5f;
            word-break: break-all;
            font-family: 'Courier New', monospace;
        }

        /* ── Warning ── */
        .warning {
            background: #fff8e1;
            border: 2px solid #f5a623;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            color: #856404;
            margin: 20px 0;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .warning-icon {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ── Divider ── */
        hr {
            border: none;
            border-top: 2px dashed #e9ecef;
            margin: 24px 0;
        }

        /* ── Footer ── */
        .card-footer {
            background: #f8f9fa;
            border-top: 2px solid #e9ecef;
            padding: 20px 36px;
        }

        .footer-note {
            font-size: 12px;
            color: #999;
            text-align: center;
            line-height: 1.6;
        }

        .footer-note a {
            color: #4a9d5f;
            text-decoration: none;
        }

        .footer-brand {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: #aaa;
        }

        .footer-brand strong {
            color: #888;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        {{-- Brand header --}}
        <div class="header">
            <span class="brand">
                <span class="brand-name">{{ $appName }}</span>
            </span>
        </div>

        {{-- Main card --}}
        <div class="card">

            <div class="card-top">
                <h1>Reset Password Kamu</h1>
                <p>Permintaan reset password diterima</p>
            </div>

            <div class="card-body">
                <p class="greeting">Hei, <strong>{{ $user->name }}</strong>! 👋</p>

                <p class="message">
                    Kami menerima permintaan untuk mereset password akun
                    <strong>{{ $appName }}</strong>-mu yang terdaftar dengan email
                    <strong>{{ $user->email }}</strong>.<br><br>
                    Klik tombol di bawah untuk membuat password baru. Link ini berlaku selama
                    <strong>{{ $expireIn }} menit</strong>.
                </p>

                <div class="btn-wrap">
                    <a href="{{ $url }}" class="btn">🔑 &nbsp;Reset Password Sekarang</a>
                </div>

                <div class="warning">
                    <span class="warning-icon">⚠️</span>
                    <span>
                        Jika kamu <strong>tidak</strong> meminta reset password ini, abaikan saja email ini.
                        Password kamu tidak akan berubah.
                    </span>
                </div>

                <hr>

                <div class="url-fallback">
                    <p>Tombol tidak bisa diklik? Salin link berikut ke browser kamu:</p>
                    <a href="{{ $url }}">{{ $url }}</a>
                </div>
            </div>

            <div class="card-footer">
                <p class="footer-note">
                    Email ini dikirim secara otomatis dari <strong>{{ $appName }}</strong>.
                    Jangan membalas email ini.<br>
                    Butuh bantuan? Hubungi kami di
                    <a
                        href="mailto:support{{ '@' . strtolower($appName) }}.id">support{{ '@' . strtolower($appName) }}.id</a>
                </p>
            </div>
        </div>

        <div class="footer-brand">
            © {{ date('Y') }} <strong>{{ $appName }}</strong> · Semua hak dilindungi
        </div>

    </div>
</body>

</html>
