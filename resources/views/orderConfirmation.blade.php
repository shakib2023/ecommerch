<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invitation</title>

    <style>
        body {font-family: Helvetica, sans-serif;font-size:13px;}
        .container{max-width: 680px; margin:0 auto;}
        .logotype{background:#000;color:#fff;width:75px;height:75px;  line-height: 75px; text-align: center; font-size:11px;}
        .column-title{background:#eee;text-transform:uppercase;padding:15px 5px 15px 15px;font-size:11px}
        .column-detail{border-top:1px solid #eee;border-bottom:1px solid #eee;}
        .column-header{background:#eee;text-transform:uppercase;padding:15px;font-size:11px;border-right:1px solid #eee;}
        .row{padding:7px 14px;border-left:1px solid #eee;border-right:1px solid #eee;}
        .alert{background: #ffd9e8;padding:20px;margin:20px 0;line-height:22px;color:#333}
        .socialmedia{background:#eee;padding:20px; display:inline-block}
    </style>

</head>
<body>
<div class="container">

    <table width="100%">
        <tr>
            <td width="75px"><div class="logotype">Copmany</div></td>
            <td width="300px" style="background: #fee977;border-left:15px solid #fff; padding-left:30px;font-size:26px;font-weight:bold;letter-spacing:-1px;">Order confirmation</td>
            <td></td>
        </tr>
    </table>
    <h3>Your contact details</h3>
    <table width="100%" style="border-collapse: collapse;">
        <tr>
            <td width="180px" class="column-title">E-post<td>
            <td class="column-detail">{{$sendingInformation['email']}}<td>
        </tr>
        <tr>
            <td class="column-title">First & Last name<td>
            <td class="column-detail">John Doe<td>
        </tr>
        <tr>
            <td class="column-title">Company name<td>
            <td class="column-detail">The John Doe Ltd.<td>
            </td>
        <tr>
            <td class="column-title">Phone<td>
            <td class="column-detail">{{$sendingInformation['phone']}}<td>
        </tr>
    </table>
    <h3>Your products</h3>

    <table width="100%" style="border-collapse: collapse;border-bottom:1px solid #eee;">
        <tr>
            <td width="20%" class="column-header">No</td>
            <td width="40%" class="column-header">Name</td>
            <td width="30%" class="column-header">Description</td>
            <td width="10%" class="column-header">Actual Price</td>
            <td width="10%" class="column-header">Qty</td>
            <td width="10%" class="column-header">Total Price</td>
        </tr>
        <tr>
            <td class="row">01</td>
            <td class="row">{{$sendingInformation['productName']}}</td>
            <td class="row">{{$sendingInformation['productDescription']}}</td>
            <td class="row">{{$sendingInformation['product_actual_price']}} /=</td>
            <td class="row">{{$sendingInformation['qty']}}</td>
            <td class="row">{{$sendingInformation['price']}} /=</td>

        </tr>

    </table>
    <div class="alert">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.	</div>
    <div class="socialmedia">Follow us online <small>[FB] [INSTA]</small></div>
</div><!-- container -->
</body>
</html>
