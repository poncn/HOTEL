<!DOCTYPE html>
<html lang="en">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8"/>
    <title>王者吃鸡</title>
    <meta name="description" content="王者吃鸡--是一个后台管理系统"/>
    <meta name="author" content="GP℃"/>
    <meta name="keyword" content="hotel"/>
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link href="<?php echo base_url('./public/admin/css/bootstrap.min.css')?>" rel="stylesheet"/>
    <link href="<?php echo base_url('./public/admin/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('./public/admin/css/style.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('./public/admin/css/style-responsive.min.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('./public/admin/css/retina.css'); ?>" rel="stylesheet"/>
    <!-- end: CSS -->


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon and Touch Icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?php echo base_url('public/admin/ico/apple-touch-icon-144-precomposed.png'); ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?php echo base_url('public/admin/ico/apple-touch-icon-114-precomposed.png'); ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?php echo base_url('public/admin/ico/apple-touch-icon-72-precomposed.png'); ?>"/>
    <link rel="apple-touch-icon-precomposed"
          href="<?php echo base_url('public/admin/ico/apple-touch-icon-57-precomposed.png'); ?>"/>
    <link rel="shortcut icon" href="<?php echo base_url('public/admin/ico/favicon.png'); ?>"/>
    <!-- end: Favicon and Touch Icons -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>

<!-- start: Header -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse"
               data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a id="main-menu-toggle" class="hidden-phone open"><i class="icon-reorder"></i></a>
            <div class="row-fluid">
                <a class="brand span2" href="#"><span>王者吃鸡</span></a>
            </div>
            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
                    <li class="dropdown hidden-phone">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-warning-sign"></i>
                        </a>
                        <ul class="dropdown-menu notifications">
                            <li class="dropdown-menu-title">
                                <span>You have 11 notifications</span>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon blue"><i class="icon-user"></i></span>
                                    <span class="message">New user registration</span>
                                    <span class="time">1 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon green"><i class="icon-comment-alt"></i></span>
                                    <span class="message">New comment</span>
                                    <span class="time">7 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon green"><i class="icon-comment-alt"></i></span>
                                    <span class="message">New comment</span>
                                    <span class="time">8 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon green"><i class="icon-comment-alt"></i></span>
                                    <span class="message">New comment</span>
                                    <span class="time">16 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon blue"><i class="icon-user"></i></span>
                                    <span class="message">New user registration</span>
                                    <span class="time">36 min</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon yellow"><i class="icon-shopping-cart"></i></span>
                                    <span class="message">2 items sold</span>
                                    <span class="time">1 hour</span>
                                </a>
                            </li>
                            <li class="warning">
                                <a href="#">
                                    <span class="icon red"><i class="icon-user"></i></span>
                                    <span class="message">User deleted account</span>
                                    <span class="time">2 hour</span>
                                </a>
                            </li>
                            <li class="warning">
                                <a href="#">
                                    <span class="icon red"><i class="icon-shopping-cart"></i></span>
                                    <span class="message">Transaction was canceled</span>
                                    <span class="time">6 hour</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon green"><i class="icon-comment-alt"></i></span>
                                    <span class="message">New comment</span>
                                    <span class="time">yesterday</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon blue"><i class="icon-user"></i></span>
                                    <span class="message">New user registration</span>
                                    <span class="time">yesterday</span>
                                </a>
                            </li>
                            <li class="dropdown-menu-sub-footer">
                                <a>View all notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- start: Notifications Dropdown -->
                    <li class="dropdown hidden-phone">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-tasks"></i>
                        </a>
                        <ul class="dropdown-menu tasks">
                            <li>
                                <span class="dropdown-menu-title">You have 17 tasks in progress</span>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">iOS Development</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim progressBlue">80</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">Android Development</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim progressYellow">47</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">Django Project For Google</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim progressRed">32</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">SEO for new sites</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim progressGreen">63</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="header">
											<span class="title">New blog posts</span>
											<span class="percent"></span>
										</span>
                                    <div class="taskProgress progressSlim progressPink">80</div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-menu-sub-footer">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- end: Notifications Dropdown -->
                    <!-- start: Message Dropdown -->
                    <li class="dropdown hidden-phone">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-envelope"></i>
                        </a>
                        <ul class="dropdown-menu messages">
                            <li>
                                <span class="dropdown-menu-title">You have 9 messages</span>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img
                                                src="<?php echo base_url('public/admin/img/avatar.jpg') ?>"
                                                alt="Avatar"/></span>
                                    <span class="header">
											<span class="from">
										    	Łukasz Holeczek
										     </span>
											<span class="time">
										    	6 min
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img
                                                src="<?php echo base_url('public/admin/img/avatar2.jpg'); ?>"
                                                alt="Avatar"/></span>
                                    <span class="header">
											<span class="from">
										    	Megan Abott
										     </span>
											<span class="time">
										    	56 min
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img
                                                src="<?php echo base_url('public/admin/img/avatar3.jpg'); ?>"
                                                alt="Avatar"/></span>
                                    <span class="header">
											<span class="from">
										    	Kate Ross
										     </span>
											<span class="time">
										    	3 hours
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img
                                                src="<?php echo base_url('public/admin/img/avatar4.jpg'); ?>"
                                                alt="Avatar"/></span>
                                    <span class="header">
											<span class="from">
										    	Julie Blank
										     </span>
											<span class="time">
										    	yesterday
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="avatar"><img
                                                src="<?php echo base_url('public/admin/img/avatar5.jpg'); ?>"
                                                alt="Avatar"/></span>
                                    <span class="header">
											<span class="from">
										    	Jane Sanders
										     </span>
											<span class="time">
										    	Jul 25, 2012
										    </span>
										</span>
                                    <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-menu-sub-footer">View all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- end: Message Dropdown -->
                    <li>
                        <a class="btn" href="#">
                            <i class="icon-wrench"></i>
                        </a>
                    </li>
                    <!-- start: User Dropdown -->
                    <li class="dropdown">

                        <a class="btn account dropdown-toggle" data-toggle="dropdown" href="#">
                            <div class="avatar"><img src="<?php echo base_url($_SESSION['head_portrait']); ?>">
                            </div>
                            <div class="user">
                                <strong><span class="name"><?php echo $_SESSION['username']?></span></strong>
                            </div>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">

                            </li>
                            <li><a href="#"><i class="icon-user"></i> Profile</a></li>
                            <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="icon-envelope"></i> Messages</a></li>
                            <li><a href="<?php echo site_url('Login/logout')?>"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <div id="sidebar-left" class="span2">

            <div class="row-fluid actions">

                <input type="text" class="search span12" placeholder="..."/>

            </div>

            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li><a href="#"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a>
                    </li>

                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Table Pages</span>
                            <span class="label">8</span></a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Admin/table');?>">
                                    <i class="icon-table"></i>
                                    <span class="hidden-tablet"> Admin table</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('User/table');?>">
                                    <i class="icon-table"></i>
                                    <span class="hidden-tablet"> User table</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Book/table');?>">
                                    <i class="icon-table"></i>
                                    <span class="hidden-tablet"> Book table</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Type/table');?>">
                                    <i class="icon-table"></i>
                                    <span class="hidden-tablet"> Type table</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Comment/table');?>">
                                    <i class="icon-table"></i>
                                    <span class="hidden-tablet"> Comment table</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Room/table');?>">
                                    <i class="icon-table"></i>
                                    <span class="hidden-tablet"> Room table</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Client/table');?>">
                                    <i class="icon-table"></i>
                                    <span class="hidden-tablet"> Client table</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Request/table');?>">
                                    <i class="icon-table"></i>
                                    <span class="hidden-tablet"> Request table</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Create Pages</span>
                            <span class="label">7</span></a>
                        <ul>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Admin/create');?>">
                                    <i class="icon-edit"></i>
                                    <span class="hidden-tablet"> Admin create</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('User/create');?>">
                                    <i class="icon-edit"></i>
                                    <span class="hidden-tablet"> User create</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Book/create');?>">
                                    <i class="icon-edit"></i>
                                    <span class="hidden-tablet"> Book create</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Type/create');?>">
                                    <i class="icon-edit"></i>
                                    <span class="hidden-tablet"> Type create</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Comment/create');?>">
                                    <i class="icon-edit"></i>
                                    <span class="hidden-tablet"> Comment create</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Room/create');?>">
                                    <i class="icon-edit"></i>
                                    <span class="hidden-tablet"> Room create</span>
                                </a>
                            </li>
                            <li>
                                <a class="submenu" href="<?php echo site_url('Client/create');?>">
                                    <i class="icon-edit"></i>
                                    <span class="hidden-tablet"> Client create</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end: Main Menu -->

        <!-- start: Content -->
        <div id="content" class="span10">
