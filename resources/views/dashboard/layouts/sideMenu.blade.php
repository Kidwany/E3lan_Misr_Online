<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('dashboard/img/user.png')}}" class="img-circle" alt="User Image" style="max-width: 50px !important; height: 50px; object-fit: cover">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{adminUrl()}}">
                    <i class="fa fa-pie-chart"></i><span>Statistics</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green"></small>
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-image"></i>
                    <span>Slider</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('slider/create')}}"><i class="fa fa-plus"></i> Add Slider</a></li>
                    <li><a href="{{adminUrl('slider')}}"><i class="fa fa-edit"></i> Show / Edit Slide</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span>Service</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('service/create')}}"><i class="fa fa-plus"></i> Add Service</a></li>
                    <li><a href="{{adminUrl('service')}}"><i class="fa fa-edit"></i> Show / Edit Service</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-map-signs"></i>
                    <span>Billboards</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('billboard/create')}}"><i class="fa fa-plus"></i> Add Billboard</a></li>
                    <li><a href="{{adminUrl('billboard')}}"><i class="fa fa-edit"></i> Show / Edit Billboard</a></li>
                    <!--<li><a href="{{adminUrl('billboard/map')}}"><i class="fa fa-edit"></i> Maps Billboard</a></li>-->
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-flag"></i>
                    <span>Billboards Types</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('billboard-type/create')}}"><i class="fa fa-plus"></i> Add Billboard Type</a></li>
                    <li><a href="{{adminUrl('billboard-type')}}"><i class="fa fa-edit"></i> Show / Edit Billboard Type</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Client</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('client/create')}}"><i class="fa fa-plus"></i> Add Client</a></li>
                    <li><a href="{{adminUrl('client')}}"><i class="fa fa-edit"></i> Show / Edit Client</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-hospital-o"></i>
                    <span>Suppliers</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('supplier/create')}}"><i class="fa fa-plus"></i> Add Supplier</a></li>
                    <li><a href="{{adminUrl('supplier')}}"><i class="fa fa-edit"></i> Show / Edit Supplier</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-hospital-o"></i>
                    <span>Letter Location</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('letter-location/create')}}"><i class="fa fa-plus"></i> Add Letter Location</a></li>
                    <li><a href="{{adminUrl('letter-location')}}"><i class="fa fa-edit"></i> Show / Edit Letter Location</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-map-pin"></i>
                    <span>Locations</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('parent-location/create')}}"><i class="fa fa-plus"></i> Add Location</a></li>
                    <li><a href="{{adminUrl('parent-location')}}"><i class="fa fa-edit"></i> Show / Edit Location</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-map"></i>
                    <span>Zones</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('child-location/create')}}"><i class="fa fa-plus"></i> Add Zone</a></li>
                    <li><a href="{{adminUrl('child-location')}}"><i class="fa fa-edit"></i> Show / Edit Zone</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-map-marker"></i>
                    <span>Areas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('child-of-child-location/create')}}"><i class="fa fa-plus"></i> Add Area</a></li>
                    <li><a href="{{adminUrl('child-of-child-location')}}"><i class="fa fa-edit"></i> Show / Edit Area</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-microphone"></i>
                    <span>Campaigns</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('campaign-request')}}"><i class="fa fa-edit"></i> Show Campaigns Requests</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>Messages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('message')}}"><i class="fa fa-edit"></i> Show Inbox</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>About</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('about/edit')}}"><i class="fa fa-edit"></i> Edit About Website</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-phone"></i>
                    <span>Contact</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('contact/edit')}}"><i class="fa fa-edit"></i> Edit Contact Info</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Setting</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{adminUrl('setting/edit')}}"><i class="fa fa-edit"></i> Edit Website Setting</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
