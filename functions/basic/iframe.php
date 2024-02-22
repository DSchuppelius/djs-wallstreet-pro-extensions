<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : iframe.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
function youtube_nocookie_solution($original, $url, $attr, $post_ID) {
    $html = str_replace("youtube.com", "youtube-nocookie.com", $original);
    $html = str_replace("feature=oembed", "feature=oembed&showinfo=0", $html);
    return $html;
}
add_filter("embed_oembed_html", "youtube_nocookie_solution", 10, 4);

function iframe_cookie_lazy_load($content) {
    $current_setup = Extensions_Plugin_Setup::instance();
    $actual_link = get_the_currentURL();

    if (empty($content) || !$current_setup->get("cookieconsent_enabled")) {
        return $content;
    } else {
        libxml_use_internal_errors(true);
        $post = new DOMDocument();
        $post->loadHTML(mb_convert_encoding($content, "HTML-ENTITIES", "UTF-8"));
        $iframes = $post->getElementsByTagName("iframe");
        if ((!isset($_COOKIE["cookieconsent_estatus"]) || $_COOKIE["cookieconsent_estatus"] != "allow") && !isWebBot()) {
            if (count($iframes) > 0 && !headers_sent()) {
                header("Cache-Control: no-cache, no-store, must-revalidate");
            }
            foreach ($iframes as $iframe) {
                if ($iframe->hasAttribute("data-src") || $iframe->hasAttribute("internal")) {
                    continue;
                }
                $clone = $iframe->cloneNode();
                $src = $iframe->getAttribute("src");
                if (str_contains($src, $_SERVER["HTTP_HOST"])) {
                    continue;
                }

                $disclaimer  = '<hr style="width:50%;text-align:center;margin:20px auto"><div class="cookies"><h3>'. esc_html__("Third-party cookies", DJS_EXTENSIONS_PLUGIN).'</h3><div class="inner cookies">';
                $disclaimer .= '<p class="cookies justify"><b>'. esc_html__("Hint:", DJS_EXTENSIONS_PLUGIN).'</b> ' . mb_convert_encoding($current_setup->get("cookie_before"), 'HTML-ENTITIES') . "</p>";
                $disclaimer .= '<form class="cookies center" action="' . $actual_link . '"><button class="btn" onclick="document.cookie=\'cookieconsent_estatus=allow;path=/;SameSite=Lax\'; location.reload(true);" type="button">' . mb_convert_encoding($current_setup->get("cookie_link"), 'HTML-ENTITIES') . '</button></form>';
                $disclaimer .= '<p class="cookies justify">' . mb_convert_encoding($current_setup->get("cookie_after"), 'HTML-ENTITIES') . '</p></div></div>';
                $disclaimer .= '<div class="lcd crt"><a href="' . $src . '" target="_blank">' . $src . '</a></div><hr style="width:50%;text-align:center;margin:20px auto">';

                $cookieNode = $post->createElement("div");
                appendHTML($cookieNode, $disclaimer);

                $sanbox = str_replace("allow-same-origin", "", $iframe->getAttribute("sandbox"));
                if (isset($sandbox)) {
                    $iframe->setAttribute("sandbox", $sandbox);
                }

                $iframe->parentNode->insertBefore($cookieNode, $iframe);
                $iframe->removeAttribute("src");
                $iframe->setAttribute("data-src", $src);
                $srcset = $iframe->getAttribute("srcset");
                $iframe->removeAttribute("srcset");
                if (!empty($srcset)) {
                    $iframe->setAttribute("data-srcset", $srcset);
                }
                $iframeClass = $iframe->getAttribute("class");
                $iframe->setAttribute("class", $iframeClass . " lazy notShow");
            }
        }
        return $post->saveHTML();
    }
}
add_filter("the_content", "iframe_cookie_lazy_load", 15);

function appendHTML(DOMNode $parent, $source) {
    $tmpDoc = new DOMDocument();
    $tmpDoc->loadHTML($source);
    foreach ($tmpDoc->getElementsByTagName("body")->item(0)->childNodes as $node) {
        $node = $parent->ownerDocument->importNode($node, true);
        $parent->appendChild($node);
    }
}

if(!function_exists('isWebBot')) {
    function isWebBot() {
        return (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/rambler|abacho|acoi|accona|aspseek|altavista|estyle|scrubby|lycos|geona|ia_archiver|alexa|sogou|skype|facebook|twitter|pinterest|linkedin|naver|bing|google|yahoo|duckduckgo|yandex|baidu|teoma|xing|bot|crawl|slurp|spider|mediapartners|\sask\s|\saol\s/i', $_SERVER['HTTP_USER_AGENT']));
    }
}
?>
