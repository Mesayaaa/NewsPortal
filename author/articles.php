<?php
require('./includes/nav.inc.php');
?>

<style>
  /* Responsive Table Styles */
  .table-responsive-custom {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .article-table {
    min-width: 1000px;
    margin-bottom: 0;
  }

  .article-table th,
  .article-table td {
    vertical-align: middle !important;
    padding: 8px !important;
    white-space: nowrap;
  }

  .article-table .title-col {
    max-width: 200px;
    min-width: 150px;
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }

  .article-table .content-col {
    max-width: 250px;
    min-width: 200px;
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
    line-height: 1.4;
  }

  .article-table .category-col {
    max-width: 120px;
    min-width: 100px;
  }

  .article-table .image-col {
    width: 90px;
    text-align: center;
  }

  .article-table .image-col img {
    width: 60px;
    height: 40px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #ddd;
  }

  .article-table .active-col {
    width: 50px;
    text-align: center;
  }

  .article-table .date-col {
    width: 100px;
    min-width: 90px;
  }

  .article-table .actions-col {
    width: 120px;
    min-width: 110px;
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
      max-width: 150px;
      min-width: 120px;
    }

    .article-table .content-col {
      max-width: 180px;
      min-width: 150px;
    }

    .article-table .image-col img {
      width: 50px;
      height: 35px;
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

  /* Clean panel header styling to match admin */
  .panel-default .panel-heading {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
    border-bottom: 1px solid #dee2e6 !important;
    color: var(--dark-color) !important;
    padding: 15px 20px !important;
    border-top-left-radius: 8px !important;
    border-top-right-radius: 8px !important;
  }

  .panel-default .panel-title {
    font-size: 1.2rem !important;
    font-weight: 600 !important;
    color: var(--dark-color) !important;
    margin: 0 !important;
    font-family: var(--ff-nunito) !important;
  }

  .panel-default {
    border: 1px solid #dee2e6 !important;
    border-radius: 8px !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
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
      $limit = 5;
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $offset = ($page - 1) * $limit;
      $sql = "SELECT article.article_title, 
                article.article_id, 
                article.article_date, 
                article.article_image, 
                article.article_active, 
                article.article_description, 
                category.category_name 
                FROM article, category 
                WHERE article.author_id = {$author_id} 
                AND article.category_id = category.category_id
                ORDER BY article.article_date DESC,
                article.article_id DESC
                LIMIT {$offset},{$limit}";
      $result = mysqli_query($con, $sql);
      $row = mysqli_num_rows($result);

      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">Articles</h4>
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
                  <th class="active-col">Active</th>
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
                    $article_desc = $data['article_description'];
                    $article_image = $data['article_image'];
                    $article_date = $data['article_date'];
                    $article_active = $data['article_active'];

                    $article_desc = substr($article_desc, 0, 150) . "...";
                    $article_title_short = strlen($article_title) > 50 ? substr($article_title, 0, 50) . "..." : $article_title;
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
                        <td class="active-col">';
                    if ($article_active > 0) {
                      echo '<span class="glyphicon glyphicon-ok text-success" title="Active"></span>';
                    } else {
                      echo '<span class="glyphicon glyphicon-remove text-danger" title="Inactive"></span>';
                    }

                    echo '
                        </td>
                        <td class="date-col">
                          <small>' . $article_date . '</small>
                        </td>
                        <td class="actions-col">
                          <div class="btn-group btn-group-sm" role="group">
                            <a class="btn btn-primary btn-sm" 
                               href="./edit-article.php?id=' . $article_id . '"
                               title="Edit Article">
                              <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <button class="btn btn-danger btn-sm" 
                                    onclick="deleteConfirm(' . $article_id . ')"
                                    title="Delete Article">
                              <span class="glyphicon glyphicon-trash"></span>
                            </button>
                          </div>
                        </td>
                      </tr>
                    ';
                  }
                } else {
                  echo '
                    <tr>
                      <td colspan="7" class="text-center" style="padding: 30px; color: var(--active-color);">
                        <div>
                          <i class="glyphicon glyphicon-edit" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                          <h4>No Articles Yet!</h4>
                          <p>Start writing your first article, ' . htmlspecialchars($_SESSION['AUTHOR_NAME']) . '!</p>
                          <a href="./add-article.php" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> Write New Article
                          </a>
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
            $paginationQuery = "SELECT * FROM article WHERE author_id = $author_id ";
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