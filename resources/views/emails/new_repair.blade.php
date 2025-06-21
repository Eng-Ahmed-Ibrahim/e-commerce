<html>
<head>
    <title>New Repair Request </title>
  </head>
<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
    <thead>
      <tr>
        <th colspan="2" style="text-align:center;font-weight:500;width:100%;">
          <h1>New Repair Request !!!</h1>
        </th>
      </tr>
      <tr>
        <th style="text-align:left;"><img style="max-width: 150px;" src="https://concordapi.mass-fluence.com/assets/assets/images/logo.png" alt="Concord"></th>
        <th style="text-align:right;font-weight:400;">{{ $data["repair"]["created_at"]->format('dS M, Y') }}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td  colspan="2" style="height:35px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Repair status</span><b style="color:red;font-weight:normal;margin:0">Not Seen</b></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px"> ID</span> #{{$data["repair"]["id"]}}</p>
        </td>
      </tr>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td  colspan="1" style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> {{$data["repair"]["name"]}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> {{$data["repair"]["email"]}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> {{$data["repair"]["phone"]}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Whatsapp</span> {{$data["repair"]["whatsapp"]}}</p>
        </td>
        <td  colspan="1" style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Product</span> {{$data["repair"]["product"]}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Serial Number</span> {{$data["repair"]["serial_number"]}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span> {{$data["repair"]["address"]}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">City</span> {{$data["repair"]["city"]}}</p>
        </td>
      </tr>

    </tbody>
    <tfooter>
	<tr>
        <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
          <strong style="display:block;margin:0 0 10px 0;">Regards</strong> Concord<br> {{$data["company_information"]["address"]}} <br><br>
          <b>Phone:</b> {{$data["company_information"]["phone"]}}<br>
          <b>Email:</b> {{$data["company_information"]["email"]}}
        </td>
      </tr>
    </tfooter>
  </table>
</body>

</html>