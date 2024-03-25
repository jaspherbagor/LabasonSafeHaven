<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin_home') }}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_home') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_home') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/page/about') ||Request::is('admin/page/terms') ||Request::is('admin/page/contact') || Request::is('admin/page/photo-gallery') || Request::is('admin/page/video-gallery') || Request::is('admin/page/faq') || Request::is('admin/page/blog') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-book"></i><span>Pages</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/page/about') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_about_page') }}"><i class="fa fa-angle-right"></i> About</a></li>
                    <li class="{{ Request::is('admin/page/terms') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_terms_page') }}"><i class="fa fa-angle-right"></i> Terms and Conditions</a></li>
                    <li class="{{ Request::is('admin/page/contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_contact_page') }}"><i class="fa fa-angle-right"></i> Contact</a></li>
                    <li class="{{ Request::is('admin/page/photo-gallery') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_photo_gallery_page') }}"><i class="fa fa-angle-right"></i> Photo Gallery</a></li>
                    <li class="{{ Request::is('admin/page/video-gallery') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_video_gallery_page') }}"><i class="fa fa-angle-right"></i> Video Gallery</a></li>
                    <li class="{{ Request::is('admin/page/faq') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_page') }}"><i class="fa fa-angle-right"></i> FAQs</a></li>
                    <li class="{{ Request::is('admin/page/blog') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_blog_page') }}"><i class="fa fa-angle-right"></i> Blog</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/slide/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_slide_view') }}"><i class="fa fa-sliders"></i> <span>Slide</span></a></li>

            <li class="{{ Request::is('admin/feature/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_feature_view') }}"><i class="fa fa-certificate"></i> <span>Feature</span></a></li>
            <li class="{{ Request::is('admin/testimonial/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_testimonial_view') }}"><i class="fa fa-star"></i> <span>Testimonial</span></a></li>
            <li class="{{ Request::is('admin/post/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_post_view') }}"><i class="fa fa-clipboard"></i> <span>Post</span></a></li>
            <li class="{{ Request::is('admin/photo/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_photo_view') }}"><i class="fa fa-picture-o"></i> <span>Photo Gallery</span></a></li>
            <li class="{{ Request::is('admin/video/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_video_view') }}"><i class="fa fa-video-camera"></i> <span>Video Gallery</span></a></li>
            <li class="{{ Request::is('admin/faq/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_view') }}"><i class="fa fa-question-circle"></i> <span>FAQs</span></a></li>
        </ul>
    </aside>
</div>