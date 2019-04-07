<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{ isUserActiveRoute('home') }}"><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    

    <!-- List Start -->
    <li class="{{ areActiveRoutes(['add_admin','admin_index','trashed_admins']) }} treeview">
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
    <li class=" {{ areActiveRoutes(['users.create','users.edit','trashed_users','users.index']) }} treeview">
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
    <li class="{{ areActiveRoutes(['categories.create','categories.edit','categories.index']) }} treeview">
      <a href="#">
        <i class="fa fa-list-ul"></i>
        <span>Categories</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('categories.create') }}"><i class="fa fa-plus"></i> Add Category</a></li>
        <li><a href="/admin/categories"><i class="fa fa-eye"></i>View Categories</a></li>
      </ul>
    </li>
    <!-- List End -->
    <!-- List Start -->
    <li class="{{ areActiveRoutes(['items.create','items.edit','items.index', 'pending', 'trashed_items', 'approved-items']) }} treeview">
      <a href="#">
        <i class="fa fa-id-card"></i>
        <span>Items</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/pending-items"><i class="fa fa-refresh"></i> Pending Items</a></li>
<<<<<<< HEAD
        <li><a href="{{ route('approved-items') }}"><i class="fa fa-check"></i> Approved Items</a></li>
        <li><a href="{{ route('trashed-items') }}"><i class="fa fa-trash"></i>Trashed Items</a></li>
=======
        <li><a href="/admin/approved-items"><i class="fa fa-check"></i> Approved Items</a></li>
        <li><a href="#"><i class="fa fa-trash"></i>Trashed Items</a></li>
>>>>>>> 12669e8c62b99a89bd9d4b8c6716a58f9d6d9b35
      </ul>
    </li>
    <!-- List End -->
    <li class="{{ areActiveRoutes(['faqs.create','faqs.edit','faqs.index']) }} treeview">
      <a href="#">
        <i class="fa fa-group"></i>
        <span>FAQs</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/faqs/create"><i class="fa fa-plus"></i> Add FAQ</a></li>
        <li><a href="/admin/faqs"><i class="fa fa-eye"></i>View FAQs</a></li>
      </ul>
    </li>

  </ul>