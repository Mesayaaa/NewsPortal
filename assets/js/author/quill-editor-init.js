/**
 * Quill Rich Text Editor Initialization
 * File: quill-editor-init.js
 * Purpose: Initialize Quill editor for article content with full features
 */

document.addEventListener('DOMContentLoaded', function() {
  // Check if quill editor container exists
  const editorContainer = document.getElementById('quill-editor');
  
  if (!editorContainer) {
    return;
  }

  // Quill toolbar configuration with full features
  const toolbarOptions = [
    // Font and Size
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    [{ 'font': [] }],
    [{ 'size': ['small', false, 'large', 'huge'] }],
    
    // Text Formatting
    ['bold', 'italic', 'underline', 'strike'],
    
    // Text Color and Background
    [{ 'color': [] }, { 'background': [] }],
    
    // Script (superscript/subscript)
    [{ 'script': 'sub'}, { 'script': 'super' }],
    
    // Lists
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'indent': '-1'}, { 'indent': '+1' }],
    
    // Text Alignment
    [{ 'align': [] }],
    
    // Blockquote and Code Block
    ['blockquote', 'code-block'],
    
    // Links, Images, and Videos
    ['link', 'image', 'video'],
    
    // Clear Formatting
    ['clean']
  ];

  // Initialize Quill editor
  const quill = new Quill('#quill-editor', {
    theme: 'snow',
    modules: {
      toolbar: toolbarOptions
    },
    placeholder: 'Write your article content here...',
    bounds: '#quill-editor'
  });

  // Get the hidden textarea element
  const hiddenTextarea = document.getElementById('article_desc');
  
  // Load existing content if available (for edit mode)
  if (hiddenTextarea && hiddenTextarea.value) {
    quill.root.innerHTML = hiddenTextarea.value;
  }

  // Sync Quill content to hidden textarea on text change
  quill.on('text-change', function() {
    const html = quill.root.innerHTML;
    hiddenTextarea.value = html;
  });

  // Form submission handler
  const form = document.getElementById('add_form') || document.getElementById('edit_form');
  
  if (form) {
    form.addEventListener('submit', function(e) {
      // Get content from Quill
      const content = quill.root.innerHTML;
      
      // Update hidden textarea
      hiddenTextarea.value = content;
      
      // Validate content is not empty
      const text = quill.getText().trim();
      
      if (text.length === 0) {
        e.preventDefault();
        
        // Show error using SweetAlert if available
        if (typeof Swal !== 'undefined') {
          Swal.fire({
            title: 'Error',
            text: 'Article description cannot be empty!',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        } else {
          alert('Article description cannot be empty!');
        }
        
        return false;
      }
      
      // Check minimum length (at least 50 characters)
      if (text.length < 50) {
        e.preventDefault();
        
        if (typeof Swal !== 'undefined') {
          Swal.fire({
            title: 'Error',
            text: 'Article description must be at least 50 characters long!',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        } else {
          alert('Article description must be at least 50 characters long!');
        }
        
        return false;
      }
    });
  }

  // Character counter (optional feature)
  const createCharacterCounter = function() {
    const counterDiv = document.createElement('div');
    counterDiv.id = 'character-counter';
    counterDiv.style.cssText = 'text-align: right; padding: 10px; color: #666; font-size: 14px;';
    
    const updateCounter = function() {
      const text = quill.getText().trim();
      const length = text.length;
      const minLength = 50;
      
      if (length < minLength) {
        counterDiv.textContent = `${length} / ${minLength} characters (minimum)`;
        counterDiv.style.color = '#d9534f';
      } else {
        counterDiv.textContent = `${length} characters`;
        counterDiv.style.color = '#5cb85c';
      }
    };
    
    quill.on('text-change', updateCounter);
    updateCounter();
    
    editorContainer.parentElement.appendChild(counterDiv);
  };
  
  createCharacterCounter();

  // Image upload handler (base64 encoding)
  const imageHandler = function() {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.click();

    input.onchange = async function() {
      const file = input.files[0];
      
      if (file) {
        // Validate file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
          if (typeof Swal !== 'undefined') {
            Swal.fire({
              title: 'Error',
              text: 'Image size must be less than 2MB!',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          } else {
            alert('Image size must be less than 2MB!');
          }
          return;
        }

        // Read and insert image as base64
        const reader = new FileReader();
        reader.onload = function(e) {
          const range = quill.getSelection(true);
          quill.insertEmbed(range.index, 'image', e.target.result);
          quill.setSelection(range.index + 1);
        };
        reader.readAsDataURL(file);
      }
    };
  };

  // Register custom image handler
  const toolbar = quill.getModule('toolbar');
  toolbar.addHandler('image', imageHandler);

  // Make quill instance available globally for debugging
  window.quillEditor = quill;
});
