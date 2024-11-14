<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certification List</title>
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
    <h2>Certification List</h2>
    <table>
        <thead>
            <tr>
                <th>IFMP-ID</th>
                <th>CNIC</th>
                <th>Category</th>
                <th>Certification</th>
                <th>Valid Till</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($certifications as $certification)
                <tr>
                    <td>{{ $certification->member->ifmp_id }}</td>
                    <td>{{ $certification->member->cnic }}</td>
                    <td>{{ $certification->category }}</td>
                    <td>{{ $certification->certification }}</td>
                    <td>{{ $certification->valid_till }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
