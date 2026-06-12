//
document.addEventListener('submit', (event) => {
    const message = event.target.getAttribute('data-confirm');
    if (message && !confirm(message)) {
        event.preventDefault();
    }
});

