<div class="col-lg-3 col-md-3 sidebar-left">
    <div class="widget member-card">
        <div class="member-card-header">
            <a href="#" class="member-card-avatar"><img src="{{ asset('uploads/users/avatar.png') }}" alt="" /></a>
            <h3>{{ Auth::user()->name }}</h3>
            <p><i class="fa fa-envelope icon"></i>{{ Auth::user()->email }}</p>
        </div>
        <div class="member-card-content">
            <img class="hex" src="{{ asset('client/images/hexagon.png') }}" alt="" />
            <ul>
                <li class="{{ isUserActiveRoute('profile') }}"><a href="/profile"><i class="fa fa-user icon"></i>Profile</a></li>
                <li class="{{ isUserActiveRoute('uploads') }}"><a href="/uploaded-items"><i class="fa fa-file icon"></i>My Uploaded Items</a></li>
                <li class="{{ isUserActiveRoute('upload_item') }}"><a href="/items/create"><i class="fa fa-upload icon"></i>Upload Found Item </a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-reply icon"></i>
                        {{ __('Logout') }}
                    </a>
                </li>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</div>