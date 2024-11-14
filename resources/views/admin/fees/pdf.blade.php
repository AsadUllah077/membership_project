<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fees Report</title>
</head>
<body>
    <h1>Fees Report</h1>
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>CNIC</th>
                <th>Status</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fees as $fee)
                <tr>
                    <td>{{ $fee->id }}</td>
                    <td>{{ $fee->member->cnic }}</td>
                    <td>{{ $fee->status }}</td>
                    <td>{{ $fee->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
