<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle" alt="{{ asset(Auth::user()->avatar) }}">
        </div>
        <div class="pull-left info">
          <p>{{Auth::User()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
        <form action="{{ route('items.search') }}" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="content" class="form-control" placeholder="Deep Search...">
          <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      @include('layouts.menu')
    </section>
    <!-- /.sidebar -->
  </aside>
