<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Hello {{$user->name}}</p>
    <p>We have successfully received your request.</p>
    <br/>

    <table style="width: 600px; text-align:right">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Price</th>
                <th>Number of Copies</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subTotal = 0
            @endphp
            @foreach($order as $product)
                <tr>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->price }}$</td>
                    <td>{{ $product->pivot->number_of_copies }}</td>
                    <td>{{ $product->price * $product->pivot->number_of_copies}}$</td>
                    @php
                        $subTotal += $product->price * $product->pivot->number_of_copies
                    @endphp
                </tr>
            @endforeach
            <hr>
            <tr>
                <td colspan="3" style="border-top:1px solid #ccc;"></td>
                <td style="font-size:15px;font-weight:bold;border-top:1px solid #ccc;">Total : ${{$subTotal}}</td>
            </tr>
        </tbody>
    </table>  
    
</body>
</html>