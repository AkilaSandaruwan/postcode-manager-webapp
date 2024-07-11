let currentIndex = 0;

function changeSlide(direction) {
    const slides = document.querySelector('.slides');
    const totalSlides = document.querySelectorAll('.slide').length;

    currentIndex += direction;

    if (currentIndex >= totalSlides) {
        currentIndex = 0;
    }

    if (currentIndex < 0) {
        currentIndex = totalSlides - 1;
    }

    slides.style.transform = 'translateX(' + (-currentIndex * 100) + 'vw)';
}

function calculateDistance() {
    const select1 = document.getElementById('postcode1');
    const select2 = document.getElementById('postcode2');
    const distanceInput = document.getElementById('distance');

    const option1 = select1.options[select1.selectedIndex];
    const option2 = select2.options[select2.selectedIndex];

    if (option1.value && option2.value) {
        const lat1 = parseFloat(option1.getAttribute('data-lat'));
        const lon1 = parseFloat(option1.getAttribute('data-lon'));
        const lat2 = parseFloat(option2.getAttribute('data-lat'));
        const lon2 = parseFloat(option2.getAttribute('data-lon'));

        const distance = calculateHaversineDistance(lat1, lon1, lat2, lon2);
        distanceInput.value = distance.toFixed(2) + ' miles';
    } else {
        distanceInput.value = 'Please select both postcodes';
    }
}

function calculateHaversineDistance(lat1, lon1, lat2, lon2) {
    const earthRadius = 6371000; // Radius of the Earth in meters
    const lat1Rad = toRadians(lat1);
    const lon1Rad = toRadians(lon1);
    const lat2Rad = toRadians(lat2);
    const lon2Rad = toRadians(lon2);

    const latDelta = lat2Rad - lat1Rad;
    const lonDelta = lon2Rad - lon1Rad;

    const a = Math.sin(latDelta / 2) * Math.sin(latDelta / 2) +
              Math.cos(lat1Rad) * Math.cos(lat2Rad) *
              Math.sin(lonDelta / 2) * Math.sin(lonDelta / 2);

    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    return (earthRadius * c)/1609.34; // Distance in miles
}

function toRadians(degrees) {
    return degrees * Math.PI / 180;
}

function scrollToBottom() {
    window.scrollTo({
        top: document.body.scrollHeight,
        behavior: 'smooth'
    });
}

function editPostcode(postcodeID) {
    // Retrieve postcode details from hidden fields
    const postcodeElem = document.getElementById('postcodeDetails_' + postcodeID);
    const postcode = postcodeElem.getAttribute('data-postcode');
    const longitude = postcodeElem.getAttribute('data-longitude');
    const latitude = postcodeElem.getAttribute('data-latitude');

    // Populate the form fields with the fetched details
    document.getElementById('postcodeID').value = postcodeID;
    document.getElementById('postcode').value = postcode;
    document.getElementById('longitude').value = longitude;
    document.getElementById('latitude').value = latitude;

    // Change form title and button text
    document.getElementById('form-title').innerText = 'Edit Postcode';
    document.getElementById('submit-button').innerText = 'Update Post Code';

    // Show cancel button
    document.getElementById('cancel-button').style.display = 'inline-block';

    document.getElementById('submit-button').name = 'update_postcode';
}

function cancelUpdate() {
    window.location.reload();
}

