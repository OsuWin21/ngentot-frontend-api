function closeAlert(id) {
    const el = document.getElementById(id);
    if (el) {
        el.style.display = 'none';
    }
}

function closeAlphaAlert() {
    closeAlert('alphaAlert');
    localStorage.setItem('alphaAlertClosedAt', Date.now());
}

window.addEventListener('DOMContentLoaded', function () {
    const closedAt = localStorage.getItem('alphaAlertClosedAt');
    const now = Date.now();
    if (!closedAt || now - closedAt > 600000) {
        document.getElementById('alphaAlert').style.display = '';
    }
});