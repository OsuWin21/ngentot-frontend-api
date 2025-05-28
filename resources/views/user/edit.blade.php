<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>osu!win21 - Edit Profile</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/user/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon"
        href="https://cdn.discordapp.com/emojis/1199139517198770206.png?size=48&quality=lossless" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.min.css"
        integrity="sha512-6QxSiaKfNSQmmqwqpTNyhHErr+Bbm8u8HHSiinMEz0uimy9nu7lc/2NaXJiUJj2y4BApd5vgDjSHyLzC8nP6Ng=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid p-0">
        <!-- partial:partials/_navbar.html -->
        @include('user.layouts.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('user.layouts.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-account"></i>
                            </span>Edit Profile
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form-sample">
                                        @csrf
                                        <div class="row border-bottom mb-4">
                                            <p class="card-description">Profile</p>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->name }}" disabled />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Country</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->country }}" disabled />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row border-bottom mb-4 pb-3">
                                            <form action="" method="post">
                                                @csrf
                                                <p class="card-description">Images</p>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Avatar</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" id="imageInput" class="form-control"
                                                                accept="image/png, image/jpeg" />
                                                        </div>
                                                    </div>
                                                    <p class="card-description">Preview:</p>
                                                    <div class="d-flex">
                                                        <!-- Preview Hasil Crop -->
                                                        <div class="me-3"
                                                            style="width: 250px; height: 250px; border: 1px dashed #ccc;">
                                                            <img id="cropPreview"
                                                                style="max-width: 100%; display: none;" />
                                                        </div>
                                                        <!-- Preview Original (hidden) -->
                                                        <div style="width: 350px; height: 100%; overflow: hidden;">
                                                            @if (Storage::disk('public')->exists('avatars/' . $user->id . '.png'))
                                                                <img id="imagePreview" style="max-width: 100%;"
                                                                    src="{{ asset('storage/avatars/' . $user->id . '.png') }}"
                                                                    alt="Avatar" />
                                                            @else
                                                                <img id="imagePreview" style="max-width: 100%;"
                                                                    src="{{ asset('storage/avatars/default.png') }}"
                                                                    alt="Default Avatar" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Background</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" id="bgInput" class="form-control"
                                                                accept="image/png, image/jpeg" />
                                                        </div>
                                                    </div>
                                                    <p class="card-description">Preview:</p>
                                                    <div class="d-flex flex-column">
                                                        <!-- Preview Hasil Crop Background -->
                                                        <div class="mb-3"
                                                            style="width: 500px; height: 125px; border: 1px dashed #ccc;">
                                                            <img id="bgCropPreview"
                                                                style="max-width: 100%; display: none;" />
                                                        </div>
                                                        <!-- Preview Original Background -->
                                                        <div style="width: 500px; height: 100%; overflow: hidden;">
                                                            @if (Storage::disk('public')->exists('backgrounds/' . $user->id . '.png'))
                                                                <img id="bgPreview" style="max-width: 100%;"
                                                                    src="{{ asset('storage/backgrounds/' . $user->id . '.png') }}" />
                                                            @else
                                                                <img id="bgPreview" style="max-width: 100%;"
                                                                    src="{{ asset('storage/backgrounds/default.png') }}" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row border-bottom mb-4">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="userpageContent">
                                                        About Me!
                                                        <a class="link link-primary"
                                                            href="https://www.markdownguide.org/basic-syntax/#html">Markdown Syntax</a>
                                                        </label>
                                                    <textarea class="form-control" id="userpageContent" rows="4" name="userpage-content">{{ $user->userpage_content }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" id="submitButton"
                                                    class="btn btn-gradient-primary me-2">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('user.layouts.footer')
        <!-- partial -->
    </div>
    <!-- main-panel ends -->

    {{-- Data Fetch --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('assets/user/js/data-fetch.js') }}"></script>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/user/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/user/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/user/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/user/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/user/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/user/js/chart.js') }}"></script>
    <script src="{{ asset('assets/user/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/user/js/todolist.js') }}"></script>
    <!-- End custom js for this page -->

    <!-- Cropper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.min.js"
        integrity="sha512-IlZV3863HqEgMeFLVllRjbNOoh8uVj0kgx0aYxgt4rdBABTZCl/h5MfshHD9BrnVs6Rs9yNN7kUQpzhcLkNmHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/user/js/profile-edit.js') }}"></script>
</body>

</html>
