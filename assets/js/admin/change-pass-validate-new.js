var changePassForm = document.getElementById('change_pass_form');

var oldPassword = document.getElementById('old_password');
var newPassword = document.getElementById('new_password');
var confirmNewPassword = document.getElementById('confirm_new_password');

var oldError = document.getElementById('error-old');
var newError = document.getElementById('error-new');
var confirmError = document.getElementById('error-confirm');
var commonError = document.getElementById('error-common');

// Enhanced password regex with validation rules from sweetalert-wrapper.js
var passRegx = typeof ValidationRules !== 'undefined' && ValidationRules.password 
  ? new RegExp(ValidationRules.password) 
  : new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/);

// Validation helper function
function validateAdminPasswordChange() {
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

changePassForm.addEventListener("keyup", function (e) {
  // For keyup events, show individual field errors inline
  if (oldPassword.value == '' || oldPassword.value == null) {
    oldError.innerHTML = "Password cannot be empty";
  } else if (!passRegx.test(oldPassword.value)) {
    oldError.innerHTML = "Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.";
  } else {
    oldError.innerHTML = "";
  }

  if (newPassword.value == '' || newPassword.value == null) {
    newError.innerHTML = "Password cannot be empty";
  } else if (!passRegx.test(newPassword.value)) {
    newError.innerHTML = "Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.";
  } else {
    newError.innerHTML = "";
  }

  if (confirmNewPassword.value == '' || confirmNewPassword.value == null) {
    confirmError.innerHTML = "Password cannot be empty";
  } else if (!passRegx.test(confirmNewPassword.value)) {
    confirmError.innerHTML = "Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.";
  } else if (newPassword.value !== confirmNewPassword.value) {
    confirmError.innerHTML = "Passwords do not match.";
  } else {
    confirmError.innerHTML = "";
  }

  if (newPassword.value && oldPassword.value && newPassword.value === oldPassword.value) {
    commonError.innerHTML = "Old and New Password should not be the same.";
  } else {
    commonError.innerHTML = "";
  }
});

changePassForm.addEventListener("submit", function (e) {
  let errorMessages = validateAdminPasswordChange();

  if (errorMessages.length > 0) {
    e.preventDefault();
    
    // Use SweetAlert2 if available, otherwise fallback to DOM
    if (typeof showValidationErrors !== 'undefined') {
      showValidationErrors(errorMessages, 'Admin Password Change Validation Error');
    } else {
      // Fallback to individual field errors
      if (oldPassword.value == '' || oldPassword.value == null) {
        oldError.innerHTML = "Password cannot be empty";
      } else if (!passRegx.test(oldPassword.value)) {
        oldError.innerHTML = "Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.";
      } else {
        oldError.innerHTML = "";
      }

      if (newPassword.value == '' || newPassword.value == null) {
        newError.innerHTML = "Password cannot be empty";
      } else if (!passRegx.test(newPassword.value)) {
        newError.innerHTML = "Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.";
      } else {
        newError.innerHTML = "";
      }

      if (confirmNewPassword.value == '' || confirmNewPassword.value == null) {
        confirmError.innerHTML = "Password cannot be empty";
      } else if (!passRegx.test(confirmNewPassword.value)) {
        confirmError.innerHTML = "Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.";
      } else if (newPassword.value !== confirmNewPassword.value) {
        confirmError.innerHTML = "Passwords do not match.";
      } else {
        confirmError.innerHTML = "";
      }

      if (newPassword.value && oldPassword.value && newPassword.value === oldPassword.value) {
        commonError.innerHTML = "Old and New Password should not be the same.";
      } else {
        commonError.innerHTML = "";
      }
    }
  } else {
    if (typeof showValidationSuccess !== 'undefined') {
      showValidationSuccess('Admin password change form is valid!');
    }
    // Clear all error fields
    oldError.innerHTML = "";
    newError.innerHTML = "";
    confirmError.innerHTML = "";
    commonError.innerHTML = "";
  }
});

changePassForm.addEventListener("change", function (e) {
  // For change events, show individual field errors inline
  if (oldPassword.value == '' || oldPassword.value == null) {
    oldError.innerHTML = "Password cannot be empty";
  } else if (!passRegx.test(oldPassword.value)) {
    oldError.innerHTML = "Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.";
  } else {
    oldError.innerHTML = "";
  }

  if (newPassword.value == '' || newPassword.value == null) {
    newError.innerHTML = "Password cannot be empty";
  } else if (!passRegx.test(newPassword.value)) {
    newError.innerHTML = "Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.";
  } else {
    newError.innerHTML = "";
  }

  if (confirmNewPassword.value == '' || confirmNewPassword.value == null) {
    confirmError.innerHTML = "Password cannot be empty";
  } else if (!passRegx.test(confirmNewPassword.value)) {
    confirmError.innerHTML = "Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.";
  } else if (newPassword.value !== confirmNewPassword.value) {
    confirmError.innerHTML = "Passwords do not match.";
  } else {
    confirmError.innerHTML = "";
  }

  if (newPassword.value && oldPassword.value && newPassword.value === oldPassword.value) {
    commonError.innerHTML = "Old and New Password should not be the same.";
  } else {
    commonError.innerHTML = "";
  }
});
