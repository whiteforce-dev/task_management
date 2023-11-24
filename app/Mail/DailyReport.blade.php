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
                <h3>Enquiry Data</h3>
            </td>
        </tr>
    </table>
    <table class="textt" border="1">
        <tr>
            <td>Name: {{ $name }}</td>
        </tr>
        <tr>
            <td>Mobile No: {{ $mobile_no }}</td>
        </tr>
        <tr>
            <td>SMS: {{ $sms }}</td>
        </tr>
    </table>
</body>
</html>
