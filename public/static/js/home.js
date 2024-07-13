(function () {
    const contactOptions = document.querySelectorAll(".options");

    contactOptions.forEach((options) => {
        const optionsIcon = options.children[0];
        const optionsList = options.children[1];

        optionsIcon.addEventListener("click", () => {
            optionsList.classList.remove("hidden");
        });
    });

    document.addEventListener("click", (event) => {
        Array.from(document.querySelectorAll(".options-list"))
            .filter((item) => !item.classList.contains("hidden"))
            .forEach((item) => {
                if (!item.parentElement.contains(event.target)) {
                    item.classList.add("hidden")
                }
            });
    });
})();
