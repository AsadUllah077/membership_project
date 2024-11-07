<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Payments List</h2>
    <table>
        <thead>
            <tr>
                <th>IFMP-ID</th>
                <th>Amount</th>
                <th>Bank Name</th>
                <th>CNIC</th>
                <th>Receipt Date</th>
                <th>Receipt Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->ifmp_id }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->bank_name }}</td>
                    <td>{{ $payment->cnic }}</td>
                    <td>{{ $payment->receipt_date }}</td>
                    <td>{{ $payment->receipt_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
