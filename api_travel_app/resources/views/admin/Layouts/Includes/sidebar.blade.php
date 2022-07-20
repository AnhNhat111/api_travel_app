<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label" style="padding-top: 40px">Trang Quản trị</li>
            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="" aria-expanded="false">
                    <i class="fa-solid fa-user"></i><span class="nav-text">User Management</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('user.index') }}">Watch User Detail</a></li>
                </ul>
            </li>

            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="" aria-expanded="false">
                    <i class="fa-solid fa-person-walking-luggage"></i></i><span class="nav-text">Tour Management</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('tour.index') }}">Watch tour</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-envelope menu-icon"></i> <span class="nav-text">Booking Management</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.BookingConfirmed') }}">Booking Confirmed</a>
                    </li>
                    <li><a href="{{ route('admin.BookingNotConfirmed') }}">Booking Not Confirmed</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-envelope menu-icon"></i> <span class="nav-text">Location Management</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.location') }}">Watch Location</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-envelope menu-icon"></i> <span class="nav-text">Vehicle Management</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.vehicle') }}">Watch Vehicle</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
