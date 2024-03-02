function setLocation(link) {
    window.location = link;
}

$(document).ready(function () {

    // Initialize tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Popover
    $('[data-toggle="popover"]').popover({
        html: true,
        content: function () {
            return $('#popover-content').html();
        }
    });

    // prettyPhoto for YouTube Videos
    $("a[rel^='prettyPhoto']").prettyPhoto();

    // Ketika dimobile menutup navbar hamburger setelah mengklik menu didalamnya
    $('.navbar-collapse ul li a.primary-menu').click(function () {
        $('.navbar-toggle:visible').click();
    });

    // Membuat carousel caption pada bootstrap carousel image berada diluar
    // http://codepen.io/RetinaInc/pen/GJbpB
    $("#carousel").on('slide.bs.carousel', function (evt) {
        var step = $(evt.relatedTarget).index();
        var imageUrl = $(evt.relatedTarget).data('bg');
        
        if(imageUrl) {
            $('#bendera').css('background-image', 'url('+ imageUrl  +')');
        } else {
            imageUrl = '/templates/frontend/img/slider/bendera.png';
           $('#bendera').css('background-image', 'url('+ imageUrl  +')');
        }
        
        $('#slider_captions .carousel-caption:not(#caption-' + step + ')').fadeOut('fast', function () {
            $('#caption-' + step).fadeIn();
        });
    });

    // File: beranda-pusat-organisasi.html, beranda-pusat.html
    // Pada bagian artikel, memunculkan gambar besar ketika gambar kecil artikel diklik
    /*
     $('.video-thumb').click(function(){
     var srcvideo = $(this).attr('src');
     var youtubetitle = $('.youtube-title').text();
     
     if (srcvideo == "assets/img/video-slider1.png") {
     srcvideo = "https://www.youtube.com/embed/JXxBkS7GLc0";
     youtubetitle = "Pembangunan Trans Papua diutamakan PUPR";
     } else if (srcvideo == "assets/img/video-slider2.png") {
     srcvideo = "https://www.youtube.com/embed/VSn4R4AQlkI";
     youtubetitle = "Beratnya Pembangunan Trans Papua";
     } else if (srcvideo == "assets/img/video-slider3.png") {
     srcvideo = "https://www.youtube.com/embed/4pt7LHbsIkE";
     youtubetitle = "Seperti Apa Jalan Trans Papua Yang Dibuat TNI?";
     } else {
     
     }
     
     $('.video-thumb').attr('class', 'img-responsive video-thumb');
     $(this).attr('class', 'img-responsive video-thumb active');
     $('.youtube-video').fadeOut('fast').attr('src', srcvideo).fadeIn('fast');
     $('.youtube-title').fadeOut('fast').text(youtubetitle).fadeIn('fast');
     });
     */

    // File: beranda-pusat-organisasi.html, beranda-pusat.html
    // Pada bagian artikel, memunculkan gambar besar ketika gambar kecil artikel diklik

    /* 
     $('.thumb').click(function(){
     var srcimg = $(this).attr('src');
     
     if (srcimg == "assets/img/artikel-thumb1.png") {
     srcimg = "assets/img/artikel1.png";
     } else if (srcimg == "assets/img/artikel-thumb2.png") {
     srcimg = "assets/img/artikel2.png";
     } else if (srcimg == "assets/img/artikel-thumb3.png") {
     srcimg = "assets/img/artikel3.png";
     } else if (srcimg == "assets/img/artikel-thumb4.png") {
     srcimg = "assets/img/artikel4.png";
     } else {
     
     }
     
     // File: pusat-berita.html
     if (srcimg == "assets/img/pusat-berita/berita-terkait1.png") {
     srcimg = "assets/img/pusat-berita/video1.png";
     } else if (srcimg == "assets/img/pusat-berita/berita-terkait2.png") {
     srcimg = "assets/img/pusat-berita/video2.png";
     } else if (srcimg == "assets/img/pusat-berita/berita-terkait3.png") {
     srcimg = "assets/img/pusat-berita/video3.png";
     } else {
     
     }
     
     $('.thumb').attr('class', 'img-responsive thumb');
     $(this).attr('class', 'img-responsive thumb active');
     $('.artikel-img').fadeOut('fast').attr('src', srcimg).fadeIn('fast');
     $('.prettyPhoto').attr('href', srcimg);
     });
     
     // beranda-pusat.html
     // Membuat Berita Slider
     var currentIndex = 0,
     items = $('#berita-slider .slider .container .slide'),
     itemAmt = items.length;
     
     function cycleItems() {
     var item = $('#berita-slider .slider .container .slide').eq(currentIndex);
     items.hide();
     item.css('display','inline-block');
     }
     
     var autoSlide = setInterval(function() {
     currentIndex += 1;
     if (currentIndex > itemAmt - 1) {
     currentIndex = 0;
     }
     cycleItems();
     }, 5000);
     
     $('#berita-slider .slider .next').click(function() {
     clearInterval(autoSlide);
     currentIndex += 1;
     if (currentIndex > itemAmt - 1) {
     currentIndex = 0;
     }
     cycleItems();
     });
     
     $('#berita-slider .slider .prev').click(function() {
     clearInterval(autoSlide);
     currentIndex -= 1;
     if (currentIndex < 0) {
     currentIndex = itemAmt - 1;
     }
     cycleItems();
     });
     */

    // Back to Top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });

    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');

        $('body, html').animate({
            scrollTop: 0
        }, 800);

        return false
    });

    $('#back-to-top').tooltip('show');
    
    var dayNames = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    
    var monthNames = ["Januari", "February", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
      ];

    
    var updateClock = function () {
        function pad(n) {
            return (n < 10) ? '0' + n : n;
        }

        var now = new Date();
        
        var s = 
                pad(dayNames[now.getDay()]) + ', ' +
                pad(now.getDate()) + ' ' +
                pad(monthNames[now.getMonth()]) + ' ' +
                pad(now.getFullYear()) + ' | ' +
                pad(now.getHours()) + ':' +
                pad(now.getMinutes()) + ':' +
                pad(now.getSeconds());

        $('#clock').html(s);

        var delay = 1000 - (now % 1000);
        setTimeout(updateClock, delay);
    };
    updateClock();
    
    var social = '<li class="social-list"><a target="_blank" href="http://twitter.com/kemenPU"><i class="fa fa-twitter"></i></a></li>' +
    '<li class="social-list"><a href="http://facebook.com/publikasi.kementerianpu" target="_blank"><i class="fa fa-facebook"></i></a></li>' +
    '<li class="social-list"><a href="http://youtube.com/user/kemenPU" target="_blank"><i class="fa fa-youtube"></i></a></li>' +
    '<li class="social-list"><a href="http://instagram.com/kemenpupr" target="_blank"><i class="fa fa-instagram"></i></a></li>';
    
    //$('#contact-footer').append(social);
    
});
