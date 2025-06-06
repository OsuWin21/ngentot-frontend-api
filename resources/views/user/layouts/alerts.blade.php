<div class="fixed-top" style="z-index: 9999">
    <div class="alert alert-primary alert-dismissible fade position-relative show m-0 pb-0" role="alert" id="alphaAlert"
        style="display: none;">
        <p>This is an alpha version of osu!win21, please do not use this for production purposes. Work in progress.
            If you faced issues, contact me on Discord @kentutki</p>
        <button type="button" class="btn btn-close" onclick="closeAlphaAlert()"></button>
    </div>
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade position-relative show top m-0" role="alert" id="sessionAlert">
            {{ session('error') }}
            <button type="button" class="btn btn-close" onclick="closeAlert('sessionAlert')"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade position-relative show top m-0" role="alert" id="successAlert">
            {{ session('success') }}
            <button type="button" class="btn btn-close" onclick="closeAlert('successAlert')"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade position-relative show top m-0" role="alert" id="warningAlert">
            {{ session('warning') }}
            <button type="button" class="btn btn-close" onclick="closeAlert('warningAlert')"></button>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade position-relative show top m-0" role="alert" id="infoAlert">
            {{ session('info') }}
            <button type="button" class="btn btn-close" onclick="closeAlert('infoAlert')"></button>
        </div>
    @endif
</div>