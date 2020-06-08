<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
            <li>
                <a href="#"><i class="fa fa-cubes"></i> Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/category/create')}}"> Add Category</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/category')}}"> Manage Category</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-gift"></i> Product<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/product/create')}}">Add Product</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/product')}}">Manage Product</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-magic"></i> Auction<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/auction/create')}}">Add Auction</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/auction')}}">Manage Auction</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-magic"></i> Bids<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/manage-bid-history')}}">Manage Bids</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/manage-auto-bid')}}">Manage Auto Bid</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Sale<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
{{--                    <li>--}}
{{--                        <a href="blank.html">Add Sale</a>--}}
{{--                    </li>--}}
                    <li>
                        <a href="{{url('/admin/sales')}}">Manage Sale</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users"></i> Customer<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
{{--                    <li>--}}
{{--                        <a href="blank.html">Add Customer</a>--}}
{{--                    </li>--}}
                    <li>
                        <a href="{{url('/admin/customer')}}">Manage Customer</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-money"></i> Shipping Cost<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/shipping-cost/create')}}">Add Shipping Cost</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/shipping-cost')}}">Manage Shipping Cost</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bullhorn"></i> Promotion<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/promotion/create')}}">Add Promotion</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/promotion')}}">Manage Promotion</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-list-alt"></i> Package<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/package/create')}}">Add Package</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/package')}}">Manage Package</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-certificate"></i> CMS<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/cms/create')}}">Add CMS</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/cms')}}">Manage CMS</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
{{--            <li>--}}
{{--                <a href="#"><i class="fa fa-pie-chart"></i> Report<span class="fa arrow"></span></a>--}}
{{--                <ul class="nav nav-second-level">--}}
{{--                    <li>--}}
{{--                        <a href="blank.html">Product Report</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="login.html">Sale Report</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <!-- /.nav-second-level -->--}}
{{--            </li>--}}

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->