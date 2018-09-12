//add active class to nav link
(function () {
    $('ul.nav a[href="' + window.location.href + '"]').parent().addClass('active');
})();