var changeNameForm = document.getElementById('change_name_form');
var oldName = document.getElementById('old_name');
var newName = document.getElementById('new_name');
var confirmNewName = document.getElementById('confirm_name');

let nameRegx = new RegExp(/^[a-zA-Z ]{4,30}$/);

changeNameForm.addEventListener("submit", function (e) {
  let errorMessages = [];

  if (oldName.value == '' || oldName.value == null) {
    errorMessages.push('Old name cannot be empty.');
  }
  else if (!nameRegx.test(oldName.value)) {
    errorMessages.push('Old name must contain 4 to 30 alphabets only.');
  }

  if (newName.value == '' || newName.value == null) {
    errorMessages.push('New name cannot be empty.');
  }
  else if (!nameRegx.test(newName.value)) {
    errorMessages.push('New name must contain 4 to 30 alphabets only.');
  }

  if (confirmNewName.value == '' || confirmNewName.value == null) {
    errorMessages.push('Confirm name cannot be empty.');
  }
  else if (!nameRegx.test(confirmNewName.value)) {
    errorMessages.push('Confirm name must contain 4 to 30 alphabets only.');
  }

  if (confirmNewName.value != newName.value) {
    errorMessages.push('Names do not match.');
  }
  else if (newName.value == oldName.value) {
    errorMessages.push('Old and new names should not be the same.');
  }

  if (errorMessages.length > 0) {
    e.preventDefault();
    // Use SweetAlert for validation errors
    if (typeof showValidationErrors !== 'undefined') {
      showValidationErrors(errorMessages, 'Name Change Validation Error');
    }
  }
});
