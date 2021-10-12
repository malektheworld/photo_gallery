<style>
.a{
    margin: 10px;
    padding: 10px;
}
</style>
<?php include("includes/header.php"); ?>
<?php

if(!$session->is_signed_in()) {

redirect("login.php")    ;
}
?>
<?php


if(empty($_GET['id'])) {
    redirect("photos.php") ; 

}

$comments = Comment::find_the_comments($_GET['id']) ; 











?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
           


<?php

include ('includes/top_nav.php') ;

?>







            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
           



            <?php

include ('includes/side_nav.php') ;

?>


            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
         Users Page
        </h1>
    <div class="col-md-12">
    
    <table class="table table-striped">
    <thead>
    <tr>
                <th>ID</th>
                <th>Author </th>
                <th>Body</th>
    </tr>
    </thead>
    <tbody>
    <?php

          foreach($comments as $comment): {

          }


?>
    <tr>
    <td> <?php echo $comment->id ; ?> </td>

           
            </td>
            <td> <?php echo $comment->author ; ?> 
            <div class="actions_link">
            <a class="btn btn-danger a" href="delete_comment_photo.php?id=<?php echo $comment->id;   ?> "> Delete 
            <i class="fa fa-times"></i>
            </a>

            </a>
            
            </div>
            
            
            </td>
            <td> <?php echo $comment->body ; ?> </td>
            
    </tr>
    
    <?php      endforeach      ;          ?>
    </tbody>
    
    
    
    
    
    
    
    
    
    </table> <!--- end off table --->
    
    
    
    
    
    
    
    
    </div>













    </div>
</div>
<!-- /.row -->



</div>

        
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>