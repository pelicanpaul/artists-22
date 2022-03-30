
var utility = {
    getParameterByName: function(name) {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regexS = "[\\?&]" + name + "=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(window.location.search);
        if(results == null)
            return "";
        else
            return decodeURIComponent(results[1].replace(/\+/g, " "));
    },

    isMobile: function(){
        if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            return 'true';
        }
    },

    getInternetExplorerVersion: function() {
        var rv = -1; // Return value assumes failure.
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv;
    },

    setCookie: function (cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    },

    getCookie: function(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
        }
        return "";
    },

    checkCookie: function (cname) {
        var cookie = utility.getCookie(cname);
        var result = false;

        if (cookie != "" && cookie != null) {
            result = true;
        }

        return result;

    },

    getExternalLink: function(url){
        var extLink = jQuery('#external-link-go');
        jQuery(extLink).attr('rel', url);
        var counter = 0;

        jQuery(extLink).click(function(){
            var rel = jQuery(this).attr('rel');
            //console.log(rel);
            if(counter == 0){
            window.open(rel);
            }
            counter++
        })
    },

    numberWithCommas: function(x){
         return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


};

var animation = {

    numberCounter: function(o, $) {

        var delay = o.data('delay');
        var speed = o.data('speed');
        var start = o.data('start');
        var extra = o.data('extra');

        if(extra === undefined){
            extra = '';
        }

        var numCountNum = o.data('total') -1;
        var numDisplay = '';

        setTimeout(
            function () {

                var numCountStart = start;

                var numCounter = setInterval(function () {

                    if (numCountStart <= numCountNum) {
                        numDisplay = numCountStart + 1;
                        o.text(numDisplay);
                        numCountStart = numCountStart + 1;
                    } else {
                        o.text(utility.numberWithCommas(numDisplay) + '+');
                        clearInterval(numCounter);
                    }

                }, speed);

            }, delay);
    },

}


jQuery(document).ready(function($) {

    var windowWidth = $(window).innerWidth();
    var windowHeight = $(window).innerHeight();


    $('.navbar-toggler').click(function(){

        var expanded = $(this).attr('aria-expanded');

        var mainMenu = $('#main-menu')

        if(expanded == 'true'){
            mainMenu.addClass('open');

        } else {
            mainMenu.removeClass('open');
        }



    });

    // hero slide show
    var heroImages = $('.container-hero-images');
    var heroImagesItems = heroImages.find('.inner-hero-images');
    var heroImagesItemsLen = heroImagesItems.length - 1;

    // set this up
    var counter = 1; // second image
    heroImagesItems.eq(0).show(); // show first image

    var slideShow = setInterval(function(){

        if(counter <= heroImagesItemsLen){

            heroImagesItems.fadeOut( 1200, function() {
                // Animation complete.
            });
            heroImagesItems.eq(counter).fadeIn( 1200, function() {
                // Animation complete.
            });

            if(counter == heroImagesItemsLen){
                counter = 0;
            } else {
                counter++;
            }

        }

    }, 3800);



    var violator = $('section.violator');

    if(violator){

        setTimeout(function() {

            var cookieViolator = utility.getCookie('gc-violator');

            if(!cookieViolator){
                violator.clone().prependTo('header').fadeIn('slow');
            }

            $('.close-violator').click(function(e){

                e.preventDefault();

                var violatorNew = $('section.violator');

                violatorNew.fadeOut();

                if(!cookieViolator){
                    utility.setCookie('gc-violator','true', 7);
                }

            })

        }, 3000);
    }


    // init plugins

    //  disable: 'mobile'

        AOS.init({
            easing: 'ease',
        });

    // blog tweaks for bootstrap

    $('.blog-content img').addClass('img-fluid');

    $('p.form-submit .submit').addClass('btn btn-primary');

    // scroll to

    $('.go-to-id').on('click', function(e){
        e.preventDefault();
        var hash = $(this).data('hash');
        var hashId = $('#' + hash);

        $('html, body').stop().animate({
            scrollTop: hashId.offset().top
        }, 900, 'easeInOutExpo');

    });

    // back to top

    $('.scroll-to-top').click(function (e) {
        e.preventDefault();

        $('html, body').stop().animate({
            scrollTop: 0
        }, 1500, function () {
            window.location.hash = '';
        });
    });


    // scroll thingy

    // to top right away
    var targetHash =  window.location.hash;
    var sectionToClick = utility.getParameterByName('section');

    if ( targetHash ) scroll(0,0);
    // void some browsers issue
    setTimeout( function() { scroll(0,0); }, 1);


    if ( targetHash ) {
        var anchorHref = targetHash;

        var theSpot = jQuery(anchorHref).offset().top - 117;

        setTimeout(function () {
            $('html, body').stop().animate({
                scrollTop: theSpot
            }, 1000, 'easeInOutExpo');
        }, 500);

        if((sectionToClick.length) && (windowWidth > 992)) {

            setTimeout(function () {
                $('#' + sectionToClick).click();
            }, 2500);

        }
    }

    // carousel basic

    var carouselBasic = $('.carousel-basic');

    carouselBasic.flickity({
        autoPlay: 4000,
        cellAlign: 'left',
        contain: true,
        imagesLoaded: true,
        prevNextButtons: true,
        pageDots: false,
        groupCells: true,
        wrapAround: true,
        arrowShape: 'M73.8,99.9l-50-50l50-50l2.4,2.4L28.6,49.9l47.6,47.6L73.8,99.9z',
    });

    var carouselQuotes = $('.quotes-carousel');

    carouselQuotes.flickity({
        autoPlay: 4000,
        cellAlign: 'left',
        contain: true,
        imagesLoaded: true,
        prevNextButtons: true,
        pageDots: true,
        groupCells: true,
        wrapAround: true,
        arrowShape: 'M73.8,99.9l-50-50l50-50l2.4,2.4L28.6,49.9l47.6,47.6L73.8,99.9z',
    });

    //faq

    $('article.accordion-item').on('click', function(){

        if($(this).hasClass('active')){
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }

        var content = $(this).find('.accordion-content');
        content.slideToggle();

    });





});

