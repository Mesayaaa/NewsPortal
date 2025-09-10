var imgPreview = document.getElementById('image_preview');

var articleImage = document.getElementById('article_img');
var addForm = document.getElementById('add_form');
var articleTitle = document.getElementById('article_title');
var articleDesc = document.getElementById('article_desc');
var articleCategory = document.getElementById('category');

var descError = document.getElementById('error-desc');
var titleError = document.getElementById('error-title');
var imgError = document.getElementById('error-img');
var catError = document.getElementById('error-cat');

// Enhanced title regex with validation rules from sweetalert-wrapper.js
var titleRegx = typeof ValidationRules !== 'undefined' && ValidationRules.articleTitle 
  ? new RegExp(ValidationRules.articleTitle) 
  : new RegExp(/^[-@.,?\/#&+\w\s:;\'\'\"\`]{30,500}$/);

// Validation helper function
function validateArticleForm() {
  let errorMessages = [];

  // Title Validation
  if (!articleTitle.value || articleTitle.value.trim() === '') {
    errorMessages.push('Title cannot be empty!');
  } else if (!titleRegx.test(articleTitle.value)) {
    errorMessages.push('Article title should contain minimum of 30 alphanumeric characters.');
  }

  // Description Validation
  if (!articleDesc.value || articleDesc.value.trim() === '') {
    errorMessages.push('Description cannot be empty!');
  } else if (articleDesc.value.length < 1000) {
    errorMessages.push('Description should be minimum of 1000 characters long.');
  }

  // Category Validation
  if (!articleCategory.value || articleCategory.value === "0") {
    errorMessages.push('Please select a category.');
  }

  // Image Validation
  if (articleImage && articleImage.validity.valueMissing) {
    errorMessages.push('Please select an image.');
  }

  return errorMessages;
}

articleImage.addEventListener("change", function () {
  var file = this.files[0];

  if (file) {
    var reader = new FileReader();
    reader.addEventListener("load", function () {
      imgPreview.setAttribute("src", this.result);
    });
    reader.readAsDataURL(file);
  }
});

addForm.addEventListener("keyup", function (e) {
  // For keyup events, show individual field errors inline
  if (articleDesc.value == '' || articleDesc.value == null) {
    descError.innerHTML = "Description cannot be empty !";
  } else if (articleDesc.value.length < 1000) {
    descError.innerHTML = "Description should be of minimum of 1000 characters long";
  } else {
    descError.innerHTML = "";
  }

  if (articleImage.validity.valueMissing) {
    imgError.innerHTML = "Please Select an Image";
  } else {
    imgError.innerHTML = "";
  }

  if (articleCategory.value == "0") {
    catError.innerHTML = "Please Select a Category";
  } else {
    catError.innerHTML = "";
  }

  if (articleTitle.value == '' || articleTitle.value == null) {
    titleError.innerHTML = "Title cannot be empty !";
  } else if (!titleRegx.test(articleTitle.value)) {
    titleError.innerHTML = "Article should contain minimum of 30 alphanumeric characters long"
  } else {
    titleError.innerHTML = "";
  }
});

addForm.addEventListener("submit", function (e) {
  let errorMessages = validateArticleForm();

  if (errorMessages.length > 0) {
    e.preventDefault();
    
    // Use SweetAlert2 if available, otherwise fallback to DOM
    if (typeof showValidationErrors !== 'undefined') {
      showValidationErrors(errorMessages, 'Article Validation Error');
    } else {
      // Fallback to individual field errors
      if (articleDesc.value == '' || articleDesc.value == null) {
        descError.innerHTML = "Description cannot be empty !";
      } else if (articleDesc.value.length < 1000) {
        descError.innerHTML = "Description should be of minimum of 1000 characters long";
      } else {
        descError.innerHTML = "";
      }

      if (articleImage.validity.valueMissing) {
        imgError.innerHTML = "Please Select an Image";
      } else {
        imgError.innerHTML = "";
      }

      if (articleCategory.value == "0") {
        catError.innerHTML = "Please Select a Category";
      } else {
        catError.innerHTML = "";
      }

      if (articleTitle.value == '' || articleTitle.value == null) {
        titleError.innerHTML = "Title cannot be empty !";
      } else if (!titleRegx.test(articleTitle.value)) {
        titleError.innerHTML = "Article should contain minimum of 30 alphanumeric characters long"
      } else {
        titleError.innerHTML = "";
      }
    }
  } else {
    if (typeof showValidationSuccess !== 'undefined') {
      showValidationSuccess('Article form is valid!');
    }
    // Clear all error fields
    descError.innerHTML = "";
    imgError.innerHTML = "";
    catError.innerHTML = "";
    titleError.innerHTML = "";
  }
});

addForm.addEventListener("change", function (e) {
  // For change events, show individual field errors inline
  if (articleDesc.value == '' || articleDesc.value == null) {
    descError.innerHTML = "Description cannot be empty !";
  } else if (articleDesc.value.length < 1000) {
    descError.innerHTML = "Description should be of minimum of 1000 characters long";
  } else {
    descError.innerHTML = "";
  }

  if (articleImage.validity.valueMissing) {
    imgError.innerHTML = "Please Select an Image";
  } else {
    imgError.innerHTML = "";
  }

  if (articleCategory.value == "0") {
    catError.innerHTML = "Please Select a Category";
  } else {
    catError.innerHTML = "";
  }

  if (articleTitle.value == '' || articleTitle.value == null) {
    titleError.innerHTML = "Title cannot be empty !";
  } else if (!titleRegx.test(articleTitle.value)) {
    titleError.innerHTML = "Article should contain minimum of 30 alphanumeric characters long"
  } else {
    titleError.innerHTML = "";
  }
});

