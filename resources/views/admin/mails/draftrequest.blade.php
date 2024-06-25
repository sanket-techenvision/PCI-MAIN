<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['subject'] }}</title>
    <style>
        p{
            font-size: large;
        }
    </style>
</head>
<body>
    <h2>New Request Submitted</h2>
    <p>Dear Admin,</p>
    <p>A new draft/service/request has been submitted for approval. Here are the details:</p>
    
    <ul>
        <li><strong>Requested For:</strong> {{ $details['requested_by'] }}</li>
        <li><strong>Submitted By:</strong> {{ $details['submitted_by'] }}</li>
    </ul>

    <p>Please review and take necessary action.</p>
    <p>Thank you.</p>
</body>
</html>

