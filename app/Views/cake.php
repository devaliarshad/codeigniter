<!DOCTYPE html>
<html>
<head>
    <title>Cake Details</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
</head>
<body>
<br>
<main role="main" class="container">
    <h1 class="mt-5">Cake Details</h1>
    <br>
    <label for="html">Name</label><br>
    <p class="lead"><?php echo $name?></p>
    <label for="html">Recipe</label><br>
    <p><?php echo $recipe?></p>
    <label for="html">Price</label><br>
    <p class="price"><?php echo $price?></p>
    <button type="button" id="purchase" >Purchase</button>
    <p class="purchased" style="display: none;color: green">Purchased</p>

</main>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $("#purchase").click(function(e){
        e.preventDefault();
        var price = $('.price').text();
        if (confirm("You want to purchase this item for "+price+"$ ?") == true) {
            $(this).remove();
            $('.purchased').show();
        } else {
            return false;
        }

    });
</script>
</body>
</html>
