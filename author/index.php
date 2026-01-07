<?php
require('./includes/nav.inc.php');

?>


<section id="main">
  <div class="container">
    <div class="row">
      <?php

      $cat_sql = "SELECT COUNT(category_id) 
                    AS no_of_categories 
                    FROM category";
      $cat_result = mysqli_query($con, $cat_sql);
      $cat_data = mysqli_fetch_assoc($cat_result);
      $no_of_categories = $cat_data['no_of_categories'];

      $book_sql = "SELECT COUNT(bookmark_id) 
                      AS no_of_bookmarks 
                      FROM article,bookmark 
                      WHERE article.author_id = {$author_id} 
                      AND bookmark.article_id = article.article_id";
      $book_result = mysqli_query($con, $book_sql);
      $book_data = mysqli_fetch_assoc($book_result);
      $no_of_bookmarks = $book_data['no_of_bookmarks'];

      // echo "<pre>";
      // print_r($book_data);
      // echo "</pre>";
      
      require('./includes/quick-links.inc.php');
      ?>
      <div class="col-md-9">
        <!-- Website Overview -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Overview</h3>
          </div>
          <div class="panel-body author-dashboard-overview" style="padding: 2.5rem;">
            <div class="row">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="dash-box author-dash-box">
                  <div class="dash-icon" style="color: var(--primary-color);">
                    <span class="glyphicon glyphicon-pencil"></span>
                  </div>
                  <h2><?php echo $no_of_articles; ?></h2>
                  <h4>Articles</h4>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="dash-box author-dash-box">
                  <div class="dash-icon" style="color: var(--secondary-color);">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                  </div>
                  <h2><?php echo $no_of_categories; ?></h2>
                  <h4>Categories</h4>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="dash-box author-dash-box">
                  <div class="dash-icon" style="color: var(--tag-green-color);">
                    <span class="glyphicon glyphicon-bookmark"></span>
                  </div>
                  <h2><?php echo $no_of_bookmarks; ?></h2>
                  <h4>Bookmarks</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Latest Articles -->
    <div class="row">
      <?php

      $sql = "SELECT article.article_title, 
                article.article_date, 
                article.article_image, 
                category.category_name 
                FROM article, category 
                WHERE article.author_id = {$author_id} 
                AND article.category_id = category.category_id 
                ORDER BY article_date DESC
                LIMIT 4";
      $result = mysqli_query($con, $sql);
      $row = mysqli_num_rows($result);

      ?>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Latest Articles</h4>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped article-list table-hover">
                <tr>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Published On</th>
                </tr>
                <?php
                if ($row > 0) {
                  while ($data = mysqli_fetch_assoc($result)) {
                    $category_name = $data['category_name'];
                    $article_title = $data['article_title'];
                    $article_image = $data['article_image'];
                    $article_date = $data['article_date'];
                    $article_date = date("d M y", strtotime($article_date));

                    echo '
                      <tr>
                        <td>
                          ' . $article_title . '
                        </td>
                        <td>
                          ' . $category_name . '
                        </td>
                        <td>
                          <img src="../assets/images/articles/' . $article_image . '" />
                        </td>
                        <td>
                          ' . $article_date . '
                        </td>
                      </tr>
                    ';
                  }
                  echo '
                    <tr>
                      <td colspan="4" align="center" style="padding-top: 2rem;">
                        <a href="./articles.php" class="btn btn-danger ">View All</a>
                      </td>
                    </tr>
                  ';
                } else {
                  echo '
                    <tr>
                      <td colspan="4" class="text-center">
                        <div class="empty-state empty-state--table">
                          <p class="empty-state__text">Start writing your first article, ' . htmlspecialchars($_SESSION['AUTHOR_NAME']) . '.</p>
                        </div>
                      </td>
                    </tr>
                  ';
                }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require('./includes/footer.inc.php')
  ?>