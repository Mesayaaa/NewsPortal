const loginForm = document.getElementById("login-form");
const signupForm = document.getElementById("signup-form");

const loginEmail = document.getElementById("login-email");
const loginPassword = document.getElementById("login-password");

const signupName = document.getElementById("signup-name");
const signupEmail = document.getElementById("signup-email");
const signupPassword = document.getElementById("signup-password");
const signupConfirmPass = document.getElementById("signup-confirm-password");

const loginError = document.getElementById("login-errors");
const signupError = document.getElementById("signup-errors");

// Use validation rules from sweetalert-wrapper.js if available, otherwise fallback
const nameRegx = (typeof ValidationRules !== 'undefined') ? ValidationRules.name : new RegExp(/^[a-zA-Z ]{4,30}$/);
const emailRegx = (typeof ValidationRules !== 'undefined') ? ValidationRules.email : new RegExp(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/);
const passRegx = (typeof ValidationRules !== 'undefined') ? ValidationRules.password : new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/);

// Enhanced validation function
function validateFormField(value, rule, fieldName, showToastError = false) {
    if (typeof validateField !== 'undefined') {
        const errors = validateField(value, rule, fieldName);
        if (errors.length > 0 && showToastError) {
            showFieldError(fieldName, errors[0]);
        }
        return errors.length === 0;
    }
    
    // Fallback validation
    if (!value || value.trim() === '') {
        if (showToastError && typeof showFieldError !== 'undefined') {
            showFieldError(fieldName, 'This field is required');
        }
        return false;
    }
    
    if (rule && !rule.test(value)) {
        if (showToastError && typeof showFieldError !== 'undefined') {
            const messages = {
                'Name': 'Name must contain 4 to 30 alphabets only',
                'Email': 'Enter a valid email address',
                'Password': 'Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase'
            };
            showFieldError(fieldName, messages[fieldName] || `Invalid ${fieldName.toLowerCase()}`);
        }
        return false;
    }
    
    return true;
}

// Login form validation - only if login form exists
if(loginForm && loginEmail && loginPassword && loginError) {
  loginForm.addEventListener('keyup', function (e) {
    let loginMessages = [];

    // Email Validation
    if (loginEmail.value == '' || loginEmail.value == null) {
      loginMessages.push('Email cannot be empty.');
    }
    if (!emailRegx.test(loginEmail.value)) {
      loginMessages.push('Enter a valid email');
    }

    // Password Validation
    if (loginPassword.value == '' || loginPassword.value == null) {
      loginMessages.push('Password cannot be empty.');
    }
    if (!passRegx.test(loginPassword.value)) {
      loginMessages.push('Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.');
    }

    if (loginMessages.length > 0) {
      e.preventDefault();
      if(signupError) signupError.innerHTML = "";
      loginError.innerHTML = loginMessages.join('<br> ');
    }
    else {
      loginError.innerHTML = "";
    }
  });

  loginForm.addEventListener('submit', function (e) {
    let loginMessages = [];

    // Email Validation
    if (loginEmail.value == '' || loginEmail.value == null) {
      loginMessages.push('Email cannot be empty.');
    }
    if (!emailRegx.test(loginEmail.value)) {
      loginMessages.push('Enter a valid email');
    }

    // Password Validation
    if (loginPassword.value == '' || loginPassword.value == null) {
      loginMessages.push('Password cannot be empty.');
    }
    if (!passRegx.test(loginPassword.value)) {
      loginMessages.push('Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.');
    }

    if (loginMessages.length > 0) {
      e.preventDefault();
      
      // Use SweetAlert2 if available, otherwise fallback to DOM
      if (typeof showValidationErrors !== 'undefined') {
        showValidationErrors(loginMessages, 'Login Validation Error');
      } else {
        if(signupError) signupError.innerHTML = "";
        loginError.innerHTML = loginMessages.join('<br> ');
      }
    }
    else {
      if (typeof showValidationSuccess !== 'undefined') {
        showValidationSuccess('Login form is valid!');
      }
      loginError.innerHTML = "";
    }
  });
}

// Signup form validation - only if signup form exists
if(signupForm && signupName && signupEmail && signupPassword && signupConfirmPass && signupError) {
  signupForm.addEventListener('keyup', function (e) {
    let signupMessages = [];

    // Name Validation
    if (signupName.value == '' || signupName.value == null) {
      signupMessages.push('Name cannot be empty.');
    }
    if (!nameRegx.test(signupName.value)) {
      signupMessages.push('Name must contain 4 to 30 alphabets only.');
    }

    // Email Validation
    if (signupEmail.value == '' || signupEmail.value == null) {
      signupMessages.push('Email cannot be empty.');
    }
    if (!emailRegx.test(signupEmail.value)) {
      signupMessages.push('Enter a valid email');
    }

    // Password Validation
    if (signupPassword.value == '' || signupPassword.value == null) {
      signupMessages.push('Password cannot be empty.');
    }
    if (!passRegx.test(signupPassword.value)) {
      signupMessages.push('Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.');
    }
    if (signupConfirmPass.value == '' || signupConfirmPass.value == null) {
      signupMessages.push('Confirm Password cannot be empty.');
    }
    if (signupPassword.value != signupConfirmPass.value) {
      signupMessages.push('Password do not match.');
    }

    if (signupMessages.length > 0) {
      e.preventDefault();
      
      // For keyup events, just show inline errors to avoid too many popups
      if(loginError) loginError.innerHTML = "";
      signupError.innerHTML = signupMessages.join('<br> ');
    }
    else {
      signupError.innerHTML = "";
    }
  });

  signupForm.addEventListener('submit', function (e) {
    let signupMessages = [];

    // Name Validation
    if (signupName.value == '' || signupName.value == null) {
      signupMessages.push('Name cannot be empty.');
    }
    if (!nameRegx.test(signupName.value)) {
      signupMessages.push('Name must contain 4 to 30 alphabets only.');
    }

    // Email Validation
    if (signupEmail.value == '' || signupEmail.value == null) {
      signupMessages.push('Email cannot be empty.');
    }
    if (!emailRegx.test(signupEmail.value)) {
      signupMessages.push('Enter a valid email');
    }

    // Password Validation
    if (signupPassword.value == '' || signupPassword.value == null) {
      signupMessages.push('Password cannot be empty.');
    }
    if (!passRegx.test(signupPassword.value)) {
      signupMessages.push('Password must be 6 to 20 characters long with at least 1 number, 1 uppercase and 1 lowercase.');
    }
    if (signupConfirmPass.value == '' || signupConfirmPass.value == null) {
      signupMessages.push('Confirm Password cannot be empty.');
    }
    if (signupPassword.value != signupConfirmPass.value) {
      signupMessages.push('Password do not match.');
    }

    if (signupMessages.length > 0) {
      e.preventDefault();
      
      // Use SweetAlert2 if available, otherwise fallback to DOM
      if (typeof showValidationErrors !== 'undefined') {
        showValidationErrors(signupMessages, 'Registration Validation Error');
      } else {
        if(loginError) loginError.innerHTML = "";
        signupError.innerHTML = signupMessages.join('<br> ');
      }
    }
    else {
      if (typeof showValidationSuccess !== 'undefined') {
        showValidationSuccess('Registration form is valid!');
      }
      signupError.innerHTML = "";
    }
  });
}