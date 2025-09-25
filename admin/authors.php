<?php
require('./includes/nav.inc.php');
?>

<!-- BREADCRUMB -->
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="./index.php">Dashboard</a></li>
            <li class="active">Authors</li>
        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Author Accounts</h4>
                    </div>
                    <div class="panel-body">
                        <form method="get" class="form-inline" style="margin-bottom: 1rem;">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search authors by name or email"
                                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover article-list">
                                <thead>
                                    <tr>
                                        <th>Author ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once '../includes/database.inc.php';
                                    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
                                    if ($search !== '') {
                                        $search_escaped = mysqli_real_escape_string($con, $search);
                                        $author_sql = "SELECT author_id, author_name, author_email FROM author WHERE author_name LIKE '%$search_escaped%' OR author_email LIKE '%$search_escaped%' ORDER BY author_id ASC";
                                    } else {
                                        $author_sql = "SELECT author_id, author_name, author_email FROM author ORDER BY author_id ASC";
                                    }
                                    $author_result = mysqli_query($con, $author_sql);
                                    if (mysqli_num_rows($author_result) > 0) {
                                        while ($author = mysqli_fetch_assoc($author_result)) {
                                            echo '<tr>';
                                            echo '<td>' . $author['author_id'] . '</td>';
                                            echo '<td>' . htmlspecialchars($author['author_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($author['author_email']) . '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="3" align="center">No authors found.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require('./includes/footer.inc.php');
?>