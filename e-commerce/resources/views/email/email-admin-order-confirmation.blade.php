<div style="display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            padding: 50px;
            color: #0e0e0e;
">
    <div>
        <p><b>New Order from {{$data['name']}},</b></p>
        <p>
            Hi admin you got a new order.<br>
            Please see the order and shipment the order as soon as possible<br>
            <b>Order No : # {{$data['order_no']}}</b><br>
            you can see your order flowing this link</p><br>

        <a href="http://www.billboardbd.com/order-invoice/{{$data['order_no']}}">
            Show Invoice </a><br>
        <small>Note: Login needed to see your invoice</small>
        <p>Thanks<br>
            BillBoardBD<br>
        </p>
    </div>
</div>
