<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active"><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    

    <!-- List Start -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Admins</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('add_admin') }}"><i class="fa fa-user-plus"></i> Add Admin</a></li>
        <li><a href="{{ route('admin_index') }}"><i class="fa fa-eye"></i>View Admins</a></li>
        <li><a href="{{ route('trashed_admins') }}"><i class="fa fa-trash"></i>Trashed Admins</a></li>
      </ul>
    </li>
    <!-- List End -->

    <!-- List Start -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Users</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('users.create') }}"><i class="fa fa-user-plus"></i> Add User</a></li>
        <li><a href="/admin/users"><i class="fa fa-eye"></i>View Users</a></li>
        <li><a href="{{ route('trashed_users') }}"><i class="fa fa-trash"></i>Trashed Users</a></li>
      </ul>
    </li>
    <!-- List End -->


    <!-- List Start -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-briefcase"></i>
        <span>Clients</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('clients.create') }}"><i class="fa fa-user-plus"></i> Add Client</a></li>
        <li><a href="/admin/clients"><i class="fa fa-briefcase"></i>View Clients</a></li>
      </ul>
    </li>
    <!-- List End -->
    
    
    <!-- List Start -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-image"></i>
        <span>Sliders</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('sliders.create') }}"><i class="fa fa-user-plus"></i> Add Slider</a></li>
        <li><a href="/admin/sliders"><i class="fa fa-image"></i>View Sliders</a></li>
      </ul>
    </li>
    <!-- List End -->

    <li class="treeview">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Partners</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/partners/create"><i class="fa fa-user-plus"></i> Add Partner</a></li>
        <li><a href="/admin/partners"><i class="fa fa-eye"></i>View Partners</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-tags"></i>
        <span>Meta Tags</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/metatags/create"><i class="fa fa-plus"></i> Add Meta Tag</a></li>
        <li><a href="/admin/metatags"><i class="fa fa-eye"></i>View Meta Tags</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-file"></i>
        <span>Pages</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/webpages/create"><i class="fa fa-plus"></i> Add Page</a></li>
        <li><a href="/admin/webpages"><i class="fa fa-eye"></i>View Pages</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-group"></i>
        <span>Subscribers</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/subscribers/create"><i class="fa fa-plus"></i> Add Subscriber</a></li>
        <li><a href="/admin/subscribers"><i class="fa fa-eye"></i>View Subscribers</a></li>
      </ul>
    </li>

  </ul>