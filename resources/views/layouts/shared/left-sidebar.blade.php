<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('admin-dashboard') }}" class="logo logo-light" style="background-color: #f9f9f9;">
        <span class="">
            <img src="/images/pci/logo.png" alt="logo" class="img-fluid">
        </span>
    </a>


    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Navigation</li>
            <li class="side-nav-item">
                <a href="{{ route('admin-dashboard') }}" class="side-nav-link">
                    <i class="ri-dashboard-2-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarServiceCategories" aria-expanded="false" aria-controls="sidebarServiceCategories" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span>Services</span>
                </a>
                <div class="collapse" id="sidebarServiceCategories">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('serviceCategories.index') }}">Service Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('service_sub_categories.index') }}">Service Sub Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('serviceSubSubCategories.index') }}">Service Sub Sub Categories</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('banks.index') }}" class="side-nav-link">
                    <i class="ri-bank-line"></i>
                    <span>Banks</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('drafts.index') }}" class="side-nav-link">
                    <i class="ri-file-line"></i>
                    <span>Drafts</span>
                </a>
            </li>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->