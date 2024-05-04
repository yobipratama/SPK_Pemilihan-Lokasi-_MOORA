<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            padding: 0;
            font-size: 24px;
            color: #333;
        }
        .ranking {
            margin-top: 20px;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1 class="header">{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th>Desa</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rangking as $data)
            <tr>
                <td>{{ $data[0] }}</td>
                <td>{{ $data[1] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="ranking">
        <p>Hasil rangking tertinggi: {{ $rangking[0][0] }}</p>
        <p>Nilai: {{ $rangking[0][1] }}</p>
    </div>
</body>
</html>