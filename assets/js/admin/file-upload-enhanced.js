/**
 * Enhanced File Upload Component
 * Provides drag-and-drop functionality, file preview, and validation
 */

class EnhancedFileUpload {
    constructor(inputId, options = {}) {
        this.input = document.getElementById(inputId);
        if (!this.input) {
            console.error(`File input with ID "${inputId}" not found`);
            return;
        }

        this.options = {
            maxSize: options.maxSize || 5 * 1024 * 1024, // 5MB default
            allowedTypes: options.allowedTypes || ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'],
            previewContainer: options.previewContainer || null,
            ...options
        };

        this.init();
    }

    init() {
        this.createUploadWrapper();
        this.bindEvents();
    }

    createUploadWrapper() {
        // Hide original input
        this.input.style.display = 'none';
        this.input.classList.add('file-upload-input');

        // Create wrapper
        const wrapper = document.createElement('div');
        wrapper.className = 'custom-file-upload';
        wrapper.innerHTML = `
            <div class="file-upload-wrapper" data-input="${this.input.id}">
                <div class="file-upload-content">
                    <div class="file-upload-icon">
                        <i class="glyphicon glyphicon-cloud-upload"></i>
                    </div>
                    <div class="file-upload-text">
                        Choose file or drag here
                    </div>
                    <p class="file-upload-hint">
                        Support: JPG, PNG, GIF (Max 5MB)
                    </p>
                </div>
            </div>
            <div class="file-selected-info" id="file-info-${this.input.id}">
                <div class="file-info-row">
                    <div style="display: flex; align-items: center;">
                        <div class="file-type-icon file-type-image">
                            <i class="glyphicon glyphicon-picture"></i>
                        </div>
                        <div>
                            <div class="file-info-label" id="file-name-${this.input.id}">No file selected</div>
                            <div class="file-info-value" id="file-size-${this.input.id}">0 bytes</div>
                        </div>
                    </div>
                    <button type="button" class="file-remove-btn" id="remove-${this.input.id}">
                        <i class="glyphicon glyphicon-remove"></i> Remove
                    </button>
                </div>
            </div>
            <div class="upload-progress" id="progress-${this.input.id}">
                <div class="progress-bar-custom">
                    <div class="progress-fill" id="progress-fill-${this.input.id}"></div>
                </div>
                <div class="progress-text" id="progress-text-${this.input.id}">Uploading...</div>
            </div>
        `;

        // Insert wrapper after original input
        this.input.parentNode.insertBefore(wrapper, this.input.nextSibling);

        this.wrapper = wrapper.querySelector('.file-upload-wrapper');
        this.fileInfo = document.getElementById(`file-info-${this.input.id}`);
        this.removeButton = document.getElementById(`remove-${this.input.id}`);
        this.progressContainer = document.getElementById(`progress-${this.input.id}`);
    }

    bindEvents() {
        // Click to select file
        this.wrapper.addEventListener('click', () => {
            this.input.click();
        });

        // File input change
        this.input.addEventListener('change', (e) => {
            this.handleFileSelect(e.target.files[0]);
        });

        // Drag and drop events
        this.wrapper.addEventListener('dragover', (e) => {
            e.preventDefault();
            this.wrapper.classList.add('dragover');
        });

        this.wrapper.addEventListener('dragleave', (e) => {
            e.preventDefault();
            this.wrapper.classList.remove('dragover');
        });

        this.wrapper.addEventListener('drop', (e) => {
            e.preventDefault();
            this.wrapper.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                this.handleFileSelect(files[0]);
            }
        });

        // Remove file button
        this.removeButton.addEventListener('click', (e) => {
            e.stopPropagation();
            this.removeFile();
        });
    }

    handleFileSelect(file) {
        if (!file) return;

        // Validate file
        const validation = this.validateFile(file);
        if (!validation.valid) {
            this.showError(validation.message);
            return;
        }

        // Update file info
        this.updateFileInfo(file);
        this.showFileInfo();

        // Create file object for the input
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        this.input.files = dataTransfer.files;

        // Show preview if image
        if (file.type.startsWith('image/')) {
            this.showImagePreview(file);
        }

        // Simulate upload progress (for demo purposes)
        this.simulateUploadProgress();
    }

    validateFile(file) {
        // Check file type
        if (!this.options.allowedTypes.includes(file.type)) {
            return {
                valid: false,
                message: `File type not allowed. Supported types: ${this.options.allowedTypes.join(', ')}`
            };
        }

        // Check file size
        if (file.size > this.options.maxSize) {
            return {
                valid: false,
                message: `File too large. Maximum size: ${this.formatFileSize(this.options.maxSize)}`
            };
        }

        return { valid: true };
    }

    updateFileInfo(file) {
        const fileName = document.getElementById(`file-name-${this.input.id}`);
        const fileSize = document.getElementById(`file-size-${this.input.id}`);

        fileName.textContent = file.name;
        fileSize.textContent = this.formatFileSize(file.size);
    }

    showFileInfo() {
        this.fileInfo.classList.add('show');
    }

    hideFileInfo() {
        this.fileInfo.classList.remove('show');
    }

    removeFile() {
        // Clear input
        this.input.value = '';
        
        // Hide file info
        this.hideFileInfo();
        
        // Hide progress
        this.progressContainer.classList.remove('show');
        
        // Clear preview if exists
        if (this.options.previewContainer) {
            const preview = document.getElementById(this.options.previewContainer);
            if (preview) {
                preview.src = '../assets/images/articles/choose.png';
            }
        }
    }

    showImagePreview(file) {
        if (!this.options.previewContainer) return;

        const preview = document.getElementById(this.options.previewContainer);
        if (!preview) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    simulateUploadProgress() {
        const progressFill = document.getElementById(`progress-fill-${this.input.id}`);
        const progressText = document.getElementById(`progress-text-${this.input.id}`);
        
        this.progressContainer.classList.add('show');
        
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 30;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                progressText.textContent = 'Upload complete!';
                
                setTimeout(() => {
                    this.progressContainer.classList.remove('show');
                }, 1500);
            }
            
            progressFill.style.width = progress + '%';
            progressText.textContent = `Uploading... ${Math.round(progress)}%`;
        }, 200);
    }

    showError(message) {
        if (typeof showValidationErrors !== 'undefined') {
            showValidationErrors([message], 'File Upload Error');
        } else {
            showError('File Upload Error', message);
        }
    }

    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
}

// Auto-initialize enhanced file uploads when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize file uploads for category forms
    if (document.getElementById('category_img')) {
        new EnhancedFileUpload('category_img', {
            previewContainer: 'image_preview',
            maxSize: 5 * 1024 * 1024, // 5MB
            allowedTypes: ['image/jpeg', 'image/jpg', 'image/png', 'image/gif']
        });
    }

    // Initialize file uploads for article forms
    if (document.getElementById('article_img')) {
        new EnhancedFileUpload('article_img', {
            previewContainer: 'image_preview',
            maxSize: 5 * 1024 * 1024, // 5MB
            allowedTypes: ['image/jpeg', 'image/jpg', 'image/png', 'image/gif']
        });
    }
});