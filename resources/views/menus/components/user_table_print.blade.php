<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'AttenDTI') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.7);
            z-index: 50;
        }

        .modal-content {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 960px;
            height: 95vh;
            overflow-y: auto;
            padding: 24px;
        }

        /* Report Container */
        .laporanTransaksi {
            padding: 32px;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            background: #ffffff;
            color: #000000;
            aspect-ratio: 2480 / 3508;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Header Styles */
        .header-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .header-subtitle {
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }

        .header-section {
            background-color: #2563eb;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }

        /* Footer Styles */
        .footer-row {
            font-size: 12px;
        }

        /* Body Table Styles */
        .body-table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #d1d5db;
        }

        .body-table th,
        .body-table td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }

        .body-table th {
            background-color: #f2f2f2;
        }

        .body-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Modal Add User -->
    <table class="body-table">
        <thead>
            <tr class="bg-gray-200">
                <th>No</th>
                <th>Nomor Identitas</th>
                <th>Nama</th>
                <th>Akun ITB</th>
                <th>Institusi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($users) <= 0)
                <tr>
                    <td colspan="5" class="text-center">Data transaksi kosong</td>
                </tr>
            @else
                @foreach ($users as $user)
                    <tr>
                        <td class="text-center" style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $user->identity_number ? $user->identity_number : '-' }}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->itb_account }}</td>
                        <td>{{ $user->institution ? $user->institution : '-' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
