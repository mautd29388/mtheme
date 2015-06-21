$(document).ready(function() {
  "use strict";

	/* Navigation */
	$(".js-open-navigation").click(function() {

		$(this).toggleClass("opened");
		$(".main-navigation").slideToggle('slow');

	})

	/* Instagram Feed */
    var feed = new Instafeed({
        get: 'tagged',
        tagName: 'fitness',
        clientId: '19003a1ce8df47849e147814a2403c48',
        template: '<a href="{{link}}" target="_blank"><img src="{{image}}" width="60" /></a>',
        limit: 8,
        sortBy: 'random',
        resolution: 'low_resolution'

    });
    feed.run();


    /* Backstrech logic */
    $(".js-backstrech").each(function() {
         $(this).backstretch($(this).attr("data-image"));
    })

    /* Alert system */
    $(".alert-f .close a").on('click', function(e) {
        e.preventDefault();
        var holder = $(this).parent(".close");
        holder = holder.parent(".alert-f");
        console.log(holder);
        holder.slideUp("slow", function() {
            holder.remove();
        });
    });

    /* Before and After images */
    $(".js-before-after").twentytwenty();

    /* Slider init */
    if ($('.banner').length > 0) {
        $('.banner').revolution({
            delay:                     6e3,
            startwidth:                1420,
            startheight:               590,
            onHoverStop:               "on",
            thumbWidth:                100,
            thumbHeight:               50,
            thumbAmount:               3,
            hideThumbs:                0,
            navigationType:            "none",
            navigationArrows:          "solo",
            navigationStyle:           "round",
            navigationHAlign:          "center",
            navigationVAlign:          "bottom",
            navigationHOffset:         30,
            navigationVOffset:         30,
            soloArrowLeftHalign:       "left",
            soloArrowLeftValign:       "center",
            soloArrowLeftHOffset:      20,
            soloArrowLeftVOffset:      0,
            soloArrowRightHalign:      "right",
            soloArrowRightValign:      "center",
            soloArrowRightHOffset:     20,
            soloArrowRightVOffset:     0,
            touchenabled:              "on",
            stopAtSlide:               -1,
            stopAfterLoops:            -1,
            hideCaptionAtLimit:        0,
            hideAllCaptionAtLilmit:    0,
            hideSliderAtLimit:         0,
            fullWidth:                 "on",
            fullScreen:                "off",
            shadow:                    0
        });
    };

    /* Share plugin (social sharing) */
     $('.share-plugin').share({
          networks: ['googleplus','facebook','twitter', 'stumbleupon'],
          theme: 'square'
      });

    /* Google MAPS init */
    var map;
    $(".js-map").each(function() {

        map = new GMaps({
          div: $(this).attr("data-map"),
          lat: $(this).attr("data-lat"),
          lng: $(this).attr("data-lng"),
          zoom: parseInt($(this).attr("data-start-zoom"))
        });

        var choosenStyle = $(this).attr("data-style");

        if ( choosenStyle == "black-white" ) {
            var styles =  [ { "featureType": "landscape.natural", "stylers": [ { "color": "#808080" }, { "lightness": 68 } ] },{ "featureType": "road.highway", "stylers": [ { "color": "#808080" } ] },{ "featureType": "poi.park", "stylers": [ { "color": "#808080" }, { "lightness": 58 } ] },{ "featureType": "water", "stylers": [ { "color": "#808080" }, { "lightness": 45 } ] },{ "featureType": "landscape.man_made", "stylers": [ { "color": "#808080" }, { "lightness": 25 } ] } ];
            var styledMap = new google.maps.StyledMapType(styles,
            {name: "Styled Map"});
            map.setOptions({styles: styles});
        } else {
            return;
        }

        $(this).find(".map-marker").each(function() {
           var marker = map.addMarker({
              lat: $(this).attr("data-lat"),
              lng: $(this).attr("data-lng"),
              title: $(this).attr("data-title"),
              icon: 'img/marker.png'
            });
           console.log( marker );
        });

    });

    /* Paralax */
    $.stellar({
        horizontalScrolling: false,
        verticalOffset: 40
    });

    /* Price slider */
     $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 75, 300 ],
        slide: function( event, ui ) {
           $(".js-min-amount").html( ui.values[ 0 ] + "$" );
           $(".js-max-amount").html( ui.values[ 1 ] + "$" );
        }
    });

     /* Initialize custom checkboxes */
     $("input[type='checkbox']").iCheck({
            checkboxClass: 'icheckbox_minimal-grey',
            radioClass: 'iradio_minimal-grey'
      });

    $("input[type='checkbox']").on('ifChecked', function(event){
      $("."+ $(this).attr("data-check")).iCheck('check');
    });

    $("input[type='checkbox']").on('ifUnchecked', function(event){
      $("."+ $(this).attr("data-check")).iCheck('uncheck');
    });

     /* Single product images */
    $(".js-product-thumbnails img").on('click', function() {
      $(".js-main-product-image").attr("src", $(this).attr("src"));
      $(".js-product-thumbnails img.active").removeClass("active");
      $(this).addClass("active");
    })
    
  /* Closing/opening divs */
  $(".js-open-div").on('click', function(ev) {
      ev.preventDefault();
      var div = "." + $(this).attr( "data-open" );
      $(div).slideToggle('slow');
  });
  $(".js-close-div").on('click', function(ev) {
      ev.preventDefault();
      var div = "." + $(this).attr( "data-close" );
      $(div).slideToggle('slow');
  });

  /* Filtration of classes */
  var d=new Date();
  var weekday=new Array(7);
  weekday[0]="SUNDAY";
  weekday[1]="MONDAY";
  weekday[2]="TUESDAY";
  weekday[3]="WEDNESDAY";
  weekday[4]="THURSDAY";
  weekday[5]="FRIDAY";
  weekday[6]="SATURDAY";

  var current_day = weekday[d.getDay()]; 

  $(".js-filter-days-classes a").click( function(e) {
    e.preventDefault();
    $(".js-filter-days-classes a.active").removeClass();
    $(this).addClass("active");
    value = $(this).attr("data-value");
    if (value == "TODAY") {
      console.log(current_day);
      $('.day-filter[data-day!="'+current_day+'"]').fadeOut();
    } else {
      $('.day-filter').fadeIn();
    }
  });

  $('.js-filter-classes-type').on('change', function() {
    $('.single-class').show();
    if ($(this).val() == "all") {
      $('.single-class').show();
    } else {
      $('.single-class[data-class!="'+ $(this).val() +'"]').hide();
    }
  });

  /* Checkboxes toggle */
    $("input[data-check]").click(function() {
      console.log("test");
        var checkBoxes = $("."+$(this).attr('input[data-check]'));
        console.log(checkBoxes);
        checkBoxes.attr("checked", !checkBoxes.attr("checked"));
    });

  /* Cart responsive */
  $(".cart").click( function(e) {
    e.preventDefault();
    $(".cart-product").slideToggle( 1200 );
  });

  /* Plans ribbon */
  $(".ribbon-wrapper").css({
    "width": $(".ribbon-wrapper").width() + 20 +"px"
  });

});


