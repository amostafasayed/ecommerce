<div style="display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            padding: 50px;
            color: #0e0e0e;
">
    <div>
        <p><b>Hi {{$data['name']}},</b></p>
        <p>Thank you for your order. <br>
            We received your order and we will call you and start processing them right away.<br>
            After confirmation via phone call we will send your product with in short time.<br>
            If you need any help please call us. Your <b>Order No : # {{$data['order_no']}}</b><br>
            you can see your order flowing this link</p><br>

        <a href="http://www.billboardbd.com/order-invoice/{{$data['order_no']}}">
           Show Invoice </a><br>
        <small>Note: Login needed to see your invoice</small>
        <p>Thanks<br>
            BillBoardBD<br>
        </p>
    </div>
</div>
