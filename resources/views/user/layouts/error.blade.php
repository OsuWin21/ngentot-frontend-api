<div class="fixed-top">
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
</div>