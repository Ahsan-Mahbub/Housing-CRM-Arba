<!-- Side Overlay-->
<aside id="side-overlay">
    <!-- Side Header -->
    <div class="content-header content-header-fullrow">
        <div class="content-header-section align-parent">
            <!-- Close Side Overlay -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                <i class="fa fa-times text-danger"></i>
            </button>
            <!-- END Close Side Overlay -->

            <!-- User Info -->
            <div class="content-header-item">
                <a class="img-link mr-5" href="be_pages_generic_profile.html">
                    <img class="img-avatar img-avatar32" src="{{ asset('asset/backend_asset/assets/media/avatars/avatar15.jpg')}}" alt="">
                </a>
                <a class="align-middle link-effect text-primary-dark font-w600" href="be_pages_generic_profile.html">{{Auth::user()->name}}</a>
            </div>
            <!-- END User Info -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Side Content -->
    <div class="content-side">
        <!-- Profile -->
        <div class="block pull-r-l">
            <div class="block-header bg-body-light">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-pencil font-size-default mr-5"></i>Profile
                </h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                </div>
            </div>
            <div class="block-content">
                <form role="form" action="{{route('profile.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-15">
                        <label for="side-overlay-profile-name">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="side-overlay-profile-name" name="name" placeholder="Your Name.." value="{{Auth::user()->name}}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-15">
                        <label for="side-overlay-profile-email">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="side-overlay-profile-email" name="email" placeholder="Your Email.." value="{{Auth::user()->email}}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-15">
                        <label for="side-overlay-profile-email">Phone Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="side-overlay-profile-email" name="phone" placeholder="Your Phone Number.." value="{{Auth::user()->phone}}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-phone"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-15">
                        <label for="side-overlay-profile-password">Change Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="side-overlay-profile-password" name="password" placeholder="Change Password..">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-asterisk"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-alt-primary">
                                <i class="fa fa-refresh mr-5"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Profile -->
    </div>
    <!-- END Side Content -->
</aside>
<!-- END Side Overlay -->
