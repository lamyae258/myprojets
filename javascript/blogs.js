
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

/*blogs*/
document.querySelectorAll('.read-more-btn').forEach(button => {
    button.addEventListener('click', function() {
        let blogItem = this.closest('.blog-item');
        let fullContent = blogItem.querySelector('.blog-full-content');
        let summary = blogItem.querySelector('.blog-summary');
        
        if (fullContent.style.display === "none") {
            fullContent.style.display = "block";
            summary.style.display = "none";
            this.innerText = "Read Less";
        } else {
            fullContent.style.display = "none";
            summary.style.display = "block";
            this.innerText = "Read More";
        }
    });
});



/*experience*/
document.getElementById("experience-form").addEventListener("submit", function(event) {
    event.preventDefault(); 

    let formData = new FormData(this);

    fetch("submit_experience.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            let experienceList = document.getElementById("experience-list");
            let newExperience = document.createElement("div");
            newExperience.classList.add("user-experience");
            newExperience.innerHTML = `
                <h4>${data.name}</h4>
                <p>${data.user_comment}</p>
                <small>Shared on: ${data.created_at}</small>
            `;
            experienceList.prepend(newExperience);
            document.getElementById("experience-form").reset(); 
        } else {
            alert(data.error); 
        }
    })
    .catch(error => console.error("⚠ Error:", error));
});
