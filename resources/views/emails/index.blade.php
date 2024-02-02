<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['subject'] }}</title>
</head>
<body>

    <h1>{{ $data['subject'] }}</h1>

    <p>Hello {{ $data['user']['name'] }},</p>

    <p>Thank you for your order! Here are your order details:</p>

    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Product</th>
                <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Quantity</th>
                <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Price</th>
                <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Sale</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['cart'] as $item)
                <tr>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $item['name'] }}</td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $item['quantity'] }}</td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $item['price'] }}</td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $item['sale'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><strong>Total:</strong></td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><strong>{{ $data['totalAmount'] }}</strong></td>
            </tr>
        </tbody>
    </table>

    <p>If you have any questions, please contact our support.</p>
</body>
</html>
