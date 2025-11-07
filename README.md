<div align="center">

# 📰 NewsPortal - Modern News Publishing Platform

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=flat-square&logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-3.3.7-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Quill.js](https://img.shields.io/badge/Quill.js-2.0.3-blue?style=flat-square)](https://quilljs.com/)
[![License](https://img.shields.io/badge/License-PT_WINNICODE-red?style=flat-square)](LICENSE)

**A comprehensive news portal system with advanced Rich Text Editor, Text-to-Speech capabilities, and multi-role management**

[Features](#-key-features) • [Installation](#-installation) • [Tech Stack](#-tech-stack) • [Documentation](#-documentation)

</div>

---

## 📖 About The Project

**NewsPortal** is a modern, full-featured news publishing platform built during an internship at **PT WINNICODE**. This system provides a complete ecosystem for news creation, management, and consumption with three distinct user roles: Admin, Author, and User.

### 🎯 Project Goals

- 🚀 Provide an efficient, computerized platform for daily news access
- ✍️ Enable content creators with professional-grade Rich Text Editor
- 📱 Deliver responsive and accessible news reading experience
- 🔒 Ensure secure multi-role authentication and authorization
- 📊 Offer comprehensive admin dashboard for content management

---

## ✨ Key Features

### 🔐 **Multi-Role Authentication System**

<table>
<tr>
<td width="33%">

**👤 User Features**
- User registration & login
- Browse & search articles
- Bookmark favorite articles
- Download articles as PDF
- Text-to-Speech article reader
- Reading progress tracker
- Change password

</td>
<td width="33%">

**✍️ Author Features**
- Author registration & login
- Rich Text Editor (Quill.js)
- Create & publish articles
- Edit/Delete own articles
- Category selection
- Image upload
- Change name & password

</td>
<td width="33%">

**⚙️ Admin Features**
- Full user management
- Author account control
- Article activation/deactivation
- Category CRUD operations
- Trending section management
- Analytics dashboard
- System configuration

</td>
</tr>
</table>

### 📝 **Advanced Article Management**

#### **Rich Text Editor (Quill.js 2.0.3)**
Modern WYSIWYG editor with comprehensive formatting options:
- **Text Formatting**: Bold, Italic, Underline, Strikethrough
- **Headers**: H1-H6 support
- **Lists**: Ordered & Unordered lists
- **Media**: Images & Links embedding
- **Styling**: Text color & background color
- **Alignment**: Left, Center, Right, Justify
- **Advanced**: Blockquotes, Code blocks, Superscript/Subscript

#### **Content Features**
- ✅ Category-based organization
- ✅ Trending articles system
- ✅ Article activation/deactivation workflow
- ✅ Image upload with preview
- ✅ SEO-friendly URL structure
- ✅ Random article recommendations

### 👥 **Enhanced User Experience**

- 🔖 **Bookmarks System** - Save articles for later reading
- 🔍 **Advanced Search** - Search by title, category, keywords
- 📄 **PDF Export** - Download articles using mPDF library
- 🎯 **Reading Progress Bar** - Track reading progress
- 🌙 **Focus Mode** - Distraction-free reading experience
- 🔊 **Text-to-Speech** - Listen to articles using Web Speech API
  - Voice selection
  - Reading speed control
  - Visual feedback
  - Sentence-by-sentence highlighting

### 🎨 **Modern UI/UX Design**

- 📱 Fully responsive design (Desktop, Tablet, Mobile)
- 🎭 Bootstrap 3.3.7 + Custom CSS architecture
- 🖼️ Image slider for featured articles
- 🎉 SweetAlert2 for beautiful notifications
- ⬆️ Back-to-top button
- 🎨 Custom color-coded categories
- ⚡ Smooth animations and transitions

---

## 🛠️ Tech Stack

### **Backend Technologies**

| Technology | Version | Purpose |
|------------|---------|---------|
| PHP | 7.4+ | Server-side scripting |
| MySQL | 5.7+ | Relational database |
| MySQLi | - | Database connection with prepared statements |

### **Frontend Technologies**

| Technology | Version | Purpose |
|------------|---------|---------|
| HTML5 | - | Markup structure |
| CSS3 | - | Styling & animations |
| JavaScript | ES6 | Client-side interactivity |
| Bootstrap | 3.3.7 | Responsive framework |
| jQuery | 1.12.4 | DOM manipulation |
| Font Awesome | 5.13.0 | Icon library |

### **Libraries & Dependencies**

| Library | Version | Purpose |
|---------|---------|---------|
| [Quill.js](https://quilljs.com/) | 2.0.3 | Rich text editor |
| [SweetAlert2](https://sweetalert2.github.io/) | 11.10.1 | Alert notifications |
| [mPDF](https://mpdf.github.io/) | Latest | PDF generation |
| [PHPMailer](https://github.com/PHPMailer/PHPMailer) | Latest | Email functionality |
| [Web Speech API](https://developer.mozilla.org/en-US/docs/Web/API/Web_Speech_API) | - | Text-to-Speech |

---

## 📁 Project Structure

```
NewsPortal/
├── 📂 admin/                   # Admin panel
│   ├── includes/              # Admin-specific includes
│   │   ├── nav.inc.php       # Admin navigation
│   │   ├── footer.inc.php    # Admin footer
│   │   └── quick-links.inc.php
│   ├── login.php             # Admin authentication
│   ├── index.php             # Admin dashboard
│   ├── articles.php          # Article management
│   ├── categories.php        # Category management
│   ├── users.php             # User management
│   └── authors.php           # Author management
│
├── 📂 author/                  # Author panel
│   ├── includes/             # Author-specific includes
│   ├── add-article.php       # Create new article (Quill editor)
│   ├── edit-article.php      # Edit article
│   ├── articles.php          # Author's articles list
│   ├── change-name.php       # Update author name
│   └── change-password.php   # Update password
│
├── 📂 assets/                  # Static resources
│   ├── 📂 css/               # Stylesheets
│   │   ├── style.css        # Main stylesheet
│   │   ├── news-detail-enhanced.css
│   │   ├── quill-custom.css # Quill editor styles
│   │   ├── partials/        # CSS modules
│   │   └── admin/           # Admin styles
│   │
│   ├── 📂 js/                # JavaScript files
│   │   ├── news-detail-enhanced.js # TTS, Focus Mode
│   │   ├── sweetalert-wrapper.js
│   │   ├── author/
│   │   │   └── quill-editor-init.js # Quill configuration
│   │   └── admin/
│   │       └── admin-enhancements.js
│   │
│   ├── 📂 images/            # Media files
│   │   ├── articles/        # Article images
│   │   └── category/        # Category icons
│   │
│   ├── 📂 fonts/             # Custom fonts
│   └── 📂 vendor/            # Third-party libraries (Composer)
│
├── 📂 includes/                # Shared PHP includes
│   ├── database.inc.php      # Database connection
│   ├── functions.inc.php     # Helper functions
│   ├── nav.inc.php          # Main navigation
│   └── footer.inc.php       # Main footer
│
├── index.php                  # Homepage
├── news.php                   # Article detail page
├── search.php                 # Search functionality
├── bookmarks.php              # User bookmarks
├── download-article.php       # PDF generation
├── news-portal.sql            # Database schema
└── README.md                  # Documentation
```

---

## 🚀 Installation

### **Prerequisites**

Before you begin, ensure you have the following installed:

- ✅ **PHP** 7.4 or higher
- ✅ **MySQL** 5.7 or higher
- ✅ **Web Server** (XAMPP, WAMP, LAMP, or built-in PHP server)
- ✅ **Composer** (optional, for dependency management)
- ✅ **Modern Browser** (Chrome, Firefox, Edge for TTS features)

### **Step-by-Step Installation Guide**

#### **1. Clone or Download Project**

```bash
# Clone repository
git clone https://github.com/Mesayaaa/NewsPortal.git

# Navigate to project directory
cd NewsPortal
```

**OR** download the ZIP file and extract it to your web server directory.

#### **2. Database Setup**

**Option A: Using phpMyAdmin**
1. Open phpMyAdmin in your browser (`http://localhost/phpmyadmin`)
2. Create a new database named `news-portal`
3. Click on **Import** tab
4. Choose file: `news-portal.sql` from project root
5. Click **Go** to import

**Option B: Using MySQL Command Line**
```bash
mysql -u root -p
CREATE DATABASE `news-portal`;
USE `news-portal`;
SOURCE /path/to/NewsPortal/news-portal.sql;
EXIT;
```

#### **3. Configure Database Connection**

Edit `includes/database.inc.php`:

```php
// Development Connection
$host = "localhost";      // Your MySQL host
$user = "root";           // Your MySQL username
$pass = "";               // Your MySQL password
$db = "news-portal";      // Database name

$con = mysqli_connect($host, $user, $pass, $db);
```

#### **4. Set File Permissions** (Linux/Mac only)

```bash
# Make upload directories writable
chmod 755 assets/images/articles/
chmod 755 assets/images/category/

# Make cache directory writable
chmod 755 cache/
```

**Windows Users**: Right-click folders → Properties → Security → Edit permissions

#### **5. Start Development Server**

**Option A: Using PHP Built-in Server** (Recommended for development)
```bash
php -S localhost:8000
```

**Option B: Using XAMPP/WAMP**
1. Move project folder to `htdocs` (XAMPP) or `www` (WAMP)
2. Start Apache and MySQL services
3. Access: `http://localhost/NewsPortal/`

#### **6. Access the Application**

| Portal | URL |
|--------|-----|
| **Homepage** | `http://localhost:8000/` |
| **User Login** | `http://localhost:8000/user-login.php` |
| **Author Login** | `http://localhost:8000/author-login.php` |
| **Admin Panel** | `http://localhost:8000/admin/login.php` |

---

## 🔑 Default Access Credentials

### **Admin Account**
- **URL**: `http://localhost:8000/admin/login.php`
- **Email**: Check database `admin` table or create via SQL:
  ```sql
  INSERT INTO admin (admin_email, admin_password) 
  VALUES ('admin@newsportal.com', MD5('Admin@123'));
  ```
- **Note**: Password is hashed with MD5

### **Author Account**
- **Registration**: `http://localhost:8000/author-register.php`
- **Login**: `http://localhost:8000/author-login.php`
- Create your account through registration form

### **User Account**
- **Registration**: `http://localhost:8000/user-register.php`
- **Login**: `http://localhost:8000/user-login.php`
- Create your account through registration form

---

## 📊 Database Schema

### **Tables Overview**

| Table | Description | Key Fields |
|-------|-------------|------------|
| `admin` | Admin account data | admin_id, admin_email, admin_password |
| `author` | Author/Content creator data | author_id, author_name, author_email, author_password, author_active |
| `user` | Registered user data | user_id, user_name, user_email, user_password |
| `category` | Article categories | category_id, category_name, category_color |
| `article` | News articles with HTML content | article_id, article_title, article_description, article_image, article_date, article_active, article_trend, author_id, category_id |
| `bookmark` | User bookmarked articles | bookmark_id, user_id, article_id |

### **Entity Relationship**
- One Author → Many Articles (1:N)
- One Category → Many Articles (1:N)
- One User → Many Bookmarks (1:N)
- One Article → Many Bookmarks (1:N)

---

## 🎯 Key Features Implementation

### **1. Rich Text Editor (Quill.js)**

#### **Files Involved**
- `author/add-article.php` - Article creation form
- `author/edit-article.php` - Article editing form
- `assets/js/author/quill-editor-init.js` - Quill initialization
- `assets/css/quill-custom.css` - Custom editor styling

#### **Implementation Flow**
1. **Initialize Quill Editor** with full toolbar
2. **Sync content** to hidden textarea on form submit
3. **Server receives** HTML from textarea
4. **Save to database** with `mysqli_real_escape_string()`
5. **Display on frontend** without escaping HTML

#### **Code Example**

```javascript
// Initialize Quill
const quill = new Quill('#quill-editor', {
  theme: 'snow',
  modules: {
    toolbar: [
      [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      ['bold', 'italic', 'underline', 'strike'],
      [{ 'color': [] }, { 'background': [] }],
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      ['link', 'image'],
      ['clean']
    ]
  }
});

// Sync to hidden textarea
form.addEventListener('submit', function() {
  document.querySelector('#article_desc').value = quill.root.innerHTML;
});
```

---

### **2. Text-to-Speech (TTS)**

#### **Files Involved**
- `news.php` - Article detail page
- `assets/js/news-detail-enhanced.js` - TTS implementation
- `assets/css/news-detail-enhanced.css` - Visual feedback styles

#### **Features**
- ✅ Voice selection (multiple language support)
- ✅ Reading speed control (0.5x - 2.0x)
- ✅ Play/Pause/Stop controls
- ✅ Visual highlighting of current sentence
- ✅ Browser compatibility check

#### **Implementation Highlights**

```javascript
function initArticleTTS() {
    if (!('speechSynthesis' in window)) {
        return; // TTS not supported
    }
    
    const contentContainer = document.querySelector('.content-body');
    const plainText = contentContainer.innerText.trim();
    
    const utterance = new SpeechSynthesisUtterance(plainText);
    utterance.voice = selectedVoice;
    utterance.rate = parseFloat(rateSelect.value);
    
    window.speechSynthesis.speak(utterance);
}
```

**Important**: Uses `innerText` to preserve HTML structure while reading!

---

### **3. PDF Generation**

#### **Files Involved**
- `download-article.php` - PDF generation script
- `assets/vendor/mpdf/` - mPDF library

#### **Flow**
1. User clicks download button on article
2. Server fetches article data from database
3. HTML content formatted with inline CSS
4. mPDF generates PDF file
5. Force download to user's browser

#### **Code Example**

```php
require_once 'assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$html = '<h1>' . $article_title . '</h1>';
$html .= '<div>' . $article_description . '</div>';

$mpdf->WriteHTML($html);
$mpdf->Output($filename, 'D'); // D = Download
```

---

## 🔧 Technical Implementation Details

### **HTML Content Safety**

#### **Input (Save to Database)**
```php
// Escape special characters for SQL
$article_desc = mysqli_real_escape_string($con, $article_desc);

$query = "INSERT INTO article (article_description) 
          VALUES ('$article_desc')";
```

#### **Output (Display on Page)**
```php
<!-- Display HTML without escaping -->
<div class="content-body">
  <?php echo $article_desc; ?>
</div>
```

#### **Excerpt (Plain Text Preview)**
```php
// Strip HTML for preview/excerpt
$excerpt = strip_tags($article_desc);
$excerpt = substr($excerpt, 0, 150) . '...';
```

---

### **CSS Priority System**

The file `news-detail-enhanced.css` uses `!important` because:
- `style.css` has more specific selectors (`.article .article-content p`)
- Without `!important`, Quill formatting wouldn't display
- All content selectors use `.content-body` prefix for isolation

**Example:**
```css
.content-body strong,
.content-body b {
  font-weight: 700 !important;
  color: var(--black-color) !important;
}

.content-body em,
.content-body i {
  font-style: italic !important;
}
```

---

### **Form Validation**

#### **Client-side Validation**
- JavaScript regex validation
- Real-time feedback
- SweetAlert2 for error messages

**Validation Rules:**
```javascript
const ValidationRules = {
    name: /^[a-zA-Z ]{4,30}$/,
    email: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/,
    password: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/,
    articleTitle: /^[-@.,?\/#&+\w\s:;\'\'\"\`]{30,500}$/
};
```

#### **Server-side Validation**
- SQL injection prevention with `mysqli_real_escape_string()`
- Prepared statements for critical queries
- Session-based authentication checks

---

## 🐛 Troubleshooting

### **Issue: Styling Not Showing in Articles**

**Problem**: Bold, italic, colors not displaying in published articles

**Solutions**:
1. Hard refresh browser: `Ctrl + Shift + R` (Windows) or `Cmd + Shift + R` (Mac)
2. Clear browser cache completely
3. Check Developer Tools → Network → Verify `news-detail-enhanced.css` loaded (200 OK)
4. Check Developer Tools → Console for JavaScript errors
5. Verify CSS file path in `news.php`

---

### **Issue: Text-to-Speech Not Working**

**Problem**: TTS button doesn't work or no audio

**Solutions**:
1. **Check browser support**: 
   - ✅ Chrome (Best support)
   - ✅ Edge (Excellent)
   - ⚠️ Firefox (Limited)
   - ❌ Safari (Partial)
2. Verify element `#ttsToggle` exists in HTML
3. Check console for JavaScript errors
4. Try different browser
5. Ensure audio is not muted

---

### **Issue: Image Upload Failed**

**Problem**: Error when uploading article images

**Solutions**:

**Linux/Mac**:
```bash
chmod 755 assets/images/articles/
chmod 755 assets/images/category/
```

**Windows**: 
- Right-click folder → Properties → Security → Edit
- Give full control to Users group

**Check PHP settings** in `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
```

**Check image size**: Maximum 2MB (defined in `quill-editor-init.js`)

---

### **Issue: PDF Download Error**

**Problem**: Error when downloading articles as PDF

**Solutions**:
1. Verify mPDF installed: `assets/vendor/mpdf/` exists
2. Check temp folder is writable
3. Increase PHP memory in `php.ini`:
   ```ini
   memory_limit = 256M
   ```
4. Check for special characters in article title
5. Verify `download-article.php` has proper permissions

---

### **Issue: Database Connection Failed**

**Problem**: "Database Connection Error" message

**Solutions**:
1. Verify MySQL service is running
2. Check credentials in `includes/database.inc.php`:
   ```php
   $host = "localhost";
   $user = "root";      // Your username
   $pass = "";          // Your password
   $db = "news-portal"; // Database name
   ```
3. Verify database `news-portal` exists
4. Check MySQL port (default: 3306)
5. Import `news-portal.sql` if tables missing

---

## 🔒 Security Features

### **Authentication & Authorization**
- ✅ Session-based authentication
- ✅ MD5 password hashing (consider upgrading to bcrypt)
- ✅ Role-based access control (Admin/Author/User)
- ✅ Login attempt tracking

### **SQL Injection Prevention**
- ✅ `mysqli_real_escape_string()` for all inputs
- ✅ Prepared statements for critical queries
- ✅ Input sanitization with custom `get_safe_value()` function

### **XSS Protection**
- ✅ HTML escaping for user-generated content (except article body)
- ✅ Client-side validation
- ✅ Server-side validation

### **File Upload Security**
- ✅ File type validation (images only)
- ✅ File size limits (2MB max)
- ✅ Unique filename generation
- ✅ Restricted upload directories

---

## 🚀 Performance Optimizations

- ⚡ **CSS Minification**: Separate partials loaded modularly
- ⚡ **Lazy Loading**: Images loaded on demand
- ⚡ **Database Indexing**: Primary and foreign keys optimized
- ⚡ **Caching**: Static assets cached in browser
- ⚡ **CDN Usage**: Quill.js and libraries from CDN
- ⚡ **Optimized Queries**: Use of LIMIT in article listings

---

## 📈 Future Enhancements

### **Planned Features**
- [ ] Email notifications for new articles
- [ ] Social media sharing buttons
- [ ] Article commenting system
- [ ] Author profile pages
- [ ] Advanced analytics dashboard
- [ ] Newsletter subscription
- [ ] Multi-language support (i18n)
- [ ] Dark mode toggle
- [ ] Progressive Web App (PWA)
- [ ] RESTful API for mobile apps

### **Security Improvements**
- [ ] Upgrade password hashing from MD5 to bcrypt
- [ ] Implement CSRF token protection
- [ ] Add rate limiting for login attempts
- [ ] Two-factor authentication (2FA)
- [ ] Content Security Policy (CSP) headers

---

## 🤝 Contributing

Contributions are welcome! Please follow these guidelines:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### **Code Style Guidelines**
- Use meaningful variable names
- Comment complex logic
- Follow PSR-12 coding standards for PHP
- Use consistent indentation (4 spaces)
- Write self-documenting code

---

## 📄 License

© 2025 **PT WINNICODE**. All rights reserved.

This project was developed as part of an internship program at PT WINNICODE and is proprietary software. Unauthorized copying, distribution, or modification is prohibited without explicit permission.

---

## 👨‍💻 Developer Information

**Developed by**: Christopher Mesaya  
**Company**: PT WINNICODE  
**Role**: Intern Developer  
**Duration**: Internship Project  
**Version**: 2.0.0 (Quill.js Integration)  
**Last Updated**: November 7, 2025

### **Key Learnings from This Project**

✅ **Rich Text Editor Integration** - Implementing Quill.js without breaking HTML structure  
✅ **CSS Specificity & Importance** - Managing competing stylesheets with `!important`  
✅ **SQL Injection Prevention** - Proper use of `mysqli_real_escape_string()` and prepared statements  
✅ **Web Speech API** - Implementing Text-to-Speech while preserving DOM structure  
✅ **Multi-role Authentication** - Building secure session-based auth systems  
✅ **File Upload Handling** - Secure image upload with validation  
✅ **PDF Generation** - Using mPDF library for document export  
✅ **Responsive Design** - Mobile-first approach with Bootstrap  
✅ **Clean Code Practices** - Modular architecture and separation of concerns  

---

## 🙏 Acknowledgments

Special thanks to:
- **PT WINNICODE** - For the internship opportunity and guidance
- **Quill.js Team** - For the excellent Rich Text Editor
- **mPDF Contributors** - For the PDF generation library
- **Bootstrap Team** - For the responsive framework
- **SweetAlert2** - For beautiful alert components
- **Stack Overflow Community** - For technical support and solutions

---

<div align="center">

**⭐ If you find this project helpful, please give it a star! ⭐**

**Made with ❤️ during internship at PT WINNICODE**

[Back to Top](#-newsportal---modern-news-publishing-platform)

</div>
