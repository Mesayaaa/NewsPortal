# 📰 NewsPortal - WinniCode# NewsGrid - News Portal

Portal berita modern dengan fitur Rich Text Editor menggunakan Quill.js untuk pembuatan artikel oleh author.

### 🔐 User Management

- **User Registration & Login** - Sistem autentikasi untuk user biasaTechnologies used:

- **Author Registration & Login** - Sistem autentikasi khusus untuk pembuat konten  

- **Admin Panel** - Manajemen penuh untuk admin- Front end: HTML, CSS, JavaScript, Bootstrap (for Admin Panel only)

- Back end: PHP, MySQL

### 📝 Article Management
- Library: mPDF Library

- **Rich Text Editor (Quill.js 2.0.3)** - Editor modern untuk author dengan fitur:  <br>

  - Bold, Italic, Underline, Strikethrough

  - Headers (H1-H6)This project aims to develop a computerized and easy to access the day-to-day news without having to wait. “NewsGrid” is aimed at developing such an efficient website that helps in providing up to date news about various happenings around the world.

  - Ordered & Unordered Lists

  - Links & Images```

  - Text Color & Background ColorAdmin login details: 

  - Text Alignment (Left, Center, Right, Justify)email - admin@admin.com

  - Blockquotes & Code Blockspassword - Admin123

- **Article Categories** - Organisasi artikel berdasarkan kategori```

- **Trending Articles** - Sistem highlight artikel trending

- **Article Activation/Deactivation** - Kontrol publikasi oleh admin



### 👥 User Features
## Module Description

- **Bookmarks** - Simpan artikel favorit

- **Search** - Pencarian artikelThe entire project as a whole can be divided into 4 modules, the

- **Download PDF** - Download artikel dalam format PDF (mPDF)four modules being:

- **Reading Progress** - Progress bar saat membaca artikel

- **Focus Mode** - Mode baca fokus tanpa distraksi
  
- **Text-to-Speech** - Baca artikel dengan suara (Web Speech API)


### 🎨 UI/UX
- **Responsive Design** - Bootstrap 3.3.7 + Custom CSS

- **Image Slider** - Slider artikel di homepage### Admin Module

- **SweetAlert2** - Notifikasi yang menarik

- **Back to Top Button** - Navigasi cepat ke atas- Admin can modify and delete user account and restrict them from entering the logged-in portal of NewsGrid.

- Admin can modify and delete Author account and restricting inactive authors from writing new articles on NewsGrid.

## 🛠️ Tech Stack- Admin can add, modify and delete categories under which various articles are written.

- Admin can delete all the News Articles present in the NewsGrid Portal, decides whether the particular article should stay or not.

### Backend- Admin manages the Trending section of the portal, chooses which article goes under Trending section and is displayed on carousel

- **PHP 7.4+** - Server-side scripting- Admin can manage his account credentials (i.e.) can change password.

- **MySQL 5.7+** - Database

- **MySQLi** - Database connection dengan prepared statements<hr style="font-size: 10px;margin: auto;" width="90%" >



### Frontend
### Author Module

- **HTML5 & CSS3**

- **JavaScript (ES6)**- Author can write new articles and post in the NewsGrid portal by selecting the appropriate category in which the article is written and to be displayed.

- **Bootstrap 3.3.7**- Author can modify and delete articles written by him only.

- **jQuery 1.12.4**- Author can manage his account credentials (i.e.) can change password & name.

- **Font Awesome 5.13.0**

<hr style="font-size: 10px;margin: auto;" width="90%" >

### Libraries

- **Quill.js 2.0.3** - Rich text editor

### User Module

- **SweetAlert2 v11.10.1** - Alert notifications

- **mPDF** - PDF generation- User can browse through NewsGrid website and search for articles under various categories present in the portal.

- **PHPMailer** - Email functionality- User can search for articles based in his preferred categories like Sports, Entertainment, Politics, etc.

- User can search for a particular article based on specific keywords like title of the article or category name, trending.

## 📁 Struktur Project
- User can sort articles date wise and view articles posted on particular date of choice or between a span of days.

- User can also look up the trending articles of the week.

```- User can manage his account credentials (i.e.) can change password.

NewsPortal/

├── admin/              # Panel admin<hr style="font-size: 10px;margin: auto;" width="90%" >

│   ├── includes/      # Admin includes

│   └── *.php         # Admin pages### Premium User Module

├── author/            # Panel author

│   ├── includes/     # Author includes- A Premium User can basically do everything a free user can do. User can browse through NewsGrid website and search for articles under various categories present in the portal.

│   └── *.php        # Author pages- User can search for a particular article based on specific keywords like title of the article or category name, trending, date.

├── assets/           # Static files- Premium User can download an article of his choice in PDF format from any web browser from NewsGrid Portal.

│   ├── css/         # Stylesheets- Premium User can bookmark an article for future references and all the bookmarked articles are visible separately on the Bookmarks Page.

│   │   ├── partials/         # CSS partials (fonts, variables, reset)- Premium User can manage his account credentials (i.e.) can change password.

│   │   ├── responsivity/     # Media queries

│   │   └── admin/            # Admin CSS---

│   ├── js/          # JavaScript files

│   │   ├── author/           # Author JS (quill-editor-init.js)## Project Diagrams

│   │   └── admin/            # Admin JS

│   ├── images/      # Images (articles, categories)#### Activity Diagram

│   ├── fonts/       # Custom fonts<img src="https://github.com/Anish-U/NewsGrid/blob/10688607a9c5eb8d4b967baccaac7e2d78adfaad/Diagrams/AD.jpg" width="500">

│   └── vendor/      # Third-party libraries (Composer)

├── includes/        # PHP includes#### Entity Relationship Diagram

│   ├── database.inc.php      # DB connection<img src="https://github.com/Anish-U/NewsGrid/blob/10688607a9c5eb8d4b967baccaac7e2d78adfaad/Diagrams/ER.jpeg" width="500">

│   ├── functions.inc.php     # Helper functions

│   ├── nav.inc.php          # Navigation#### Database Design

│   └── footer.inc.php       # Footer<img src="https://github.com/Anish-U/NewsGrid/blob/10688607a9c5eb8d4b967baccaac7e2d78adfaad/Diagrams/RS.jpeg" width="500">

├── error-pages/     # Custom error pages (404, 403, 500)

└── *.php           # Public pages---

```

## Project Screenshots

## 🚀 Setup & Installation

#### Home Page

### Requirements<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/home.png" width="500">

- PHP 7.4 or higher

- MySQL 5.7 or higher#### Categories Page

- XAMPP or similar local server
  
- Composer (optional, untuk vendor)

#### Search Page

### Installation Steps

1. **Clone/Download Project**

#### Login & Signup Page

   ```bash<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/login.png" width="500">

   git clone <repository-url>

   cd NewsPortal#### Bookmarks Page

   ```<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/bookmarks.png" width="500">

3. **Import Database**#### Change Password Page

   - Buka phpMyAdmin<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/changePassword.png" width="500">

   - Create database: `news_portal`

   - Import file: `news-portal.sql`#### Author Dashboard Page

<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/authorPanelDashboard.png" width="500">

3. **Configure Database**

   Edit `includes/database.inc.php`:#### Add Article Page

   ```php<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/authorPanelAddArticle.png" width="500">

   $db_host = "localhost";

   $db_user = "root";#### Edit Article Page

   $db_pass = "";<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/authorPanelEditArticle.png" width="500">

   $db_name = "news_portal";

   ```#### All Articles Page

<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/authorPanelArticles.png" width="500">

4. **Set Permissions**

   ```bash#### Author Change Name Page

   chmod 755 assets/images/articles/<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/authorPanelChangeName.png" width="500">

   chmod 755 assets/images/category/

   ```#### Admin Login Page

<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/adminPanelLogin.png" width="500">

5. **Start Server**

   ```bash#### Admin Manage Articles Page

   php -S localhost:8000<img src="https://github.com/Anish-U/NewsGrid/blob/master/screenshots/adminPanelArticles.png" width="500">

   ```

#### Admin Manage Category Page

6. **Access Application**
   
   - Homepage: `http://localhost:8000/`

   - Admin: `http://localhost:8000/admin/`---

   - Author: `http://localhost:8000/author/`

## Development setup

## 👤 Default Access

#### 1. Retrieve the project (if you haven't done so already)

### Admin

- URL: `http://localhost:8000/admin/login.php````git

- Check database for admin credentials $ git clone https://github.com/Anish-U/NewsGrid.git

```

### Author or download the project via GitHub

- Register: `http://localhost:8000/author-register.php`

- Login: `http://localhost:8000/author-login.php`#### 2. Move project folder to htdocs folder



### User if you cannot find the htdocs folder please follow the below links,

- Register: `http://localhost:8000/user-register.php`

- Login: `http://localhost:8000/user-login.php`- [Where to find htdocs in XAMPP Mac](https://stackoverflow.com/questions/45518021/where-to-find-htdocs-in-xampp-mac)

- [Find htdocs path, no matter where file is stored](https://stackoverflow.com/questions/5536730/find-htdocs-path-no-matter-where-file-is-stored)

## 📊 Database Tables- [htdocs path in linux](https://stackoverflow.com/questions/1582851/htdocs-path-in-linux)

- [https://stackoverflow.com/questions/1582851/htdocs-path-in-linux](https://stackoverflow.com/questions/44989243/unable-to-find-htdocs-on-xampp)

- `article` - Artikel dengan HTML content dari Quill

- `author` - Data author#### 3. Restore Database

- `category` - Kategori artikel

- `user` - Data user- Goto phpMyAdmin and create a Database names `news-portal`.

- `user_bookmark` - Bookmark artikel oleh user- Now Select Import.

- `admin` - Data admin- Find 'File to import:' section and choose the file 'news-portal.sql' which is located under project folder and hit GO.



## 🎯 Key Features Implementation#### 4.Setup Database Configurations



### Rich Text Editor (Quill.js)- Go to project folder -> includes -> database.inc.php.

- Setup your configurations related to MySQL.

**Files:**  - Eg: Server Name -> `localhost`, MySQL Username -> `root`.

- `author/add-article.php` - Form tambah artikel

- `author/edit-article.php` - Form edit artikel#### 5. Start Server

- `assets/js/author/quill-editor-init.js` - Inisialisasi Quill

- `assets/css/quill-custom.css` - Custom styling editor- Start the server and run http://localhost:8888/Folder_name/index.php (replace the port number 8888 to your port).

- Alternatively you can also run the command on your terminal

**Flow:**  ```terminal

1. Quill editor di-init dengan toolbar lengkap     php -S localhost:8888 (replace the port number to your choice)

2. Content di-sync ke hidden textarea saat submit  ```

3. Server terima HTML dari textarea
4. Simpan ke database dengan `mysqli_real_escape_string()`

### Article Display with Formatting

**Files:**
- `news.php` - Halaman detail artikel
- `assets/css/news-detail-enhanced.css` - Styling HTML content
- `assets/js/news-detail-enhanced.js` - Interactive features

**Key Points:**
- Output HTML **TANPA escaping**: `<?php echo $article_desc; ?>`
- CSS menggunakan `!important` untuk override style.css
- Wrapper `.content-body` untuk isolasi styling
- TTS tidak merusak HTML structure

### Text-to-Speech (TTS)

**Implementation:**
- Menggunakan Web Speech API
- Ambil `innerText` untuk audio, TIDAK modifikasi `innerHTML`
- Visual feedback: background color saat membaca
- Support voice selection dan speed control

### PDF Generation

**Files:**
- `download-article.php` - Generate PDF
- Library: mPDF

**Flow:**
1. Ambil article content (HTML)
2. Format dengan CSS inline
3. Generate PDF dengan mPDF
4. Force download

## 🔧 Important Technical Notes

### HTML Content Safety

**Input (Save to DB):**
```php
$article_desc = mysqli_real_escape_string($con, $article_desc);
$query = "INSERT INTO article (article_description) VALUES ('$article_desc')";
```

**Output (Display):**
```php
<div class="content-body">
  <?php echo $article_desc; ?>
</div>
```

**Excerpt (Plain Text):**
```php
$excerpt = strip_tags($article_desc);
$excerpt = substr($excerpt, 0, 150);
```

### CSS Priority System

File `news-detail-enhanced.css` menggunakan `!important` karena:
- `style.css` memiliki selector `.article .article-content p` yang lebih spesifik
- Tanpa `!important`, styling dari Quill tidak muncul
- Semua selector content menggunakan `.content-body` sebagai prefix

Example:
```css
.content-body strong,
.content-body b {
  font-weight: 700 !important;
  color: var(--black-color) !important;
}
```

### TTS Without HTML Modification

**OLD (Merusak HTML):**
```javascript
contentContainer.innerHTML = htmlSentences; // ❌ WRONG
```

**NEW (Preserve HTML):**
```javascript
// Hanya ambil text untuk audio
const plain = contentContainer.innerText.trim();

// Visual feedback tanpa modifikasi HTML
contentContainer.style.backgroundColor = '#fff9e6';
```

## 🐛 Troubleshooting

### Styling Tidak Muncul di Article
**Problem:** Bold, italic, colors tidak tampil

**Solution:**
1. Hard refresh: `Ctrl + Shift + R`
2. Clear browser cache completely
3. Check Developer Tools → Network → Verify `news-detail-enhanced.css` loaded (200 OK)
4. Check Developer Tools → Console → No JavaScript errors

### TTS Tidak Berfungsi
**Problem:** Text-to-Speech button tidak bekerja

**Solution:**
1. Check browser support: Chrome, Edge (best), Firefox (limited)
2. Verify element `#ttsToggle` exists in HTML
3. Check console for errors
4. Try different browser

### Upload Image Gagal
**Problem:** Error saat upload gambar artikel

**Solution:**
1. Check folder permissions: `chmod 755 assets/images/articles/`
2. Verify PHP settings in `php.ini`:
   ```ini
   upload_max_filesize = 10M
   post_max_size = 10M
   ```
3. Check image size: max 2MB (di `quill-editor-init.js`)

### PDF Download Error
**Problem:** Error saat download PDF

**Solution:**
1. Check mPDF installed: `assets/vendor/mpdf/`
2. Verify temp folder writable
3. Check PHP memory: `memory_limit = 256M`

## 📄 License

© 2025 PT WINNICODE. All rights reserved.

## 👨‍💻 Developer Notes

Developed during internship at **PT WINNICODE**

### Key Learnings
- ✅ Rich text editor integration tanpa merusak HTML
- ✅ CSS specificity dan importance handling
- ✅ SQL injection prevention dengan mysqli
- ✅ Web Speech API implementation
- ✅ Clean code practices

---

**Project Status:** ✅ Production Ready

**Last Updated:** October 23, 2025

**Version:** 2.0.0 (Quill.js Integration)
