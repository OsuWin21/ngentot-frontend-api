var ChartColor = ["#5D62B4", "#54C3BE", "#EF726F", "#F9C446", "rgb(93.0, 98.0, 180.0)", "#21B7EC", "#04BCCC"];
var primaryColor = getComputedStyle(document.body).getPropertyValue('--primary');
var secondaryColor = getComputedStyle(document.body).getPropertyValue('--secondary');
var successColor = getComputedStyle(document.body).getPropertyValue('--success');
var warningColor = getComputedStyle(document.body).getPropertyValue('--warning');
var dangerColor = getComputedStyle(document.body).getPropertyValue('--danger');
var infoColor = getComputedStyle(document.body).getPropertyValue('--info');
var darkColor = getComputedStyle(document.body).getPropertyValue('--dark');
var lightColor = getComputedStyle(document.body).getPropertyValue('--light');

(function ($) {
  'use strict';
  $(function () {
    const body = $('body');
    const sidebar = $('.sidebar');
    const currentPath = location.pathname;

    function addActiveClass(element) {
      const href = element.attr('href');
      if (!href || href === '#') return;

      const fullUrl = new URL(href, location.origin);
      if (fullUrl.pathname === currentPath) {
        element.addClass('active');
        element.parents('.nav-item').addClass('active');
        element.closest('.collapse').addClass('show');
      }
    }

    // Terapkan active class ke sidebar dan horizontal menu
    sidebar.find('.nav li a').each(function () {
      addActiveClass($(this));
    });
    $('.horizontal-menu .nav li a').each(function () {
      addActiveClass($(this));
    });

    // Auto-open Profile Menu jika URL cocok
    if (/^u(\/(edit|invites))?\/\d+$/.test(currentPath)) {
      const $profileMenu = $('#profile-menu');
      $profileMenu.addClass('show');
      $profileMenu.prev('.nav-link').attr('aria-expanded', 'true');
    }

    // Sidebar hanya boleh satu menu terbuka
    sidebar.on('show.bs.collapse', '.collapse', function () {
      sidebar.find('.collapse.show').not(this).collapse('hide');
    });

    // Terapkan perfect-scrollbar untuk sidebar tetap
    if (!body.hasClass("rtl") && body.hasClass("sidebar-fixed")) {
      new PerfectScrollbar('#sidebar .nav');
    }

    // Tombol minimize sidebar
    $('[data-toggle="minimize"]').on("click", function () {
      body.toggleClass(body.hasClass('sidebar-toggle-display') || body.hasClass('sidebar-absolute')
        ? 'sidebar-hidden'
        : 'sidebar-icon-only');
    });

    // Checkbox & Radio visual helper
    $(".form-check label, .form-radio label").append('<i class="input-helper"></i>');

    // Tombol fullscreen
    $("#fullscreen-button").on("click", function toggleFullScreen() {
      const docEl = document.documentElement;
      const requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullscreen || docEl.msRequestFullscreen;
      const cancelFullScreen = document.exitFullscreen || document.mozCancelFullScreen || document.webkitCancelFullScreen || document.msExitFullscreen;

      if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
        requestFullScreen?.call(docEl);
      } else {
        cancelFullScreen?.call(document);
      }
    });

    // Navbar padding fix
    const pageWrapper = document.querySelector('.page-body-wrapper');
    const navbar = document.querySelector('.navbar');
    if (navbar.classList.contains("fixed-top")) {
      pageWrapper.classList.remove('pt-0');
      navbar.classList.remove('pt-5');
    } else {
      pageWrapper.classList.add('pt-0');
      navbar.classList.add('pt-5', 'mt-3');
    }
  });
})(jQuery);
