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
        @if(Auth::user()->type == 'super')
          <li><a href="{{ route('add_admin') }}"><i class="fa fa-user-plus"></i> Add Admin</a></li>
        @endif
          <li><a href="{{ route('admin_index') }}"><i class="fa fa-eye"></i>View Admins</a></li>
        @if(Auth::user()->type == 'super')
          <li><a href="{{ route('trashed_admins') }}"><i class="fa fa-trash"></i>Trashed Admins</a></li>
        @endif
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
        <span>Documents</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('items.create') }}"><i class="fa fa-plus"></i> Upload document</a></li>
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