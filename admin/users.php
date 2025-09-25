<?php
require('./includes/nav.inc.php');
?>

<!-- BREADCRUMB -->
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="./index.php">Dashboard</a></li>
            <li class="active">Users & Authors</li>
        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Registered Users</h4>
                    </div>
                    <div class="panel-body">
                        <form method="get" class="form-inline" style="margin-bottom: 1rem;">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search users by name or email"
                                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover article-list">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
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
                                        $user_sql = "SELECT user_id, user_name, user_email FROM user WHERE user_name LIKE '%$search_escaped%' OR user_email LIKE '%$search_escaped%' ORDER BY user_id ASC";
                                    } else {
                                        $user_sql = "SELECT user_id, user_name, user_email FROM user ORDER BY user_id ASC";
                                    }
                                    $user_result = mysqli_query($con, $user_sql);
                                    if (mysqli_num_rows($user_result) > 0) {
                                        while ($user = mysqli_fetch_assoc($user_result)) {
                                            echo '<tr>';
                                            echo '<td>' . $user['user_id'] . '</td>';
                                            echo '<td>' . htmlspecialchars($user['user_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['user_email']) . '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="3" align="center">No users found.</td></tr>';
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