<?php
require('./includes/nav.inc.php');
?>

<script>
    // Add specific class for users page styling
    document.addEventListener('DOMContentLoaded', function () {
        document.body.classList.add('users-page');
    });

    // Delete user function with SweetAlert confirmation
    function deleteUser(userId, userName) {
        Swal.fire({
            title: 'Delete User?',
            html: 'Are you sure you want to delete user <strong>' + userName + '</strong>?<br/><br/>This action cannot be undone.<br/>All bookmarks associated with this user will also be deleted.',
            icon: 'warning',
            customClass: {
                popup: 'swal-delete-popup'
            },
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = './delete-user.php?user_id=' + userId;
            }
        });
    }
</script>

<!-- BREADCRUMB -->
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="./index.php">Dashboard</a></li>
            <li class="active">Users</li>
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
                            <input type="text" name="search" class="form-control" placeholder="Search by name or email"
                                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <button type="submit" class="btn btn-danger">Search</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover article-list">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
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
                                            echo '<td>';
                                            echo '<button class="btn btn-sm btn-danger" onclick="deleteUser(' . $user['user_id'] . ', \'' . htmlspecialchars($user['user_name'], ENT_QUOTES) . '\')"><i class="fa fa-trash"></i> Delete</button>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        $empty_title = ($search !== '') ? 'No users found' : 'No users yet';
                                        $empty_text = ($search !== '') ? 'No user accounts match your search.' : 'There are no registered users to display.';
                                        echo '<tr><td colspan="4" class="text-center"><div class="empty-state empty-state--table"><p class="empty-state__text">' . $empty_text . '</p></div></td></tr>';
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