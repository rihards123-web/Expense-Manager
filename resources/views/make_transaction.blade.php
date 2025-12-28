<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('make.transaction' ) }}" method="POST">
        @csrf
        @method('POST')
        <div>
            <label for="type">Expense type</label>
            <select name="type" id="">
                <option value="expense">Expense</option>
                <option value="income">Income</option>
            </select>

            <label for="amount">Amount</label>
            <input type="text" name="amount" value="{{ old('amount') }}">

            <label for="category">Category</label>
            <input type="text" name="category" id="">

            <label for="occurred_on">Occured on</label>
            <input type="date" name="occurred_on">

            <label for="">Note</label>
            <input type="text" name="note" id="" placeholder="Can be empty...">

            <button type="submit">Save</button>

            @if ($errors->any()) 
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
        </div>
    </form>
</body>
</html>