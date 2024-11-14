<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Membership List</h2>
    <table>
        <thead>
            <tr>
                <th>IFMP-ID</th>
                <th>Name</th>
                <th>CNIC</th>
                <th>Certification</th>
                <th>Status</th>
                <th>Dues</th>
                <th>Balance</th>
                <th>M-Date</th>
                <th>Valid Till</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($memberships as $member)
                <tr>
                    <td>{{ $member->ifmp_id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->cnic }}</td>
                    <td>{{ $member->certificates ? $member->certificates[0]->certification : 'N/A' }}</td>
                    <td>{{ $member->status }}</td>
                    <td>{{ $member->dues }}</td>
                    <td>{{ $member->fees ? $member->fees->amount : 'N/A' }}</td>
                    <td>{{ $member->m_date }}</td>
                    <td>{{ $member->certificates ? $member->certificates[0]->valid_till : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
