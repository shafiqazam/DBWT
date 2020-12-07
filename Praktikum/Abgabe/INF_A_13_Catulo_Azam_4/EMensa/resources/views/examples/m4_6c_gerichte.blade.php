<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerichte</title>
</head>
<body>
        @if($gerichte->isEmpty())
            <h1>Es sind keine Getränke vorhanden</h1>
        @else
            <ol>
            @foreach($gerichte as $gericht)
                <li>{{$gericht->name." ".$gericht->preis_intern.'€'}}</li>
            @endforeach
            </ol>

        @endif
</body>
</html>
