 <!-- BEGIN: Main Menu-->
 <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('admin.dashboard')}}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">{{env("APP_NAME")}}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @can('dashboard-view')
                <li class=" nav-item {{Request::segment(2) == 'dashboard' ? 'active' : '' }}"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge badge-warning badge-pill float-right mr-2"></span></a>
                </li>
            @endcan
            
            @can('service-view')
                <li class=" nav-item {{Request::segment(2) == 'service' ? 'active' : '' }}"><a href="{{route('service.index')}}"><i class="feather icon-calendar"></i><span class="menu-title" data-i18n="Services">Service</span></a>
            </li>
            @endcan
            @can('user-request-view')
                <li class=" nav-item {{Request::segment(2) == 'user_request' ? 'active' : '' }}"><a href="{{route('user_request.index')}}"><i class="feather icon-message-circle"></i><span class="menu-title" data-i18n="User Requests">User Requests</span></a>
                </li>
            @endcan

            @can('question-view')
                <li class=" nav-item {{Request::segment(2) == 'question' ? 'active' : '' }}"><a href="{{route('question.index')}}"><i class="feather icon-help-circle"></i><span class="menu-title" data-i18n="Question">Question</span></a>
                </li>
            @endcan

            @can('plan-view')
                <li class=" nav-item {{Request::segment(2) == 'plan' ? 'active' : '' }}"><a href="{{route('plan.index')}}"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Plan">Plan</span></a>
                </li>
            @endcan

            @can('email-template-view')
                {{-- <li class=" nav-item {{Request::segment(2) == 'email-template' ? 'active' : '' }}"><a href="{{route('email-template.index')}}"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Plan">Email Template</span></a>
                </li> --}}
            @endcan

            @can('testimonials-view')
                <li class=" nav-item {{Request::segment(2) == 'testimonials' ? 'active' : '' }}"><a href="{{route('testimonials.index')}}"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Plan">Testimonials</span></a>
                </li>
            @endcan
            
            @can('blogs-view')
                <li class=" nav-item {{Request::segment(2) == 'blogs' ? 'active' : '' }}"><a href="{{route('blogs.index')}}"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Plan">Blogs</span></a>
                </li>
            @endcan
            @can('notifications-view')
                <li class=" nav-item {{Request::segment(2) == 'notifications' ? 'active' : '' }}"><a href="{{route('notifications.index')}}"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Notifications">Notifications</span></a>
                </li>
            @endcan



            
           
           
            @canany(['role-view', 'operator-view','settings-view'])
            <li class=" navigation-header"><span>Settings</span></li>
            @endcan
            @can('role-view')
            <li class="nav-item {{Request::segment(2) == 'role' ? 'active' : '' }}"><a
                href="{{route('role.index')}}"><i class="feather icon-user-plus"></i><span
                    class="menu-title"
                    data-i18n="Roles">Roles</span></a>
            </li>
            @endcan
            @can('operator-view')
            <li class=" nav-item {{Request::segment(2) == 'operator' ? 'active' : '' }}"><a href="{{route('operator.index')}}"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Operators">Operators</span></a>
            </li>
            @endcan
        
            @can('settings-view')
            <li class=" nav-item {{Request::segment(2) == 'settings' ? 'active' : '' }}"><a href="{{route('admin.settings.show')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="General">General</span></a>
            </li>
            @endcan
            
           
        </ul>
    </div>
</div>
<!-- END: Main Menu-->