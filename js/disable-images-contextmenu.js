// JavaScript
var preventDefault = function(e) {
    e.preventDefault();
}
var disableImagesContextmenu = function() {
    var images = document.getElementsByTagName('img');
    for(var i = 0; i < images.length; i++) {
        images[i].addEventListener('contextmenu', preventDefault);
        images[i].addEventListener('click', timeoutDisableImagesContextmenu);
    }
}
var timeoutDisableImagesContextmenu = function() {
    setTimeout(disableImagesContextmenu, 500);
}
window.addEventListener('DOMContentLoaded', disableImagesContextmenu);

// jQuery
(function($) {
    $('img').bind('contextmenu', function(e){
        return false;
    });
})(jQuery);
