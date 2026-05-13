// OPEN IMAGE LIGHTBOX
function openLightbox(src) {
    const lightbox = document.getElementById("lightbox");
    const img = document.getElementById("lightbox-img");

    img.src = src;
    lightbox.style.display = "flex";
}

// CLOSE LIGHTBOX
function closeLightbox() {
    document.getElementById("lightbox").style.display = "none";
}

// FILTER (simple version)
function filterPhotos(type) {
    const cards = document.querySelectorAll(".photo-card");

    cards.forEach(card => {
        if (type === "all") {
            card.style.display = "block";
        } else {
            card.style.display = "block"; // (tu pourras améliorer avec data-category après)
        }
    });
}