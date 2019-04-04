<div class="col-lg-3 col-md-3 sidebar-left">
    <div class="widget member-card">
        <div class="member-card-header">
            <a href="#" class="member-card-avatar"><img src="{{ asset('client/images/agent-img3.jpg') }}" alt="" /></a>
            <h3>User Name</h3>
            <p><i class="fa fa-envelope icon"></i>user@email.com</p>
        </div>
        <div class="member-card-content">
            <img class="hex" src="images/hexagon.png" alt="" />
            <ul>
                <li class="{{ isUserActiveRoute('profile') }}"><a href="/profile"><i class="fa fa-user icon"></i>Profile</a></li>
                <li class="{{ isUserActiveRoute('uploads') }}"><a href="/uploaded-items"><i class="fa fa-file icon"></i>My Uploaded Items</a></li>
                <li class="{{ isUserActiveRoute('upload_item') }}"><a href="/upload-item"><i class="fa fa-upload icon"></i>Upload Found Item </a></li>
                <li><a href="#"><i class="fa fa-reply icon"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</div>