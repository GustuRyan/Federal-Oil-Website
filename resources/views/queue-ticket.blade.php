<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        .container {
            width: 100%;
        }

        .header {
            overflow: hidden;
            /* Clear float */
        }

        .header-left {
            float: left;
            width: 50%;
        }

        .header-right {
            float: right;
            width: 50%;
        }

        .line {
            width: 100%;
            height: 2px;
            background: black;
            margin: 10px 0;
        }
    </style>

</head>

<body>
    <table style="width: 100%; height: 100vh; text-align: center; vertical-align: middle; border-collapse: collapse;">
        <tr>
            <td align="center" style="font-size: 80px; font-weight: bold;">
                <h1>{{ $data['current_queue'] ?? 'N/A' }}</h1>
            </td>
        </tr>
    </table>
</body>

</html>
