<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>User Data</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Total Active</th>
                <th>Total Inactive</th>
                <th>Total Dues</th>
                <th>Total Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->t_active }}</td>
                    <td>{{ $user->t_inactive }}</td>
                    <td>{{ $user->total_dues }}</td>
                    <td>{{ $user->total_paid }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
