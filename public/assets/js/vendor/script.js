
$(document).ready(function() {
    
    $('#forgot_username_link').tipsy({gravity: 'w'});
                 
                $('.iosSlider').iosSlider({
                    desktopClickDrag: true,
                    snapToChildren: true,
                    navSlideSelector: '.sliderContainer .slideSelectors .item',
                    onSlideComplete: slideComplete,
                    onSliderLoaded: sliderLoaded,
                    onSlideChange: slideChange,
                    autoSlide: true,
                    scrollbar: true,
                    scrollbarContainer: '.sliderContainer .scrollbarContainer',
                    scrollbarMargin: '0',
                    scrollbarBorderRadius: '0'
                });
                
            });
            
            function slideChange(args) {
                        
                $('.sliderContainer .slideSelectors .item').removeClass('selected');
                $('.sliderContainer .slideSelectors .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');
            
            }
            
            function slideComplete(args) {
                
                if(!args.slideChanged) return false;
                
                $(args.sliderObject).find('.text1, .text2').attr('style', '');
                
                $(args.currentSlideObject).find('.text1').animate({
                    left: '50px',
                    opacity: '1'
                }, 400, 'easeOutQuint');
                
                $(args.currentSlideObject).find('.text2').delay(200).animate({
                    left: '50px',
                    opacity: '1'
                }, 400, 'easeOutQuint');
                
            }
            
            function sliderLoaded(args) {
                    
                $(args.sliderObject).find('.text1, .text2').attr('style', '');
                
                $(args.currentSlideObject).find('.text1').animate({
                    left: '50px',
                    opacity: '1'
                }, 400, 'easeOutQuint');
                
                $(args.currentSlideObject).find('.text2').delay(200).animate({
                    left: '50px',
                    opacity: '1'
                }, 400, 'easeOutQuint');
                
                slideChange(args);
                
            }
            
            
           $(function () {
                
                $(".ticker1").modernTicker({
                    effect: "scroll",
                    scrollInterval: 20,
                    transitionTime: 500,
                    autoplay: true
                });
                
                $(".ticker2").modernTicker({
                    effect: "fade",
                    displayTime: 4000,
                    transitionTime: 300,
                    autoplay: true
                });
                
                $(".ticker3").modernTicker({
                    effect: "type",
                    typeInterval: 10,
                    displayTime: 4000,
                    transitionTime: 300,
                    autoplay: true
                });
                
                $(".ticker4").modernTicker({
                    effect: "slide",
                    slideDistance: 100,
                    displayTime: 4000,
                    transitionTime: 350,
                    autoplay: true
                });
                
            });
            
            $(function() {
                $('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });       
            }); 
         