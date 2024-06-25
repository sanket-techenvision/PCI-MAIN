<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['subject'] }}</title>
    <style>
        p {
            font-size: large;
        }
    </style>
</head>

<body>
    <h2>New Draft Request Submitted</h2>
    <p>Dear {{ $details['requested_by'] }},</p>
    <p>We have received your draft/service/request submission. Here are the details:</p>

    <ul>
        <li><strong>Requested For:</strong> {{ $details['requested_by'] }}</li>
        <li><strong>Submitted By:</strong> {{ $details['submitted_by'] }}</li>
    </ul>

    <p>We will review your request and take necessary actions.</p>
    <p>Thank you.</p>
</body>

</html>
