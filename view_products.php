<!-- connecting to database -->
<?php include 'connect.php';?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>

     <!-- css file -->
        <link rel="stylesheet" href="css/shopstyle.css">

        <!-- font awesome link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <!-- header -->
    <?php include 'header.php'?>
    <!-- contaier -->
    <div class="container">
        <section class="display_product">

                        <!-- php code -->
                        <?php
$display_product=mysqli_query($conn,"Select * from `products`");
$num=1;
if(mysqli_num_rows($display_product)>0){
   echo" <table>
        <thead>
            <th>Sl No</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Action</th>
        </thead> 
        <tbody>";

        while($row=mysqli_fetch_assoc($display_product)){

            ?>

<!-- display table -->
<tr>
                        <td><?php echo $num?></td>
                        <td><img src="images/<?php echo $row['image']?> "alt=<?php
                        echo $row['name']?>></td>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['price']?></td>
                        <td>
                            <a href="delete.php?delete=<?php echo $row['id']?>"
                            class="delete_product_btn" onclick="return confirm('Are you sure you want to delete this product');">
                            <i class="fas fa-trash"></i></a>
                            <a href="update.php?edit=<?php echo $row['id']?>" 
                            class="update_product_btn">
                            <i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
    

<?php
$num++;
        }
}else{
    echo "<div class='empty_text'>No Products available</div>";
}

                        ?>

                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
