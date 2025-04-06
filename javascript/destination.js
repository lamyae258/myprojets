function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return rect.top >= 0 && rect.bottom <= window.innerHeight;
}

function handleScroll() {
    const fadeInElements = document.querySelectorAll('#fade-in');

    fadeInElements.forEach(function (el) {
        if (isElementInViewport(el)) {
            el.classList.add('visible');
        }
    });
}
window.addEventListener('scroll', handleScroll);
window.addEventListener('load', handleScroll);