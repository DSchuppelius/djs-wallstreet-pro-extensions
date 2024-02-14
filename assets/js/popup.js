jQuery(document).ready(function () {

    jQuery('#script_fullscreen_menu').on("click", function (event) {

        event.preventDefault();
        if (!jQuery("#script_fullscreen").hasClass("open")) {
            jQuery("#script_fullscreen").addClass("open");
            jQuery('#script_fullscreen > form > input[type="search"]').focus();
        } else {
            jQuery("#script_fullscreen").removeClass("open");
        }
    });

    jQuery("#script_fullscreen, #script_fullscreen button.close").on("click keyup", function (event) {
        if (
            // event.target == this ||
            event.target.className == "not close material-icons" ||
            event.keyCode == 27
        ) {
            jQuery(this).removeClass("open");
        }
    });
});
