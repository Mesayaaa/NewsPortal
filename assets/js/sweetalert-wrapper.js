/**
 * NewsGrid Enhanced Alert System using SweetAlert2
 * Created for replacing default JavaScript alerts with beautiful modal alerts
 */

// SweetAlert2 Wrapper Functions for NewsGrid
function showAlert(title, message, type = 'info', timer = 3000) {
    Swal.fire({
        title: title,
        text: message,
        icon: type,
        timer: timer,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: false,
        position: 'center'
    });
}

function showSuccess(title, message, timer = 3000) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'success',
        timer: timer,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: false,
        position: 'center',
        background: '#f0f9ff',
        color: '#065f46',
        iconColor: '#10b981'
    });
}

function showError(title, message, timer = 4000) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'error',
        timer: timer,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: false,
        position: 'center',
        background: '#fef2f2',
        color: '#991b1b',
        iconColor: '#ef4444'
    });
}

function showWarning(title, message, timer = 3500) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        timer: timer,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: false,
        position: 'center',
        background: '#fffbeb',
        color: '#92400e',
        iconColor: '#f59e0b'
    });
}

function showInfo(title, message, timer = 3000) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'info',
        timer: timer,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: false,
        position: 'center',
        background: '#f0f9ff',
        color: '#1e40af',
        iconColor: '#3b82f6'
    });
}

function showConfirm(title, message, confirmText = 'Yes', cancelText = 'No') {
    return Swal.fire({
        title: title,
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        background: '#ffffff',
        color: '#374151'
    });
}

function showToast(message, type = 'success', position = 'top-end') {
    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: type,
        title: message
    });
}

// Enhanced Validation Functions with SweetAlert2
function showValidationErrors(errors, title = 'Validation Error') {
    if (errors.length === 0) return false;
    
    const errorList = errors.map(error => `• ${error}`).join('<br>');
    
    Swal.fire({
        title: title,
        html: errorList,
        icon: 'error',
        confirmButtonText: 'Fix Errors',
        confirmButtonColor: '#dc2626',
        background: '#fef2f2',
        color: '#991b1b',
        iconColor: '#ef4444',
        customClass: {
            popup: 'validation-popup'
        }
    });
    
    return true;
}

function showFieldError(fieldName, message) {
    showToast(`${fieldName}: ${message}`, 'error', 'top');
}

function showValidationSuccess(message = 'All fields are valid!') {
    showToast(message, 'success', 'top');
}

// Validation Helper Functions
const ValidationRules = {
    name: /^[a-zA-Z ]{4,30}$/,
    email: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/,
    password: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/,
    title: /^[-@.,?\/#&+\w\s:;\'\'\"\`]{3,500}$/,
    categoryTitle: /^[-@.,?\/#&+\w\s:;\'\'\"\`]{3,20}$/,
    articleTitle: /^[-@.,?\/#&+\w\s:;\'\'\"\`]{30,500}$/
};

const ValidationMessages = {
    name: 'Name must contain 4 to 30 alphabets only',
    email: 'Enter a valid email address',
    password: 'Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase',
    title: 'Title must contain 3 to 500 characters',
    categoryTitle: 'Category title must contain 3 to 20 characters',
    articleTitle: 'Article title must contain 30 to 500 characters',
    required: 'This field is required',
    passwordMatch: 'Passwords do not match',
    passwordSame: 'New password must be different from old password'
};

function validateField(fieldValue, rule, fieldName) {
    const errors = [];
    
    if (!fieldValue || fieldValue.trim() === '') {
        errors.push(`${fieldName} ${ValidationMessages.required.toLowerCase()}`);
        return errors;
    }
    
    if (rule && !rule.test(fieldValue)) {
        const message = ValidationMessages[fieldName.toLowerCase()] || `Invalid ${fieldName.toLowerCase()}`;
        errors.push(message);
    }
    
    return errors;
}

function validatePasswordMatch(password, confirmPassword) {
    if (password !== confirmPassword) {
        return [ValidationMessages.passwordMatch];
    }
    return [];
}

function validatePasswordDifferent(oldPassword, newPassword) {
    if (oldPassword === newPassword) {
        return [ValidationMessages.passwordSame];
    }
    return [];
}

// Override native alert function for backward compatibility
window.alert = function(message) {
    showInfo('Notice', message);
};

// Auto-detect and convert PHP alerts when page loads
document.addEventListener('DOMContentLoaded', function() {
    // This will catch any remaining native alerts and convert them
    const originalAlert = window.alert;
    window.alert = function(message) {
        if (message && typeof message === 'string') {
            // Determine alert type based on message content
            if (message.toLowerCase().includes('success') || 
                message.toLowerCase().includes('updated') || 
                message.toLowerCase().includes('added') ||
                message.toLowerCase().includes('activated') ||
                message.toLowerCase().includes('trending')) {
                showSuccess('Success!', message);
            } else if (message.toLowerCase().includes('error') || 
                       message.toLowerCase().includes('wrong') || 
                       message.toLowerCase().includes('failed') ||
                       message.toLowerCase().includes('not registered')) {
                showError('Error!', message);
            } else if (message.toLowerCase().includes('please') || 
                       message.toLowerCase().includes('login') ||
                       message.toLowerCase().includes('try again')) {
                showWarning('Warning!', message);
            } else {
                showInfo('Notice', message);
            }
        }
    };
});
