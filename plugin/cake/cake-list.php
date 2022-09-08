<?php
function cakes_list() {
    $rows = get_cakes();
    if (isset($_POST['search'])) {
        $nvp['search_value'] = $_POST['search_value'];
        $rows = get_search($nvp);
    }
    do_action('wp_enqueue_scripts');
    ?>

    <div class="wrap">
        <h2 class="heading">Cakes</h2>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Search: <input type="text" name="search_value"  class="ss-field-width" /></th>
                    <td> <input type='submit' name="search" value='Search' class='button'></td>
                </tr>
            </table>
        </form><br>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Name</th>
                <th class="manage-column ss-list-width">Actions</th>
            </tr>
            <?php if (isset($rows)){
            foreach ($rows as $index=>$row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo intval($index) + 1; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row['name']; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=cake_view&id=' . $row['id']); ?>">View</a></td>
                </tr>
            <?php
            }} ?>
        </table>
    </div>
    <?php
}