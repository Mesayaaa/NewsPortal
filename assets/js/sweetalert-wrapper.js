/**
 * WinniCode Enhanced Alert System using SweetAlert2
 * Created for replacing default JavaScript alerts with beautiful modal alerts
 */

function showSuccess(title, message, timer = 3000) {
    return Swal.fire({
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
        iconColor: '#10b981',
        customClass: {
            popup: 'swal-flash-popup'
        }
    });
}

function showError(title, message, timer = 4000) {
    return Swal.fire({
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
        iconColor: '#ef4444',
        customClass: {
            popup: 'swal-flash-popup'
        }
    });
}

function showWarning(title, message, timer = 3500) {
    return Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        timer: timer,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
        position: 'top',
        background: '#fffbeb',
        color: '#92400e',
        iconColor: '#f59e0b',
        width: '400px',
        customClass: {
            popup: 'notice-toast'
        }
    });
}

function showInfo(title, message, timer = 3000) {
    return Swal.fire({
        title: title,
        text: message,
        icon: 'info',
        timer: timer,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
        position: 'top',
        background: '#f0f9ff',
        color: '#1e40af',
        iconColor: '#3b82f6',
        width: '400px',
        customClass: {
            popup: 'notice-toast'
        }
    });
}

function showConfirm(title, message, confirmText = 'Yes', cancelText = 'No', options = {}) {
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
        color: '#374151',
        ...options
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
        timer: 5000,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
        position: 'top',
        background: '#fef2f2',
        color: '#991b1b',
        iconColor: '#ef4444',
        width: '450px',
        customClass: {
            popup: 'validation-notice-toast'
        }
    });
    
    return true;
}

function showFieldError(fieldName, message) {
    Swal.fire({
        title: `${fieldName}`,
        text: message,
        icon: 'error',
        timer: 4000,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
        position: 'top',
        background: '#fef2f2',
        color: '#991b1b',
        iconColor: '#ef4444',
        width: '350px',
        customClass: {
            popup: 'validation-notice-toast'
        }
    });
}

function showValidationSuccess(message = 'All fields are valid!') {
    Swal.fire({
        title: 'Success',
        text: message,
        icon: 'success',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
        position: 'top',
        background: '#f0f9ff',
        color: '#065f46',
        iconColor: '#10b981',
        width: '350px',
        customClass: {
            popup: 'validation-notice-toast'
        }
    });
}

// Validation Helper Functions
const ValidationRules = {
    name: /^[a-zA-Z ]{4,30}$/,
    email: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/,
    password: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/,
    title: /^[-@.,?\/#&+\w\s:;\'\'\"\`]{3,500}$/,
    categoryTitle: null,
    articleTitle: null
};

const ValidationMessages = {
    name: 'Name must contain 4 to 30 alphabets only',
    email: 'Enter a valid email address',
    password: 'Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase',
    title: 'Title must contain 3 to 500 characters',
    categoryTitle: 'Category title is invalid',
    articleTitle: 'Article title is invalid',
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
                       message.toLowerCase().includes('try again')) {
                showWarning('Warning!', message);
            } else {
                showInfo('Notice', message);
            }
        }
    };
});

// Add custom CSS for notice and validation toasts
const style = document.createElement('style');
style.textContent = `
    /* Z-index hierarchy: SweetAlert2 should always be above navbar (9999) */
    .swal2-container {
        z-index: 10000 !important; /* Above navbar */
    }
    
    .swal2-overlay {
        z-index: 10000 !important; /* Above navbar */
    }

        /*
            Admin stylesheet sets a global span font-size with !important.
            SweetAlert2 icons use em units internally. Forcing font-size on icon spans
            breaks the geometry (error "X" becomes a "V" shape).
            Keep SweetAlert2 icon internals inheriting from the icon root.
        */
    .swal2-icon span {
        font-size: inherit !important;
        line-height: inherit !important;
    }
    
    /* Custom styling for notice and validation toasts */
    .notice-toast {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        border-radius: 12px !important;
        font-family: 'Nunito Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
        font-size: 14px !important;
        margin-top: 20px !important;
        z-index: 10001 !important; /* Ensure toast is above container */
    }
    
    .validation-notice-toast {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        border-radius: 12px !important;
        font-family: 'Nunito Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
        font-size: 14px !important;
        margin-top: 20px !important;
        text-align: left !important;
        z-index: 10001 !important; /* Ensure toast is above container */
    }
    
    .validation-notice-toast .swal2-html-container {
        text-align: left !important;
        line-height: 1.5 !important;
    }
    
    .swal2-toast .swal2-title {
        font-size: 16px !important;
        font-weight: 600 !important;
        margin-bottom: 4px !important;
    }
    
    .swal2-toast .swal2-content {
        font-size: 14px !important;
        line-height: 1.4 !important;
    }
    
    .swal2-toast.swal2-show {
        animation: slideInDown 0.3s ease-out !important;
    }
    
    .swal2-toast.swal2-hide {
        animation: slideOutUp 0.3s ease-in !important;
    }
    
    @keyframes slideInDown {
        from {
            transform: translate3d(0, -100%, 0);
            opacity: 0;
        }
        to {
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutUp {
        from {
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }
        to {
            transform: translate3d(0, -100%, 0);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
