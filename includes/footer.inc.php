<!--? ======== FOOTER ======== -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-content">
      <div class="footer-section about">
        <div class="footer-logo">
          <a href="./index.php"><img src="./assets/images/logo_light.png" alt="NewsGrid Logo" /></a>
        </div>
        <p class="footer-description">
          Your trusted source for global news and current affairs. We bring you comprehensive coverage from esteemed
          journalists worldwide, keeping you informed about what matters most.
        </p>
        <div class="footer-stats">
          <div class="stat-item">
            <span class="stat-number">50K+</span>
            <span class="stat-label">Daily Readers</span>
          </div>
          <div class="stat-item">
            <span class="stat-number">1000+</span>
            <span class="stat-label">Articles</span>
          </div>
          <div class="stat-item">
            <span class="stat-number">24/7</span>
            <span class="stat-label">Coverage</span>
          </div>
        </div>
        <div class="social-links">
          <a href="#" class="social-link facebook" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="social-link youtube" aria-label="YouTube">
            <i class="fab fa-youtube"></i>
          </a>
          <a href="#" class="social-link twitter" aria-label="Twitter">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="social-link instagram" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="social-link linkedin" aria-label="LinkedIn">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>
      <div class="footer-section links">
        <h3 class="footer-title">
          <i class="fas fa-link"></i>
          Quick Links
        </h3>
        <ul class="footer-links">
          <li><a href="./index.php"><i class="fas fa-home"></i> Home</a></li>
          <li><a href="./categories.php"><i class="fas fa-th-large"></i> Categories</a></li>
          <li><a href="./bookmarks.php"><i class="fas fa-bookmark"></i> Bookmarks</a></li>
          <li><a href="./search.php?trending=1"><i class="fas fa-fire"></i> Trending</a></li>
          <li><a href="./search.php"><i class="fas fa-search"></i> Search</a></li>
        </ul>
      </div>

      <div class="footer-section categories">
        <h3 class="footer-title">
          <i class="fas fa-tags"></i>
          Popular Categories
        </h3>
        <ul class="footer-links">
          <?php
          // Category Query to fetch random 4 categories
          $categoryQuery = "SELECT category_id, category_name FROM category ORDER BY RAND() LIMIT 4";
          $result = mysqli_query($con, $categoryQuery);
          $row = mysqli_num_rows($result);

          if ($row > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
              $category_id = $data['category_id'];
              $category_name = $data['category_name'];
              ?>
              <li><a href="articles.php?id=<?php echo $category_id ?>"><i class="fas fa-chevron-right"></i>
                  <?php echo $category_name ?></a></li>
            <?php
            }
          }
          ?>
          <li><a href="./categories.php" class="view-all"><i class="fas fa-plus-circle"></i> View All Categories</a>
          </li>
        </ul>
      </div>

      <div class="footer-section newsletter">
        <h3 class="footer-title">
          <i class="fas fa-envelope"></i>
          Stay Updated
        </h3>
        <p class="newsletter-description">
          Subscribe to our newsletter and never miss breaking news and exclusive stories.
        </p>
        <form class="newsletter-form" action="#" method="POST">
          <div class="input-group">
            <input type="email" placeholder="Enter your email address" required>
            <button type="submit" class="subscribe-btn">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
        </form>
        <div class="join-section">
          <h4>Become a Writer</h4>
          <p>Share your stories with the world and inspire millions of readers.</p>
          <a href="./author-login.php" class="join-btn">
            <i class="fas fa-pen"></i>
            Join as Author
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="footer-bottom-content">
      <div class="copyright">
        <p>&copy; <?php echo date("Y") ?> NewsGrid. All rights reserved.</p>
      </div>
      <div class="footer-bottom-links">
        <a href="#" class="footer-bottom-link">Privacy Policy</a>
        <a href="#" class="footer-bottom-link">Terms of Service</a>
        <a href="#" class="footer-bottom-link">Contact Us</a>
      </div>
      <div class="back-to-top">
        <button onclick="topFunction()" class="back-to-top-btn" title="Back to top">
          <i class="fas fa-chevron-up"></i>
        </button>
      </div>
    </div>
  </div>
</footer>

<!-- JQUERY SCRIPT -->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- SCRIPT FOR BACK TO TOP BUTTON -->
<script src="../assets/js/back-to-top.js"></script>

<!-- SCRIPT FOR NAVBAR COLLAPSE -->
<script src="../assets/js/navbar-collapse.js"></script>
</body>

</html>