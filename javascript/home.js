
document.querySelector('.btn-register').addEventListener('click', function(e) {
    console.log('Register button clicked');
  });
  
document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".home-slider", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        effect: "fade",
        fadeEffect: {
            crossFade: true,
        },
    });
});
/*about*/
document.querySelectorAll('.control-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const videoSrc = this.getAttribute('data-src');
        const videoElement = document.querySelector('.video');
        videoElement.src = videoSrc;
        videoElement.play();
    });
});

document.addEventListener("DOMContentLoaded", function () {

    const aboutElements = document.querySelectorAll('.about .content, .about .video-container');

   
    const options = {
        root: null, 
        rootMargin: '0px',
        threshold: 0.5 
    };
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, options);

    aboutElements.forEach(element => {
        observer.observe(element);
    });
});
/*service*/
document.addEventListener("DOMContentLoaded", function () {
    const serviceBoxes = document.querySelectorAll(".service-box");

    function showServices() {
        serviceBoxes.forEach((box) => {
            const boxTop = box.getBoundingClientRect().top;
            const trigger = window.innerHeight - 100;
            if (boxTop < trigger) {
                box.classList.add("show");
            }
        });
    }
    
    window.addEventListener("scroll", showServices);
    showServices(); 
});
/*Special Offers*/
document.addEventListener("DOMContentLoaded", function () {
    const offerBoxes = document.querySelectorAll(".offer-box");

    function showOffers() {
        offerBoxes.forEach((box) => {
            const boxTop = box.getBoundingClientRect().top;
            const trigger = window.innerHeight - 100; 
            if (boxTop < trigger) {
                box.classList.add("show");
            }
        });
    }

    window.addEventListener("scroll", showOffers);
    showOffers();
});
function showBookingForm(offerType) {
    document.getElementById('booking-form').style.display = 'block';
    document.getElementById('offer-type').value = offerType;
}


function closeBookingForm() {
    document.getElementById('booking-form').style.display = 'none';
}
       
/*faqs*/
document.querySelectorAll('.faq-question').forEach(function(question) {
    question.addEventListener('click', function() {
        const parent = question.parentElement;
        parent.classList.toggle('active');
    });
});

window.addEventListener('scroll', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(function(item) {
        const rect = item.getBoundingClientRect(); 
        if (rect.top <= window.innerHeight && rect.bottom >= 0) {
            item.classList.add('visible'); 
        }
    });
});

/*offers*/

$(document).ready(function() {
    $('#bookinf-form').on('submit', function(event) {
        event.preventDefault();  
        var offerType = $('#offer-type').val();
        var name = $('#name').val();
        var email = $('#email').val();
        $.ajax({
            url: 'offerts.php',  
            type: 'POST',
            data: {
                offer_type: offerType,
                name: name,
                email: email
            },
            success: function(response) {
                
                if (response.status == 'success') {
                  
                    $('#bookinf-form')[0].reset();
                    
                   
                    $('#response-message').html('<p style="color:green;">' + response.message + '</p>');
                } else {
                
                    $('#response-message').html('<p style="color:red;">' + response.message + '</p>');
                }
            },
            error: function() {
                $('#response-message').html('<p style="color:red;">An error occurred, please try again later.</p>');
            }
        });
    });
});


// Bouton
const scrollToTopBtn = document.getElementById("scrollToTopBtn");

window.onscroll = function () {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    scrollToTopBtn.style.display = "block";
  } else {
    scrollToTopBtn.style.display = "none";
  }
};
scrollToTopBtn.addEventListener("click", function () {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});
