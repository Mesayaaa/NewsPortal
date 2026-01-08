var imgPreview = document.getElementById("image_preview");
var categoryImage = document.getElementById("category_img");
var addForm = document.getElementById("add_form");
var categoryTitle = document.getElementById("category_title");
var categoryDesc = document.getElementById("category_desc");
var categoryColor = document.getElementById("category_color");

categoryImage.addEventListener("change", function () {
  var file = this.files[0];

  if (file) {
    var reader = new FileReader();
    reader.addEventListener("load", function () {
      imgPreview.setAttribute("src", this.result);
    });
    reader.readAsDataURL(file);
  }
});

addForm.addEventListener("submit", function (e) {
  let errorMessages = [];

  if (categoryDesc.value == "" || categoryDesc.value == null) {
    errorMessages.push('Description cannot be empty!');
  }

  if (categoryImage.validity.valueMissing) {
    errorMessages.push('Please select an image.');
  }

  if (categoryColor.value == "0") {
    errorMessages.push('Please select a color.');
  }

  if (categoryTitle.value == "" || categoryTitle.value == null) {
    errorMessages.push('Title cannot be empty!');
  }

  if (errorMessages.length > 0) {
    e.preventDefault();
    if (typeof showValidationErrors !== 'undefined') {
      showValidationErrors(errorMessages, 'Category Form Validation Error');
    }
  }
});