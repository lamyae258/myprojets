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

//reviews
document.addEventListener("DOMContentLoaded", function () { 
    const reviewsSection = document.querySelector(".reviews");
    const reviewCards = document.querySelectorAll(".review-card");
    const reviewForm = document.querySelector("#reviewForm");
    const prevBtn = document.querySelector("#prevBtn");
    const nextBtn = document.querySelector("#nextBtn");
    const reviewsSlider = document.querySelector(".reviews-slider");
    let currentIndex = 0;
    
    function handleScroll() {
        const sectionPosition = reviewsSection.getBoundingClientRect().top;
        const screenHeight = window.innerHeight;
        
        if (sectionPosition < screenHeight * 0.8) {
            reviewsSection.style.opacity = "1";
            reviewsSection.style.transform = "translateY(0)";
            reviewCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add("show");
                }, index * 200);
            });
            window.removeEventListener("scroll", handleScroll);
        }
    }
    function updateSliderPosition() {
        const cardWidth = reviewCards[0].offsetWidth + 20; 
        reviewsSlider.style.transform = `translateX(${-currentIndex * cardWidth}px)`;
    }
    nextBtn.addEventListener("click", function () {
        if (currentIndex < reviewCards.length - 1) {
            currentIndex++;
            updateSliderPosition();
        }
    });
    prevBtn.addEventListener("click", function () {
        if (currentIndex > 0) {
            currentIndex--;
            updateSliderPosition();
        }
    });
    reviewsSection.style.opacity = "0";
    reviewsSection.style.transform = "translateY(50px)";
    reviewsSection.style.transition = "opacity 1s ease-out, transform 1s ease-out";
    
    reviewCards.forEach(card => {
        card.classList.add("hidden");
        card.style.transition = "opacity 1s ease-out, transform 1s ease-out";
    });
    reviewForm.style.marginTop = "50px";
    setTimeout(() => {
        reviewForm.classList.add("show"); 
    }, 500); 
    window.addEventListener("scroll", handleScroll);
    handleScroll();
});
 
document.addEventListener("DOMContentLoaded", function () {
    const reviewForm = document.getElementById("reviewForm");
    const reviewsContainer = document.getElementById("reviews-slider");

    reviewForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(reviewForm);

        fetch("reviews.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateSliderWithNewComment(data.reviews[0]); 
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("حدث خطأ أثناء إرسال التعليق.");
        });
    });
    function updateSliderWithNewComment(review) {
        const reviewCard = document.createElement("div");
        reviewCard.classList.add("review-card");
        reviewCard.innerHTML = `
            <div class="stars">${"★".repeat(review.rating)}</div>
            <p>${review.comment}</p>
        `;
        reviewsContainer.insertBefore(reviewCard, reviewsContainer.firstChild);
    }
});

