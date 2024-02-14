<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{ url('home')}}" class="nav-link">
                <div class="nav-profile-image">
                    <img src="../users/assets/images/faces/face1.jpg" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
                    @php
                    switch (auth()->user()->usertype) {
                   
                    case 2:
                    echo '<span class="text-secondary text-small">Teacher</span>';
                    break;
                    case 3:
                    echo '<span class="text-secondary text-small">Student</span>';
                    break;
                    default:
                    echo '<span class="text-secondary text-small">User</span>';
                    }
                    @endphp
                </div>

                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('home')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
      
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.users_notes') }}">
                <span class="menu-title">Notes</span>
                <i class="  mdi mdi-file-document-box menu-icon"></i>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.users_videos') }}">
                <span class="menu-title">Videos</span>
                <i class="  mdi mdi-file-video menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Materials</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('student.users_materials') }}">View materials</a></li>
                    </li>
                </ul>
            </div>
        </li>
    
      
        
        
        <li class="nav-item sidebar-actions">
            <span class="nav-link">
                <div class="border-bottom">
                    <h6 class="font-weight-normal mb-3">Plan</h6>
                </div>
                <button class="btn btn-block btn-lg btn-gradient-primary mt-4">+Subscription</button>
              
            </span>
        </li>
    </ul>
</nav>
