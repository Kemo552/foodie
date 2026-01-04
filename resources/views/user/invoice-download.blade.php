<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .navbar-brand {
            font-family: 'Dancing Script', cursive;
        }

        h2 {
            margin-bottom: 5px;
        }

        .header {
            background: #222;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        .section {
            margin-top: 20px;
        }

        .user-info div {
            margin-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #333;
            color: #fff;
        }

        .total {
            margin-top: 15px;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            padding: 10px;
            background: #222;
            color: #fff;
            font-size: 10px;
        }

        .text-right {
            text-align: right;
        }

        brand-color {
            color: #ffcb80;
        }

        primary-color {
            color: #91dff7;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2 class="navbar-brand">Invoice</h2>
    </div>

    <div class="section">
        <h2 class="navbar-brand primary-color">User Information</h2>
        <hr>
        <div class="user-info">
            <div>Customer name: <strong class="primary-color">{{ auth()->user()->name }}</strong></div>
            <div>User name: <u>{{ auth()->user()->username }}</u></div>
            <div>Customer email: <u>{{ auth()->user()->email }}</u></div>
            <div>Address: <u>{{ auth()->user()->address }}</u></div>
        </div>
    </div>
    <br>
    <div class="section">
        <h2 class="navbar-brand primary-color">Order Information</h2>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order No</th>
                    <th>Item</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->order_no }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->total_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total navbar-brand primary-color">
            Total Cost: {{ $total_cost }} $
        </div>
    </div>

    <div class="footer">
        <div>Issued on: {{ $issued_on }}</div>
        <div class="text-right">
            Thanks for choosing <span class="navbar-brand brand-color">{{ config('app.name') }}</span>
        </div>
    </div>

</body>

</html>
