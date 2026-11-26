// Gueltigkeit aus dem Customizer (djsConsentCookieDays, siehe scripts.php):
// 0 = Sitzungs-Cookie, gilt bis zum Schliessen des Browsers
function setConsentCookie(name, value) {
    var secure = location.protocol === "https:" ? ";Secure" : "";
    var days = typeof djsConsentCookieDays === "number" ? djsConsentCookieDays : 0;
    var maxAge = days > 0 ? ";Max-Age=" + Math.round(days * 86400) : "";
    document.cookie = name + "=" + value + ";path=/;SameSite=Lax" + maxAge + secure;
}
function getConsentCookie(name) {
    var match = document.cookie.match(new RegExp("(?:^|;\\s*)" + name + "=([^;]*)"));
    return match ? match[1] : null;
}
function allowCookieConsent() {
    setConsentCookie("cookieconsent_estatus", "allow");
    location.reload(true);
}

function allowScriptConsent() {
    setConsentCookie("scriptconsent_estatus", "allow");
    location.reload(true);
}
function dismissScriptConsent() {
    var oldStatus = getConsentCookie("scriptconsent_estatus");
    setConsentCookie("scriptconsent_estatus", "dismiss");
    document.getElementById("script_fullscreen").classList.remove("open");

    // bereits geladene Skripte verschwinden erst mit dem Neuladen
    if (oldStatus === "allow") {
        location.reload();
    }
}

// Schliessen (X, Escape) ohne Auswahl gilt als Ablehnung - sonst erscheint der Dialog bei
// jedem Seitenaufruf erneut. Eine frueher getroffene Entscheidung bleibt dabei unveraendert.
function closeScriptConsent() {
    if (getConsentCookie("scriptconsent_estatus") === null) {
        setConsentCookie("scriptconsent_estatus", "dismiss");
    }
    var el = document.getElementById("script_fullscreen");
    if (el) el.classList.remove("open");
}
function allowAllConsent() {
    setConsentCookie("cookieconsent_estatus", "allow");
    setConsentCookie("scriptconsent_estatus", "allow");
    location.reload(true);
}

function denyAllConsent() {
    // bisherigen Status auslesen
    var oldStatus = getConsentCookie("cookieconsent_estatus");
    var oldScriptStatus = getConsentCookie("scriptconsent_estatus");

    setConsentCookie("cookieconsent_estatus", "dismiss");
    setConsentCookie("scriptconsent_estatus", "dismiss");

    var el = document.getElementById("script_fullscreen");
    if (el) el.classList.remove("open");

    // wenn vorher "allow", dann Reload
    if (oldStatus === "allow" || oldScriptStatus === "allow") {
        location.reload();
    }
}

function toggleScriptConsent() {
    var el = document.getElementById("script_fullscreen");
    if (!el) return;

    if (el.classList.contains("open")) {
        el.classList.remove("open");
    } else {
        el.classList.add("open");
    }
}
