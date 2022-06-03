<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Mail</title>
</head>

<body>
   @php

   @endphp
    <div class="text-center">

        <p>Hi {{ $details['name'] }},</p>
        <p>{{ $details['body_message'] }} </p>
        <br>
        <p>Thank You</p>
    </div>
</body>

</html>
