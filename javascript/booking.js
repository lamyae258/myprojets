/*booking-paiement*/
document.getElementById('paymentMethod').addEventListener('change', function() {
    var paymentMethod = this.value;
    
   
    document.getElementById('creditCardDetails').style.display = 'none';
    document.getElementById('bankTransferDetails').style.display = 'none';
    if (paymentMethod === 'creditCard') {
        document.getElementById('creditCardDetails').style.display = 'block';
    } else if (paymentMethod === 'bankTransfer') {
        document.getElementById('bankTransferDetails').style.display = 'block';
    }
});
/*price*/
function updateTourPrice() {
    var selectedOption = document.getElementById('tourName').options[document.getElementById('tourName').selectedIndex];
    var pricePerPerson = parseFloat(selectedOption.getAttribute('data-price')); 

    var numPersons = parseInt(document.getElementById('tourPersons').value);

    if (!isNaN(pricePerPerson) && numPersons > 0) {
        var totalPrice = pricePerPerson * numPersons;
        document.getElementById('tourPrice').value = 'Dh' + totalPrice.toFixed(2);
    } else {
        document.getElementById('tourPrice').value = 'Dh0.00';
    }
}

document.getElementById('tourName').addEventListener('change', updateTourPrice);
document.getElementById('tourPersons').addEventListener('input', updateTourPrice);
updateTourPrice();


/*carte information*/
document.querySelector("form").addEventListener("submit", function(event){
    event.preventDefault();
    const formData = new FormData(this);
    
    fetch('procuss_book.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
      .then(data => {
          showBookingDetails(data); 
      }).catch(error => console.log(error));
});
function showBookingDetails(data) {
    const modal = document.createElement("div");
    modal.id = "bookingModal";
    modal.style.position = "fixed";
    modal.style.top = "0";
    modal.style.left = "0";
    modal.style.width = "100%";
    modal.style.height = "100%";
    modal.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
    modal.style.display = "flex";
    modal.style.justifyContent = "center";
    modal.style.alignItems = "center";
    
    const modalContent = document.createElement("div");
    modalContent.style.backgroundColor = "#f1c40f";
    modalContent.style.padding = "20px";
    modalContent.style.borderRadius = "8px";
    modalContent.style.boxShadow = " 0px 8px 16px rgba(0, 0, 0, 0.2)";
    modalContent.innerHTML = `<h2>Your Booking Details</h2>
                              <div>${data}</div>
                              <button onclick="closeModal()">Close</button>`;
    
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
}

function closeModal() {
    const modal = document.getElementById("bookingModal");
    modal.style.display = "none";
}

