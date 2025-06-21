<html>

<head>
  <title>New Order </title>
</head>

<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
    <thead>
      <tr>
        <th colspan="2" style="text-align:center;font-weight:500;width:100%;">
          <h1>New Order !!!</h1>
        </th>
      </tr>
      <tr>
        <th style="text-align:left;"><img style="max-width: 150px;" src="https://admin.concordonlinestore.com/assets/images/brand/logo-3.png" alt="Concord"></th>
        <th style="text-align:right;font-weight:400;">{{ $data["order"]["created_at"]->format('dS M, Y') }}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2" style="height:35px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px">
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b style="color:orange;font-weight:normal;margin:0">Pending</b></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Transaction ID</span> #{{$data["order"]["id"]}}</p>
          <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span> {{$data["order"]["total"]}}$</p>
          <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Payment Method</span> {{$data["order"]["payment_method"] =="cash_on_delivery"?"Cash On Delivery" : "Paid by Credit Card" }}</p>
        </td>
      </tr>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td colspan="1" style="width:100%;vertical-align:top">
          <p style="margin:0 0 10px 0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> {{$data["order"]["name"]}}</p>
          <p style="margin:0 0 10px 0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> {{$data["order"]["email"]}}</p>
          <p style="margin:0 0 10px 0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> {{$data["order"]["phone"]}}</p>
        </td>
      </tr>
      <tr>

        <td colspan="1" style="width:100%;vertical-align:top">
          <p style="margin:0 0 10px 0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span> {{$data["order"]["address"]}}</p>
          <p style="margin:0 0 10px 0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">City</span> {{$data["order"]["city"]}}</p>
          <p style="margin:0 0 10px 0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Apartment</span> {{$data["order"]["apartment"]}}</p>
        </td>
      </tr>

      <tr>
        <td colspan="2" style="font-size:20px;">Items</td>
      </tr>
      <tr>
        <tr>
          <td colspan="2">
            <p style="padding:10px;font-size:16px;margin:0;font-weight:bold;">
              <span style="display:block;font-size:13px;font-weight:normal;">
                Product
                <b style="float:right;">Quantity</b>
              </span>
            </p>
          </td>
        </tr>
        @foreach($data["carts"] as $cart)
      <tr>
        <td colspan="2">
          <p style="padding:10px;font-size:14px;margin:0;border:solid 1px #ddd;font-weight:bold;">
            <span style="display:block;font-size:13px;font-weight:normal;">
               {{$cart["product"]->name}} - {{$cart["total"] }}$
              <b style="float:right;"> {{$cart["quantity"]}}X</b>
            </span>
          </p>
        </td>
      </tr>
      @endforeach

      </tr>
    </tbody>
    <tfooter>
      <tr>
        <td colspan="2" style="font-size:14px;">
          <strong style="display:block;margin:0 0 10px 0;">Regards</strong> Concord<br> {{$data["company_information"]["address"]}} <br><br>
          <b>Phone:</b> {{$data["company_information"]["phone"]}}<br>
          <b>Email:</b> {{$data["company_information"]["email"]}}
        </td>
      </tr>
    </tfooter>
  </table>
</body>

</html>