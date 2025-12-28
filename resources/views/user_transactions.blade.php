<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ikmēneša patēriņi</title>
</head>
<body>
    @foreach($user_transactions as $transaction)
    <p>{{ $transaction->type }}</p>
    <p>{{ number_format($transaction->amount_cents/100, 2, '.') }}</p>
    <p>{{ $transaction->currency }}</p>
    <p>{{ $transaction->category }}</p>
    <p>{{ $transaction->occurred_on }}</p>
    <p>{{ $transaction->note}}</p>
    @endforeach
</body>
</html>