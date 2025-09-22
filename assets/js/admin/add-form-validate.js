var imgPreview = document.getElementById('image_preview');
var articleImage = document.getElementById('article_img');
var addForm = document.getElementById('add_form');
var articleTitle = document.getElementById('article_title');
var articleDesc = document.getElementById('article_desc');
var articleCategory = document.getElementById('category');

var titleRegx = new RegExp(/^[-@.,?\/#&+\w\s:;\'\'\"\`]{30,500}$/);

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

addForm.addEventListener("submit", function (e) {
  let errorMessages = [];

  if (articleTitle.value == '' || articleTitle.value == null) {
    errorMessages.push('Title cannot be empty!');
  }
  else if (!titleRegx.test(articleTitle.value)) {
    errorMessages.push('Article title should contain minimum of 30 alphanumeric characters.');
  }

  if (articleDesc.value == '' || articleDesc.value == null) {
    errorMessages.push('Description cannot be empty!');
  }
  else if (articleDesc.value.length < 1000) {
    errorMessages.push('Description should be minimum of 1000 characters long.');
  }

  if (articleCategory.value == "0") {
    errorMessages.push('Please select a category.');
  }

  if (articleImage.validity.valueMissing) {
    errorMessages.push('Please select an image.');
  }

  if (errorMessages.length > 0) {
    e.preventDefault();
    if (typeof showValidationErrors !== 'undefined') {
      showValidationErrors(errorMessages, 'Article Validation Error');
    }
  }
});