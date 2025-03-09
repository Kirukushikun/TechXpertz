let favoriteBtn = document.querySelectorAll('.favorite');
favoriteBtn.forEach(button => {
    button.addEventListener('click', function(){
        let technicianID = this.getAttribute('data-technician-id');
        this.classList.toggle('active');
        toggleFavorite(technicianID);
    });
});

function toggleFavorite(technicianID) {
    fetch(`/customer/favorites/${technicianID}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    })
    .then(response => {
        if (response.ok) {
            console.log('Favorites toggled successfully');
        } else {
            console.log('Toggle Favorites failed');
        }
    })
    .catch(error => {
        console.log('There was an error with the request:', error);
    });
}