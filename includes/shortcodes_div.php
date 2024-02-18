<?php
/*
 * Created on   : Wed Sep 04 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : shortcodes_div.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

// [clear_both] shortcode
function theme_shortcode_clear_both() {
    return '<div style="clear:both"></div>';
}
add_shortcode('clear_both', 'theme_shortcode_clear_both');

// The [div class="class"] shortcode
function theme_shortcode_div($atts, $content=null) {
    extract(shortcode_atts([
        'class' => '',
        'style' => '',
        'id'    => '',
    ], $atts));

    $result = '<div';
    if (!empty($style)) $result .= ' style="'.$style . '" ';
    if (!empty($class)) $result .= ' class="'.$class . '" ';
    if (!empty($id))    $result .= ' id="'.$id . '" ';
    $result .= '>';
    if(!empty($content)) $result .= $content . "</div>";
    return $result;
}
add_shortcode('div', 'theme_shortcode_div');

// The [end_div] shortcode
function theme_shortcode_end_div() {
    return '</div>';
}
add_shortcode('end_div', 'theme_shortcode_end_div');

function theme_shortcode_row($atts, $content = null) {
    extract(shortcode_atts([
        "class" => "",
    ], $atts));
    $result = '<div class="row">';
    $content = str_replace("]<br />", "]", $content);
    $content = str_replace("<br />\n[", "[", $content);
    $result .= do_shortcode($content);
    $result .= "</div>";

    return $result;
}
add_shortcode("row", "theme_shortcode_row");

function column_shortcode($atts, $content = null) {
    extract(shortcode_atts([
        "offset" => "",
        "size" => "col-md-6",
    ], $atts));
    $result = '<div class="' . $size . '"><p>' . do_shortcode($content) . "</p></div>";

    return $result;
}
add_shortcode("column", "column_shortcode");

// [paypal_donation button_id="XXXXXXX" img_src="https://..."]
function paypal_donation_shortcode($atts, $content = null) {
    extract(shortcode_atts([
        "button_id" => "",
        "img_src" => "",
    ], $atts));
    $result =
        '<div id="donate-button-container" style="background-color: snow; border-radius: 4px;"><center><p></p>
            <div id="donate-button"></div>
            <p><script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
                <script>
                    PayPal.Donation.Button({
                        env:\'production\',
                        hosted_button_id:\'' . $button_id . '\',
                        image: {
                            src:\'' . $img_src . '\',
                            alt:\'Donate with PayPal button\',
                            title:\'PayPal - The safer, easier way to pay online!\',
                        }
                    }).render(\'#donate-button\');
                </script>
            </p>
            <p></p>
        <p></p></center></div>';

    return $result;
}
add_shortcode("paypal_donation", "paypal_donation_shortcode");

function zdf_media($atts, $content = null) {
    $result = "<div>no content</div>";
    extract(shortcode_atts([
        "media_id" => "",
        "src" => "",
        "url" => "",
    ], $atts));

    if(!empty($url)){
        $src = 'https://ngp.zdf.de/miniplayer/embed/?mediaID=' . basename($url, ".html");
    }elseif(!empty($media_id)) {
        $src = 'https://ngp.zdf.de/miniplayer/embed/?mediaID=' . $media_id;
    }

    if(!empty($src))
        $result =
            '<figure class="wp-block-embed is-type-video is-provider-zdf wp-block-embed-zdf wp-embed-aspect-16-9 wp-has-aspect-ratio">
                <div class="wp-block-embed__wrapper">
                    <span class="embed-zdf" style="text-align:center; display: block;">
                        <iframe loading="lazy" class="zdf-player" width="600" height="338" src="' . $src . '" allowfullscreen="true" style="border:0;" sandbox="allow-scripts allow-same-origin allow-popups allow-presentation"></iframe>
                    </span>
                </div>
                <figcaption>'. do_shortcode($content) .'</figcaption>
            </figure>';

    return $result;
}
add_shortcode("zdf", "zdf_media");

function iframe_media($atts, $content = null) {
    $result = "<div>no content</div>";
    extract(shortcode_atts([
        "src" => "",
    ], $atts));

    if(!empty($src))
        $result =
            '<figure class="wp-block-embed is-type-page is-provider-unknown wp-block-embed-page wp-embed-aspect-16-9 wp-has-aspect-ratio">
                <div class="wp-block-embed__wrapper">
                    <span class="embed-iframe" style="text-align:center; display: block;">
                        <iframe loading="lazy" class="iframe" width="600" height="338" src="' . $src . '" allowfullscreen="true" style="border:0;" sandbox="allow-scripts allow-same-origin allow-popups allow-presentation"></iframe>
                    </span>
                </div>
                <figcaption>'. do_shortcode($content) .'</figcaption>
            </figure>';

    return $result;
}
add_shortcode("iframe", "iframe_media");
