<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Interview Notice</title>
    <style type="text/css">
        body {
            margin: 0;
            background-color: #f0f0f0;
            line-height: 20.8px;
            font-size: 14px;
        }
        table {
            border-spacing: 0;
        }
        td {
            padding: 0;
        }
        img {
            border: 0;
        }
        p {
            margin-block-start: 1.2em;
            margin-block-end: 1.2em;
        }
        button {
            color: #fff;
            background-color: #EC2224;
            padding: .5rem 1rem;
            border-radius: .5rem;
            border: 3px solid #ffa4a4;
            font-size: 16px;
            font-weight: bold;
        }
        hr {
            margin-block-start: 0;
            margin-block-end: 0;
            margin-inline-start: 0;
            margin-inline-end: 0;
            overflow: hidden;
            border-style: none;
            border-width: 0;
        }
        h2 {
            margin-block-start: 0.6em;
            margin-block-end: 0.7em;
        }
        .wrapper {
            width: 100%;
            table-layout: auto;
            padding-bottom: 60px;
        }
        .main {
            background-color: #fff;
            margin: 0 auto 20px auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            font-family: "Montserrat", sans-serif;
        }
    </style>
</head>
<body>
    <center class="wrapper">
        <table class="main" width="100%">
            <tr>
                <td>
                    <center style="background-color: #38F038">
                        <!-- ASI Logo -->
                        <img src="https://i.imgur.com/eCeuMc7.png" title="Logo" alt="VSU Pasalubong Center Logo" style="height: 50px; margin: 12px 0 8px 0;" />
                    </center>
                    <hr style="color: #38F038; height:5px; background-color: #38F038" />
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <!-- Email Title -->
                        <h2 style="color: #ff0000">New Order Request</h2>
                    </center>
                    <hr style="height: 1px; background-color: #d5d5d5" />
                </td>
            </tr>
            <tr>
                <!-- Greetings -->
                <td style="padding:10px 10px 0 10px;">
                    A new order request has been requested for the product: {{$orderData['name']}}</b>,
                </td>
            </tr>
            <tr>
                <td>
                    <ul>
                        <li>Quantity of order: {{$orderData['quantity']}} {{$orderData['unit']}}/s</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Payment will be made on delivery</p>
                </td>
            </tr>
        </table>
        <!-- This email is generated, do not reply -->
        <center style="width: 600px; line-height: 15.4px;">
            <i style="color: gray; font-size: 12px;">This is an automated email. Please do not reply directly to this message.</i>
            <hr style="height: 1px; width: 80%; background-color: #d5d5d5; margin: 3px 0" />
            <i style="color: gray; font-size: 12px;">© 2023 VSU Pasalubong Center All Rights Reserved.</i>
        </center>
    </center>
</body>
</html>