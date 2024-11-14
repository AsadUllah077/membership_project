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

                <th>Bank Name</th>
                <th>CNIC</th>
                <th>Receipt Date</th>
                <th>Receipt Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->member->ifmp_id }}</td>
                    <td>{{ $payment->bank_name }}</td>
                    <td>{{ $payment->member->cnic }}</td>
                    <td>{{ $payment->reciept_date }}</td>
                    <td>{{ $payment->reciept_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
