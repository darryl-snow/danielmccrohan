$("document").ready(function() {

	$('.carousel').carousel();
    $(".carousel").touchwipe({
        wipeLeft: function() {
            $('.carousel').carousel('next');
        },
        wipeRight: function() {
            $('.carousel').carousel('prev');
        }
    });
	
});