<!DOCTYPE html>
<html>
<head>
    <title>Mail from PCI</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    @if ($details['notice'] )
        <p>{{$details['notice']}}</p>
    @endif
    <h3>{{ $details['body'] }}</h3>
</body>
</html>
