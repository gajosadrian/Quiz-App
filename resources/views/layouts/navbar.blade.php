@if ( isset($sidebar) )
    <div class="content-side content-side-full">
        <ul class="nav-main">
@else
    <div class="content-header-section">
        <ul class="nav-main-header">
@endif
        <li>
            <a class="active" href="db_corporate.html"><i class="si si-rocket"></i>Dashboard</a>
        </li>
        <li>
                <a href=""><i class="si si-settings"></i>Settings</a>
        </li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i>Features</a>
            <ul>
                <li>
                    <a href="">Backend</a>
                </li>
                <li>
                    <a href="">Frontend</a>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">More</a>
                    <ul>
                        <li>
                            <a href="">Dashboard</a>
                        </li>
                        <li>
                            <a href="">Resources</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    @if ( !isset($sidebar) )
        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
            <i class="fa fa-navicon"></i>
        </button>
    @endif
</div>
