$(document).ready(function() {
    updateOnlineUserCount();
});
function updateOnlineUserCount() {
    // Use AJAX to fetch the online player count
    $.ajax({
        url: '/get_player_count',
        type: 'GET',
        success: function (data) {
            if (data.status === 'success') {
                // Update the online user count on the page
                $('#online-user-count').text(data.counts.online + " Users");
                $('#user-count').text(data.counts.total + " Users");
            } else {
                console.error('Failed to fetch player count.');
            }
        },
        error: function () {
            console.error('Failed to fetch player count.');
        }
    });
}