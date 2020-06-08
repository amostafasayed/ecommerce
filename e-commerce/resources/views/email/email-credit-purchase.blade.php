<div style="display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            padding: 50px;
            color: #0e0e0e;
">
    <div>
        <p><b>Hi {{$data['name']}},</b></p>
        <p>Thank you for your credit purchases. <br>
            We received from you a credit purchases. Now you can see we added credit on your account<br>
            If you need any help please call us. Your <b>Purchase No : # {{$data['order_no']}}</b><br>
            you can see your credit purchase flowing this link</p><br>

        <a href="http://www.billboardbd.com/generate-invoice/{{$data['order_id']}}">
            Show Invoice </a><br>
        <small>Note: Login needed to see your invoice</small>
        <p>Thanks<br>
            BillBoardBD<br>
        </p>
    </div>
</div>
