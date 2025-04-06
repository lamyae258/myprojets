


document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault(); 

        let formData = new FormData(this); 

        fetch("submit_contact.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); 
            document.querySelector("form").reset(); 
        })
        .catch(error => console.error("Error:", error));
    });
});