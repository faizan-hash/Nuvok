// Global helper functions for Alpine.js store management
window.appLoadingIndicator = {
    show() {
        if (Alpine.store('appLoadingIndicator')) {
            Alpine.store('appLoadingIndicator').show();
        }
    },
    hide() {
        if (Alpine.store('appLoadingIndicator')) {
            Alpine.store('appLoadingIndicator').hide();
        }
    }
};

// Global configurations
window.stream_type = document.querySelector('meta[name="stream_type"]')?.content || 'backend';

// Wait for Alpine.js to be ready
document.addEventListener('alpine:init', () => {
    // Initialize the loading indicator store if it doesn't exist
    if (!Alpine.store('appLoadingIndicator')) {
        Alpine.store('appLoadingIndicator', {
            visible: false,
            show() {
                this.visible = true;
            },
            hide() {
                this.visible = false;
            }
        });
    }
});

// Global error handler for Alpine.js requests
window.handleAlpineError = (error) => {
    console.error('Alpine.js request error:', error);
    appLoadingIndicator.hide();
    if (error.response) {
        toastr.error(error.response.message || 'An error occurred');
    } else {
        toastr.error('Network error occurred');
    }
}; 