var changePassForm = document.getElementById('change_pass_form');

var oldPassword = document.getElementById('old_password');
var newPassword = document.getElementById('new_password');
var confirmNewPassword = document.getElementById('confirm_new_password');

var oldError = document.getElementById('error-old');
var newError = document.getElementById('error-new');
var confirmError = document.getElementById('error-confirm');
var commonError = document.getElementById('error-common');

var formErrors = document.getElementById("errors");

// Enhanced password regex with validation rules from sweetalert-wrapper.js
var passRegx = typeof ValidationRules !== 'undefined' && ValidationRules.password 
  ? new RegExp(ValidationRules.password) 
  : new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/);

// Validation helper function
function validatePasswordChange() {
  let errorMessages = [];

  // Old Password Validation
  if (!oldPassword.value || oldPassword.value.trim() === '') {
    errorMessages.push('Old Password cannot be empty.');
  } else if (!passRegx.test(oldPassword.value)) {
    errorMessages.push('Old Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.');
  }

  // New Password Validation
  if (!newPassword.value || newPassword.value.trim() === '') {
    errorMessages.push('New Password cannot be empty.');
  } else if (!passRegx.test(newPassword.value)) {
    errorMessages.push('New Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.');
  }

  // Confirm Password Validation
  if (!confirmNewPassword.value || confirmNewPassword.value.trim() === '') {
    errorMessages.push('Confirm Password cannot be empty.');
  } else if (newPassword.value !== confirmNewPassword.value) {
    errorMessages.push('Passwords do not match.');
  }

  // Same password check
  if (newPassword.value && oldPassword.value && newPassword.value === oldPassword.value) {
    errorMessages.push('Old and New Password should not be the same.');
  }

  return errorMessages;
}

changePassForm.addEventListener('keyup', function (e) {
  let errorMessages = validatePasswordChange();

  if (errorMessages.length > 0) {
    // For keyup events, just show inline errors to avoid too many popups
    if (formErrors) {
      formErrors.innerHTML = errorMessages.join('<br>');
    }
  } else {
    if (formErrors) {
      formErrors.innerHTML = "";
    }
  }
});

changePassForm.addEventListener('submit', function (e) {
  let errorMessages = validatePasswordChange();

  if (errorMessages.length > 0) {
    e.preventDefault();
    
    // Use SweetAlert2 if available, otherwise fallback to DOM
    if (typeof showValidationErrors !== 'undefined') {
      showValidationErrors(errorMessages, 'Password Change Validation Error');
    } else {
      if (formErrors) {
        formErrors.innerHTML = errorMessages.join('<br>');
      }
    }
  } else {
    if (typeof showValidationSuccess !== 'undefined') {
      showValidationSuccess('Password change form is valid!');
    }
    if (formErrors) {
      formErrors.innerHTML = "";
    }
  }
});

changePassForm.addEventListener('change', function (e) {
  let errorMessages = validatePasswordChange();

  if (errorMessages.length > 0) {
    // For change events, just show inline errors
    if (formErrors) {
      formErrors.innerHTML = errorMessages.join('<br>');
    }
  } else {
    if (formErrors) {
      formErrors.innerHTML = "";
    }
  }
});