$(document).ready(function() {
    $("#do_login").click(function() {
        closeLoginInfo();
        // Rest of your code...
    });

    // Reset previously results and hide all messages on .keyup()
    $("#login_form input").keyup(function() {
        $(this).parent().find('span').css("display", "none");
    });

    openLoginInfo();
    setTimeout(closeLoginInfo, 1000);
});

function openLoginInfo() {
    $('.b-form').css("opacity", "0.01");
    $('.box-form').css("left", "-37%");
    $('.box-info').css("right", "-37%");
}

function closeLoginInfo() {
    $('.b-form').css("opacity", "1");
    $('.box-form').css("left", "0px");
    $('.box-info').css("right", "-5px");
}

$(window).on('resize', function() {
    closeLoginInfo();
});
