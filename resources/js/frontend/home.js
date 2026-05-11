document.addEventListener("DOMContentLoaded", () => {
    const homeMain = document.querySelector("main.home-page");
    if (!homeMain) {
        return;
    }

    const gameDetailLink = homeMain.dataset.gameLink;
    const catalogLink = homeMain.dataset.catalogLink;
    const highlightCards = Array.from(
        document.querySelectorAll(".highlights-card"),
    );
    const highlightTitle = document.querySelector(
        ".highlights-main-content h2",
    );
    const highlightParagraphs = document.querySelectorAll(
        ".highlights-main-content p",
    );
    const highlightSubtitle = highlightParagraphs[0];
    const highlightDescription = highlightParagraphs[1];
    const highlightImage = document.querySelector(
        ".highlights-main img.bg-image",
    );
    const buyButton = document.querySelector(".highlight-buy-button");
    const wishlistForm = document.querySelector(".highlight-wishlist-form");
    const catalogButton = document.querySelector(".catalog-btn");

    const highlightItems = highlightCards.map((card) => ({
        title: card.dataset.highlightTitle || "Featured",
        subtitle: card.dataset.highlightSubtitle || "",
        description: card.dataset.highlightDescription || "",
        image: card.dataset.highlightImage || "",
        link: card.dataset.highlightLink || gameDetailLink,
        wishlistLink: card.dataset.highlightWishlistLink || "",
    }));

    let currentHighlight = 0;
    let highlightTimer = null;

    function setHighlight(index) {
        if (!highlightItems[index]) {
            return;
        }

        currentHighlight = index;
        const item = highlightItems[index];

        highlightTitle.textContent = item.title;
        highlightSubtitle.textContent = item.subtitle;
        highlightDescription.textContent = item.description;
        if (item.image) {
            highlightImage.src = item.image;
        }

        if (buyButton) {
            buyButton.href = item.link;
        }

        if (wishlistForm && item.wishlistLink) {
            wishlistForm.action = item.wishlistLink;
        }

        highlightCards.forEach((card, cardIndex) => {
            card.classList.toggle("active", cardIndex === index);
        });

        resetHighlightTimer();
    }

    function resetHighlightTimer() {
        if (highlightTimer) {
            clearInterval(highlightTimer);
        }
        highlightTimer = setInterval(() => {
            setHighlight((currentHighlight + 1) % highlightItems.length);
        }, 8000);
    }

    highlightCards.forEach((card, index) => {
        card.addEventListener("click", () => setHighlight(index));
    });

    setHighlight(0);

    if (catalogButton && catalogLink) {
        catalogButton.addEventListener("click", () => {
            window.location.href = catalogLink;
        });
    }

    const sections = Array.from(document.querySelectorAll("section"));

    sections.forEach((section) => {
        const arrows = Array.from(section.querySelectorAll(".arrow-btn"));
        const row = section.querySelector(".game-row");
        if (!row || arrows.length < 2) {
            return;
        }

        const scrollDistance = 220;

        arrows[0].addEventListener("click", () => {
            row.scrollLeft -= scrollDistance;
        });

        arrows[1].addEventListener("click", () => {
            row.scrollLeft += scrollDistance;
        });
    });
});
