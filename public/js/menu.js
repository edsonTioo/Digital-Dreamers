document.addEventListener("DOMContentLoaded", () => {
    const openMenuButton = document.getElementById("open-menu");
    const closeMenuButton = document.getElementById("close-menu");
    const mobileMenu = document.getElementById("mobile-menu");

    openMenuButton.addEventListener("click", () => {
        mobileMenu.style.display = "block";
    });

    closeMenuButton.addEventListener("click", () => {
        mobileMenu.style.display = "none";
    });
});
