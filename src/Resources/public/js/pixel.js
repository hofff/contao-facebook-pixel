
var HofffFacebookPixel = function () {
    this.cookieName = "FB_PIXEL_OPTOUT=";

    document.querySelectorAll('.fb-opt-out-link').forEach(function (element) {
        element.addEventListener('click', this.checkFacebookCookie.bind(this));
    }.bind(this));
};

HofffFacebookPixel.prototype.checkFacebookCookie = function (event) {
    if (event) {
        event.preventDefault();
    }

    if(this.readFacebookCookie() === '1') {
        document.querySelectorAll('.fb-opt-out-active').forEach(function (element) {
            element.style.display = "block";
        });

        document.querySelectorAll('.fb-opt-out-inactive').forEach(function (element) {
            element.style.display = "none";
        });

        this.deleteFacebookCookie();
    } else {
        document.querySelectorAll('.fb-opt-out-active').forEach(function (element) {
            element.style.display = "none";
        });

        document.querySelectorAll('.fb-opt-out-inactive').forEach(function (element) {
            element.style.display = "block";
        });

        this.setFacebookCookie();
    }

    return false;
};

HofffFacebookPixel.prototype.readFacebookCookie = function ()
{
    var cookies = document.cookie.split(';');

    for(var i=0; i < cookies.length; i++) {
        var cookie = cookies[i];

        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1,cookie.length);
        }

        if (cookie.indexOf(this.cookieName) === 0) {
            return cookie.substring(this.cookieName.length,cookie.length);
        }
    }
    return null;
};

HofffFacebookPixel.prototype.setFacebookCookie = function ()
{
    document.cookie = this.cookieName + "1;expires=Thu, 01 Jan 2099 23:59:59 GMT;path=/";
};

HofffFacebookPixel.prototype.deleteFacebookCookie = function ()
{
    if(this.readFacebookCookie()) {
        document.cookie = this.cookieName + "0;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT";
    }
};

document.addEventListener("DOMContentLoaded", function() {
    new HofffFacebookPixel();
});
