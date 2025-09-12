var changePassForm = document.getElementById('change_pass_form');
var oldPassword = document.getElementById('old_password');
var newPassword = document.getElementById('new_password');
var confirmNewPassword = document.getElementById('confirm_new_password');

var passRegx = new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/);

changePassForm.addEventListener('submit', function (e) {
  let errorMessages = [];

  if (oldPassword.value == '' || oldPassword.value == null) {
    errorMessages.push('Old Password cannot be empty.');
  }
  else if (!passRegx.test(oldPassword.value)) {
    errorMessages.push('Old Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.');
  }

  if (newPassword.value == '' || newPassword.value == null) {
    errorMessages.push('New Password cannot be empty.');
  }
  else if (!passRegx.test(newPassword.value)) {
    errorMessages.push('New Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.');
  }

  if (confirmNewPassword.value == '' || confirmNewPassword.value == null) {
    errorMessages.push('Confirm Password cannot be empty.');
  }
  else if (confirmNewPassword.value != newPassword.value) {
    errorMessages.push('Passwords do not match.');
  }
  else if (newPassword.value == oldPassword.value) {
    errorMessages.push('Old and New Password should not be the same.');
  }

  if (errorMessages.length > 0) {
    e.preventDefault();
    if (typeof showValidationErrors !== 'undefined') {
      showValidationErrors(errorMessages, 'Password Change Validation Error');
    }
  } else {
    if (typeof showValidationSuccess !== 'undefined') {
      showValidationSuccess('Password change form is valid!');
    }
  }
});