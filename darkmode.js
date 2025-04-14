document.addEventListener("DOMContentLoaded", () => {
    const toggleDarkMode = document.getElementById("dark-mode-toggle");
    const allElements = document.querySelectorAll("*");

    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        document.body.classList.add("dark-mode");
    }

    toggleDarkMode.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("theme", "dark");
            allElements.forEach((element) => {
                element.style.transition = "1s";
            });
        } else {
            localStorage.setItem("theme", "light");
            allElements.forEach((element) => {
                element.style.transition = "1s";
            });
        }
    });
});
