<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body style="margin: 0; padding: 40px; font-family: Arial, sans-serif; background-color: #f5f5f5; color: #333;">
    <table align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 20px auto; background: #fff; border-radius: 7px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding:40px;">
        <tr>
            <td style="text-align: center;">
                <h1 style="font-size: 25px; margin-top: 50px;">Tech<span style="color: #9147F2;">X</span>pertz</h1>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <h1 style="font-size: 30px; font-weight:600;">Verify Your Email Address</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 50px; text-align: center; font-size: 14px; line-height: 1.6;">
                Please confirm that you want to use this email address for your TechXpertz account. Once verified, you will gain full access to our platform and services.
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center;">
                <a href="{{ $url }}" style="display: inline-block; padding: 10px 30px; font-size: 16px; color: #fff; background-color: #7B5CAD; text-decoration: none; border-radius: 5px; cursor: pointer;">Verify My Email</a>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center; font-size: 14px;">
                Or paste this link into your browser:<br>
                <a style="color: #9147F2;">{{ $url }}</a>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 0 50px; text-align: center; font-size: 12px; color: #919191;">
                If you did not request this email, no further action is required.<br>
                Thank You!,<br>TechXpertz
            </td>
        </tr>
    </table>
</body>
</html>
