function setConsentCookie(name, value) {
    var secure = location.protocol === "https:" ? ";Secure" : "";
    document.cookie = name + "=" + value + ";path=/;SameSite=Lax" + secure;
}
function allowCookieConsent() {
    setConsentCookie("cookieconsent_estatus=", "allow");
    location.reload(true);
}

function allowScriptConsent() {
    setConsentCookie("scriptconsent_estatus", "allow");
    location.reload(true);
}
function dismissScriptConsent() {
    setConsentCookie("scriptconsent_estatus", "dismiss");
    document.getElementById("script_fullscreen").classList.remove("open");
}
function allowAllConsent() {
    setConsentCookie("cookieconsent_estatus", "allow");
    setConsentCookie("scriptconsent_estatus", "allow");
    location.reload(true);
}

function denyAllConsent() {
    // bisherigen Status auslesen
    var oldCookie = document.cookie.match(/(?:^|;\s*)cookieconsent_estatus=([^;]+)/);
    var oldStatus = oldCookie ? oldCookie[1] : null;

    setConsentCookie("cookieconsent_estatus", "dismiss");
    setConsentCookie("scriptconsent_estatus", "dismiss");

    var el = document.getElementById("script_fullscreen");
    if (el) el.classList.remove("open");

    // wenn vorher "allow", dann Reload
    if (oldStatus === "allow") {
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
