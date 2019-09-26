<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{ isUserActiveRoute('home') }}"><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>

    @if (Auth::user()->type == 'super')
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
            <li class="{{ isUserActiveRoute('add_admin') }}"><a href="{{ route('add_admin') }}"><i
                        class="fa fa-user-plus"></i> Add Admin</a></li>
            <li class="{{ isUserActiveRoute('admin_index') }}"><a href="{{ route('admin_index') }}"><i
                        class="fa fa-eye"></i>View Admins</a></li>
        </ul>
    </li>
    <!-- List End -->
    @endif

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
            <li class="{{ isUserActiveRoute('categories.create') }}"><a href="{{ route('categories.create') }}"><i
                        class="fa fa-plus"></i> Add Category</a></li>
            <li class="{{ isUserActiveRoute('categories.index') }}"><a href="/admin/categories"><i
                        class="fa fa-eye"></i>View Categories</a></li>
        </ul>
    </li>
    <!-- List End -->
    <!-- List Start -->
    <li
        class="{{ areActiveRoutes(['items.create','items.edit','items.index', 'pending', 'trashed_items', 'approved-items', 'items.uncollected', 'items.collected']) }} treeview">
        <a href="#">
            <i class="fa fa-id-card"></i>
            <span>Documents</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ isUserActiveRoute('items.create') }}"><a href="{{ route('items.create') }}"><i
                        class="fa fa-plus"></i> Upload document</a></li>
            <li class="{{ isUserActiveRoute('items.index') }}"><a href="{{ route('items.index') }}"><i
                        class="fa fa-id-card"></i> View all documents</a></li>
            <li class="{{ isUserActiveRoute('items.uncollected') }}"><a href="{{ route('items.uncollected') }}"><i
                        class="fa fa-id-card"></i> Uncollected Documents</a></li>
            <li class="{{ isUserActiveRoute('items.collected') }}"><a href="{{ route('items.collected') }}"><i
                        class="fa fa-id-card"></i> Collected Documents</a></li>
        </ul>
    </li>

</ul>
