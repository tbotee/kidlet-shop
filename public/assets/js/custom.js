function triggerAlert(message, success = false) {
    const alertBox = document.getElementById('alertBox');
    const alertMessage = document.getElementById('alertMessage');
    alertMessage.innerText = message;
    if (success) {
        alertBox.classList.add('success');
    } else {
        alertBox.classList.remove('success');
    }
    alertBox.classList.add('show');

    setTimeout(() => {
        closeAlert();
    }, 3000);
}

function closeAlert() {
    const alertBox = document.getElementById('alertBox');

    alertBox.classList.remove('show');
}

(function ($) {

	"use strict";
	$('.owl-men-item').owlCarousel({
		items:5,
		loop:true,
		dots: true,
		nav: true,
		margin:30,
		  responsive:{
			  0:{
				  items:1
			  },
			  600:{
				  items:2
			  },
			  1000:{
				  items:3
			  }
		 }
	})

	$('.owl-women-item').owlCarousel({
		items:5,
		loop:true,
		dots: true,
		nav: true,
		margin:30,
		  responsive:{
			  0:{
				  items:1
			  },
			  600:{
				  items:2
			  },
			  1000:{
				  items:3
			  }
		 }
	 })

	$('.owl-kid-item').owlCarousel({
		items:5,
		loop:true,
		dots: true,
		nav: true,
		margin:30,
		  responsive:{
			  0:{
				  items:1
			  },
			  600:{
				  items:2
			  },
			  1000:{
				  items:3
			  }
		 }
	 })

    function setMenuVisibility() {
        var scroll = $(window).scrollTop();
        var box = $('#top').height();
        var header = $('header').height();

        if (scroll > header) {
            $("header").addClass("background-header");
        } else {
            $("header").removeClass("background-header");
        }
    }

	$(window).scroll(function() {
        setMenuVisibility();
	});

    setMenuVisibility();


	// Window Resize Mobile Menu Fix
	mobileNav();


	// Scroll animation init
	window.sr = new scrollReveal();


	// Menu Dropdown Toggle
	if($('.menu-trigger').length){
		$(".menu-trigger").on('click', function() {
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}


	// Menu elevator animation
	$('.scroll-to-section a[href*=\\#]:not([href=\\#])').on('click', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				var width = $(window).width();
				if(width < 991) {
					$('.menu-trigger').removeClass('active');
					$('.header-area .nav').slideUp(200);
				}
				$('html,body').animate({
					scrollTop: (target.offset().top) - 80
				}, 700);
				return false;
			}
		}
	});

	// Page loading animation
	$(window).on('load', function() {
		if($('.cover').length){
			$('.cover').parallax({
				imageSrc: $('.cover').data('image'),
				zIndex: '1'
			});
		}

		$("#preloader").animate({
			'opacity': '0'
		}, 600, function(){
			setTimeout(function(){
				$("#preloader").css("visibility", "hidden").fadeOut();
			}, 300);
		});
	});


	// Window Resize Mobile Menu Fix
	$(window).on('resize', function() {
		mobileNav();
	});


	// Window Resize Mobile Menu Fix
	function mobileNav() {
		var width = $(window).width();
		$('.submenu').on('click', function() {
			if(width < 767) {
				$('.submenu ul').removeClass('active');
				$(this).find('ul').toggleClass('active');
			}
		});
	}

    function fetchCartData() {
        return fetch('/cart')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            });
    }

    function updateCartNumber(data) {
        const nrOfElements = document.getElementById('nr-of-elements-in-cart');
        nrOfElements.innerText = data.cartItems;
        const $mobileCart = $('.mobile-cart-number');
        $mobileCart.text(data.cartItems);

        nrOfElements.classList.add('flicker-cart');
        $mobileCart.addClass('flicker-cart');
        setTimeout(function() {
            nrOfElements.classList.remove('flicker-cart');
            $mobileCart.removeClass('flicker-cart');
        }, 1000);
    }

    $(document).ready(function(){
        const cartPanel = document.getElementById('cart-panel');

        $(document).on('click', '.add-to-cart' ,function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

            cartPanel.classList.remove('open');

            fetch('/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    product_id: id,
                }),
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw new Error(errorData.message || 'Something went wrong');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    updateCartNumber(data);
                    triggerAlert(data.message, true);
                })
                .catch(error => {
                    triggerAlert(error.message);
                });
        });

        const closeCartBtn = document.querySelector('.close-cart');

        $(document).on('click', '.shopping-cart-in-menu, .mobile-cart', function(event) {
            if (!cartPanel.classList.contains('open')) {
                fetchCartData()
                    .then(html => {
                        document.querySelector('#cart-items').innerHTML = html;
                        cartPanel.classList.add('open');
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            } else {
                cartPanel.classList.remove('open');
            }

            event.preventDefault();
        });

        closeCartBtn.addEventListener('click', function() {
            cartPanel.classList.remove('open');
        });

        $(document).on('click', '.remove-item-from-cart' ,function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

            const div = document.getElementById('cart-items');

            fetch('/cart/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw new Error(errorData.message || 'Something went wrong');
                        });
                    }
                    return response.json();
                })
                .then((data) => {
                    updateCartNumber(data);
                    return fetchCartData();
                })
                .then(html => {
                    console.log(html);
                    div.innerHTML = html;
                })
                .catch(error => {
                    triggerAlert(error.message);
                });
        });
    });


})(window.jQuery);
