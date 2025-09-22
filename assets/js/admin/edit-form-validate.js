var editForm = document.getElementById('edit_form');
var imgPreview = document.getElementById('image_preview');
var imgInp = document.getElementById('article_img');
var articleTitle = document.getElementById('article_title');
var articleDesc = document.getElementById('article_desc');

let titleRegx = new RegExp(/^[-@.,?\/#&+\w\s:;\'\'\"\`]{30,500}$/);

editForm.addEventListener("submit", function (e) {
  let errorMessages = [];
  
  if (articleDesc.value == '' || articleDesc.value == null) {
    errorMessages.push('Description cannot be empty!');
  }
  else if (articleDesc.value.length < 1000) {
    errorMessages.push('Description should be minimum of 1000 characters long.');
  }
  
  if (articleTitle.value == '' || articleTitle.value == null) {
    errorMessages.push('Title cannot be empty!');
  }
  else if (!titleRegx.test(articleTitle.value)) {
    errorMessages.push('Article should contain minimum of 30 alphanumeric characters long.');
  }
  
  if (errorMessages.length > 0) {
    e.preventDefault();
    if (typeof showValidationErrors !== 'undefined') {
      showValidationErrors(errorMessages, 'Article Edit Validation Error');
    }
  }
});

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