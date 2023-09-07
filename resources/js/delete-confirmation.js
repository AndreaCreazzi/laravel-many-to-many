const deleteForm = document.querySelectorAll(".delete-form");
deleteForm.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const hasConfirmed = confirm(
            "Sei proprio sicuro di voler eliminare questo progetto?"
        );
        if (hasConfirmed) form.submit();
    });
});
