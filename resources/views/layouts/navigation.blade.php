<?php //use Modules\Admin\Helpers\Helper; ?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('admin/dashboard') }}">TMS</a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ url('admin/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
            </ul>
        </li>
    </ul>

    <div class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <!--
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </li>
                <li>
                    <a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user"></i> Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if (Auth::user()->role_id == 1) { ?>
                            <li>
                                <a href="{{ url('admin/privilege') }}">Privilege</a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="{{ url('admin/role') }}">Roles</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/user') }}">Users</a>
                        </li>
                    </ul>
                </li>
            </ul>-->
            <?php AdminHelper::getAdminMenu(); ?>
        </div>
    </div>
</nav>
