<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            margin: 0;
        }

        .head {
            width: 100%;
            height: 100px;
            background-color: black;
            margin-top: 0px;
            color: aliceblue;
        }

        .textt {
            font-size: 16px;
            font-family: 'Courier New', Courier, monospace;
            background-color: #ffd60a;
            padding: 16px 20px;
            width: 100%;
            height: 100px;
        }
    </style>
</head>

<body>
    <table class="head">
        <tr>
            <td>
                <h3>Daily Task Report</h3>
            </td>
        </tr>
    </table>
    <table width="100%" border="1" class="textt">
        <tr>
            <td align="center">id</td>
            <td align="center">code</td>
            <td align="center">name</td>
        </tr>
        @forelse ($data as $dataemail)
        <tr>
            <td align="center">{{ $dataemail->id }}</td>
            <td align="center">{{ $dataemail->task_code }}</td>
            <td align="center">{{ $dataemail->task_name }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" align="center">No data available</td>
        </tr>
        @endforelse
    </table>
</body>

</html>
