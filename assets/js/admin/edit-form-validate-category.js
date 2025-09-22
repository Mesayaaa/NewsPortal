var editForm = document.getElementById("edit_form");
var imgPreview = document.getElementById("image_preview");
var imgInp = document.getElementById("category_img");
var categoryTitle = document.getElementById("category_title");
var categoryDesc = document.getElementById("category_desc");
var categoryColor = document.getElementById("category_color");

let titleRegex = new RegExp(/^[-@.,?\/#&+\w\s:;\'\'\"\`]{3,20}$/);

imgInp.addEventListener("change", function () {
  var file = this.files[0];

  if (file) {
    var reader = new FileReader();
    reader.addEventListener("load", function () {
      imgPreview.setAttribute("src", this.result);
    });
    reader.readAsDataURL(file);
  }
});

editForm.addEventListener("submit", function (e) {
  let errorMessages = [];

  if (categoryDesc.value == "" || categoryDesc.value == null) {
    errorMessages.push('Description cannot be empty!');
  } else if (categoryDesc.value.length < 100) {
    errorMessages.push('Description should be minimum of 100 characters long.');
  }

  if (categoryColor.value == "0") {
    errorMessages.push('Please select a color.');
  }

  if (categoryTitle.value == "" || categoryTitle.value == null) {
    errorMessages.push('Title cannot be empty!');
  } else if (!titleRegex.test(categoryTitle.value)) {
    errorMessages.push('Category should contain minimum of 3 alphanumeric characters long.');
  }

  if (errorMessages.length > 0) {
    e.preventDefault();
    if (typeof showValidationErrors !== 'undefined') {
      showValidationErrors(errorMessages, 'Category Edit Validation Error');
    }
  }
});