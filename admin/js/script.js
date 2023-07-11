function check_Box_Array(source) {
    checkboxes = document.getElementsByName('checkBoxArray[]');
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}

var div_box = "<div id='load-screen'><div id='loading'></div></div>";

$("body").prepend(div_box);

$('#load-screen').delay(700).fadeOut(600, function () {
    $(this).remove();
});

function loadUserOnLine() {
    $.get("function.php?onlineuser=result", function (data) {
        $(".usersonline").text(data);
    });
}

setInterval(function () {
    loadUserOnLine();
}, 500);
