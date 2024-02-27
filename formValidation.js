document.getElementById('signupForm').addEventListener('submit', function (event) {
    // Function to validate email format
    function isValidEmail(email) {
        // Use a simple regex for email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Function to display an error message
    function showError(element, message) {
        // You can customize this part based on your UI design
        alert(`${element.name}: ${message}`);
        element.focus();
        event.preventDefault(); // Prevent form submission
    }

    // Validate email fields
    const parentEmail = document.getElementById('parentEmail');
    const reenterParentEmail = document.getElementById('reenterParentEmail');

    if (!isValidEmail(parentEmail.value)) {
        showError(parentEmail, 'Invalid email format');
        return;
    }

    if (!isValidEmail(reenterParentEmail.value)) {
        showError(reenterParentEmail, 'Invalid email format');
        return;
    }

    // Additional validation logic for other fields can be added here
    // For example, check if other required fields are filled, validate phone number format, etc.

    // If all validations pass, the form will be submitted
});
