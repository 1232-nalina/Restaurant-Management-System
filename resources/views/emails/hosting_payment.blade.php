{{-- test
<!DOCTYPE html>
<html>
<head>
    <title>Your hosting will expire soon</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }
        }

        .wrapper {
            width: 100%;
            background-color: #f5f5f5;
        }

        .header {
            background-color: #00AFE9;
            color: #fff;
            padding: 32px;
            text-align: center;
        }

        .logo {
            max-width: 180px;
            margin: 0 auto;
        }

        .content {
            padding: 32px;
        }

        .button {
            display: inline-block;
            padding: 8px 22px;
            background-color: #00AFE9;
            margin-top: 10px;
            margin-bottom: 10px;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;

        }

        .button:hover {
            background-color: #002244;
        }

        .footer {
            background-color: #00AFE9;
            color: #fff;
            padding: 16px;
            text-align: center;
            font-size: 14px;
        }

        .container {
            table-layout: fixed;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <table class="container" cellpadding="0" cellspacing="0">
            <tr>
                <td class="header">

                    <h1>Your hosting will expire soon</h1>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <p>Dear {{ $client }},</p>
                    <p>Your hosting will expire on {{ $expiryDate }}. Please ensure that you renew your hosting before this date to avoid any disruptions to your website.</p>
                    <p>To renew your hosting, click the button below:</p>
                    <p><a href="#" class="button">Renew Hosting</a></p>
                    <p>Thank you for choosing our services.</p>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    This is an automated email from <a href="https://communicate.com.np/" target="_blank">Communicate Technology</a>. Please do not reply to this message.
                </td>
            </tr>
        </table>
    </div>
</body>
</html> --}}
{{ $payment->payment_amount }}
