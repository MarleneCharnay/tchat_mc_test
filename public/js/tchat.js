var $theTchat = $('#thetchat');
var $userList = $('#people');

function refreshTchat() {
    $.ajax({
        url: "index.php?route=tchatmessages"
    }).done(function (html) {
        $theTchat.html(html);
        $theTchat.scrollTop($theTchat.prop("scrollHeight"));
    });
}

function refreshUserList() {
    $.ajax({
        url: "index.php?route=tchatusers"
    }).done(function (html) {
        $userList.html(html);
    });
}

function submitMessage() {
    var $form = $('#entertext > form');

    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: $form.serialize(),
        success: function () {
            $('#content').val("");
            refreshTchat();
        }
    });
}

$(document).ready(function () {
    if (true !== isUserConnected) {
        return false;
    }

    if ($theTchat.length > 0) {
        refreshTchat();
        var refreshTchatInterval = setInterval(refreshTchat, 2000);
    }

    if ($userList.length > 0) {
        refreshUserList();
        var refreshUserListInterval = setInterval(refreshUserList, 2000);
    }
});


$('#entertext > form').on('submit', function (e) {
    e.preventDefault();

    submitMessage();
});
