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
    const postcode1 = document.getElementById("postcode1").value;
    const postcode2 = document.getElementById("postcode2").value;
    // Assuming you have a function to get the latitude and longitude for a postcode
    const coord1 = getCoordinates(postcode1);
    const coord2 = getCoordinates(postcode2);
    if (coord1 && coord2) {
        const distance = haversineDistance(coord1.lat, coord1.lon, coord2.lat, coord2.lon);
        document.getElementById("distance").value = distance.toFixed(2) + " miles";
    } else {
        alert("Invalid postcodes");
    }
}

function haversineDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius of the Earth in km
    const dLat = toRad(lat2 - lat1);
    const dLon = toRad(lon2 - lon1);
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    const distance = R * c; // Distance in km
    return distance * 0.621371; // Convert km to miles
}

function toRad(Value) {
    return Value * Math.PI / 180;
}

// Dummy function for getting coordinates
// Replace this with actual implementation
function getCoordinates(postcode) {
    // Fetch coordinates based on postcode from the server or a predefined list
    // Example:
    if (postcode === "12345") {
        return {lat: 40.7128, lon: -74.0060}; // Coordinates for New York
    } else if (postcode === "67890") {
        return {lat: 34.0522, lon: -118.2437}; // Coordinates for Los Angeles
    }
    return null;
}

