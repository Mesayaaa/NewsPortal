<?php
require('./includes/nav.inc.php');
?>

<style>
  /* Responsive Table Styles for Admin */
  .table-responsive-custom {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .article-table {
    min-width: 1200px;
    margin-bottom: 0;
  }

  .article-table th,
  .article-table td {
    vertical-align: middle !important;
    padding: 8px !important;
    white-space: nowrap;
  }

  .article-table .title-col {
    max-width: 180px;
    min-width: 140px;
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }

  .article-table .content-col {
    max-width: 220px;
    min-width: 180px;
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
    line-height: 1.4;
  }

  .article-table .category-col {
    max-width: 100px;
    min-width: 80px;
  }

  .article-table .author-col {
    max-width: 120px;
    min-width: 100px;
  }

  .article-table .image-col {
    width: 80px;
    text-align: center;
  }

  .article-table .image-col img {
    width: 50px;
    height: 35px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #ddd;
  }

  .article-table .date-col {
    width: 90px;
    min-width: 80px;
  }

  .article-table .actions-col {
    width: 140px;
    min-width: 130px;
    text-align: center;
  }

  .article-table .actions-col .btn {
    margin: 1px;
    padding: 4px 8px;
  }

  /* Mobile responsive adjustments */
  @media (max-width: 768px) {
    .table-responsive-custom {
      border: 1px solid #ddd;
    }

    .article-table th,
    .article-table td {
      padding: 6px !important;
      font-size: 12px;
    }

    .article-table .title-col {
      max-width: 140px;
      min-width: 110px;
    }

    .article-table .content-col {
      max-width: 160px;
      min-width: 130px;
    }

    .article-table .image-col img {
      width: 40px;
      height: 30px;
    }

    .article-table .actions-col .btn {
      padding: 3px 6px;
      font-size: 11px;
    }
  }

  /* Text truncation with tooltip */
  .text-truncate-custom {
    display: block;
    max-height: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
    position: relative;
  }
</style>

<script>
  function deleteConfirm(id) {
    showConfirm(
      'Delete Article?',
      'Are you sure you want to delete this article? This action cannot be undone!',
      'Yes, Delete it!',
      'Cancel'
    ).then((result) => {
      if (result.isConfirmed) {
        var url = "./delete-article.php?id=" + id;
        document.location = url;
      }
    });
  }
</script>

<!-- BREADCRUMB -->
<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Dashboard</a></li>
      <li class="active">Articles</li>
    </ol>
  </div>
</section>


<section id="main">
  <div class="container">
    <div class="col-md-12">
      <?php
      $limit = 6;
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $offset = ($page - 1) * $limit;
      $sql = "SELECT article.article_title, 
                article.article_id, 
                article.article_date, 
                author.author_name, 
                article.article_image, 
                article.article_trend, 
                article.article_active, 
                article.article_description, 
                category.category_name 
                FROM article, category, author
                WHERE article.category_id = category.category_id
                AND article.author_id = author.author_id
                ORDER BY article.article_date DESC
                LIMIT {$offset},{$limit}";
      $result = mysqli_query($con, $sql);
      $row = mysqli_num_rows($result);

      ?>
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title">Articles</h3>
        </div>
        <div class="panel-body">
          <div class="table-responsive-custom">
            <table class="table table-striped table-hover article-table">
              <thead>
                <tr>
                  <th class="title-col">Title</th>
                  <th class="category-col">Category</th>
                  <th class="content-col">Content</th>
                  <th class="image-col">Image</th>
                  <th class="author-col">Author</th>
                  <th class="date-col">Published</th>
                  <th class="actions-col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($row > 0) {
                  while ($data = mysqli_fetch_assoc($result)) {
                    $category_name = $data['category_name'];
                    $article_id = $data['article_id'];
                    $article_title = $data['article_title'];
                    $article_trend = $data['article_trend'];
                    $article_desc = $data['article_description'];
                    $article_image = $data['article_image'];
                    $article_date = $data['article_date'];
                    $article_author = $data['author_name'];
                    $article_active = $data['article_active'];

                    $article_desc = substr($article_desc, 0, 150) . "...";
                    $article_title_short = strlen($article_title) > 45 ? substr($article_title, 0, 45) . "..." : $article_title;
                    $article_date = date("d M y", strtotime($article_date));

                    echo '
                      <tr>
                        <td class="title-col">
                          <div class="text-truncate-custom" title="' . htmlspecialchars($article_title) . '">
                            ' . htmlspecialchars($article_title_short) . '
                          </div>
                        </td>
                        <td class="category-col">
                          <span class="label label-info">' . htmlspecialchars($category_name) . '</span>
                        </td>
                        <td class="content-col">
                          <div class="text-truncate-custom" title="' . htmlspecialchars(strip_tags($data['article_description'])) . '">
                            ' . htmlspecialchars($article_desc) . '
                          </div>
                        </td>
                        <td class="image-col">
                          <img src="../assets/images/articles/' . htmlspecialchars($article_image) . '" 
                               alt="Article Image" 
                               title="' . htmlspecialchars($article_title) . '" />
                        </td>
                        <td class="author-col">
                          <span class="label label-success">' . htmlspecialchars($article_author) . '</span>
                        </td>
                        <td class="date-col">
                          <small>' . $article_date . '</small>
                        </td>
                        <td class="actions-col">';
                    if ($article_trend > 0) {
                      echo '
                          <a class="btn btn-danger btn-sm" href="./deactivate-trend.php?id=' . $article_id . '" title="Remove from Trending">
                            <span class="glyphicon glyphicon-heart"></span>
                          </a>';
                    } else {
                      echo '
                          <a class="btn btn-warning btn-sm" href="./activate-trend.php?id=' . $article_id . '" title="Make Trending">
                            <span class="glyphicon glyphicon-heart-empty"></span>
                          </a>';
                    }

                    if ($article_active > 0) {
                      echo '
                          <a class="btn btn-success btn-sm" href="./deactivate-article.php?id=' . $article_id . '" title="Deactivate">
                            <span class="glyphicon glyphicon-eye-open"></span>
                          </a>';
                    } else {
                      echo '
                          <a class="btn btn-info btn-sm" href="./activate-article.php?id=' . $article_id . '" title="Activate">
                            <span class="glyphicon glyphicon-eye-close"></span>
                          </a>';
                    }

                    echo '
                          <button class="btn btn-danger btn-sm" onclick="deleteConfirm(' . $article_id . ')" title="Delete">
                            <span class="glyphicon glyphicon-trash"></span>
                          </button>
                        </td>
                      </tr>
                    ';
                  }
                } else {
                  echo '
                    <tr>
                      <td colspan="7" class="text-center" style="padding: 30px; color: var(--active-color);">
                        <div>
                          <i class="glyphicon glyphicon-file-alt" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                          <h4>No Articles Found!</h4>
                          <p>Authors need to start writing articles.</p>
                        </div>
                      </td>
                    </tr>
                  ';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="text-center">
          <ul class="pagination pg-red">
            <?php
            $paginationQuery = "SELECT * FROM article";
            $paginationResult = mysqli_query($con, $paginationQuery);
            if (mysqli_num_rows($paginationResult) > 0) {
              $total_articles = mysqli_num_rows($paginationResult);
              $total_page = ceil($total_articles / $limit);

              if ($page > $total_page) {
                redirect('./articles.php');
              }
              if ($page > 1) {
                echo '
                    <li class="page-item">
                      <a href="articles.php?page=' . ($page - 1) . '" class="page-link">
                        <span>&laquo;</span>
                      </a>
                    </li>';
              }
              for ($i = 1; $i <= $total_page; $i++) {
                $active = "";
                if ($i == $page) {
                  $active = "active";
                }
                echo '<li class="page-item ' . $active . '"><a href="./articles.php?page=' . $i . '" class="page-link">' . $i . '</a></li>';
              }
              if ($total_page > $page) {
                echo '
                    <li class="page-item">
                      <a href="articles.php?page=' . ($page + 1) . '" class="page-link">
                        <span>&raquo;</span>
                      </a>
                    </li>';
              }
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require('./includes/footer.inc.php')
  ?>