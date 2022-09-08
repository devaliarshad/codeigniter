<?php
function cake_view() {
    $id = $_GET["id"];
    $cake = get_cake($id);
    $purchased = check_puchase($id);
    if (isset($_POST['purchase'])) {
        $nvp['user_id'] = get_current_user_id();
        $nvp['cake_id'] = $id;
        $message = purchase($nvp);
    }
    do_action('wp_enqueue_scripts');
    ?>
    <div class="wrap">
            <?php if ($_POST['purchase']) { ?>
                <div class="updated"><p>Cake Purchased</p></div>
                <a href="<?php echo admin_url('admin.php?page=cakes_list') ?>">&laquo; <?php echo $message?></a>
            <?php } else { ?>
                <div class="wp-list-table widefat fixed">
                    <h1 class="heading">Cake Details</h1>
                    <br>
                    <label for="html"><b>Name</b></label><br>
                    <p class="lead"><?php echo isset($cake['name']) ? $cake['name'] : '';?></p>
                    <label for="html"><b>Recipe</b></label><br>
                    <p><?php echo isset($cake['recipe']) ? $cake['recipe'] : '';?></p>
                    <label for="html"><b>Price</b></label><br>
                    <p><?php echo isset($cake['price']) ? $cake['price']."$" : '';?></p>
                </div>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                </table>
        <?php if ($purchased == false) { ?>
            <input type='submit' name="purchase" value='Purchase' class='button' >
        <?php } else { ?>
            <p style="color: green">Purchased already</p>
        <?php } ?>
            </form>
            <?php } ?>
    </div>
    <?php
}