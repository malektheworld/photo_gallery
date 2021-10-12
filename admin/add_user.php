<style>
.a{
    margin: 10px;
    padding: 10px;
}



.user-info-box {

border: 1px solid #e5e5e5;
 -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04);
 box-shadow: 0 1px 1px rgba(0,0,0,.04);
 background-color: #fff;


}

.info-box-header {
 padding: 6px;
border-bottom: 1px solid #e5e5e5;
  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04);
 box-shadow: 0 1px 1px rgba(0,0,0,.04);
background-color: #fff;

}

 


.user-info-box .box-inner {
border-top: 1px solid #e5e5e5;
background-color: #fff;
padding: 6px;

}

.user-info-box .box-inner .text {
padding: 7px 9px 19px;

}

.user-info-box .box-inner .data {

   font-weight: bold;
}

.user-info-box .info-box-footer{

border-top: 1px solid #ddd;
background-color: #ddd;
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



$user = new User() ; 

    if(isset($_POST['create'])) {

        if($user) {
     echo  $user->username =     $_POST['username']  ;
      $user->first_name =      $_POST['first_name']  ;
      $user->last_name =    $_POST['last_name']  ;
      $user->password =   $_POST['password']  ;

      $user->set_file($_FILES['user_image']) ; 
      $user->save_user_and_image() ; 








        }










/*
if($user) {
 $user->title =    $_POST['title'] ; 
 $user->caption= $_POST['caption'] ; 
 $user->alternative_text = $_POST['alternative_text'] ; 
 $user->description = $_POST['description'] ; 
  $user->save() ; 

}
*/


    }











    








//$users = user::find_all();



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
           users Page
            <small>Subheading</small>
        </h1>


        
        <form action="" method="post" enctype="multipart/form-data"> 
        



            <div class="col-md-8">

            <div class="form-group">
            <input type="file" name="user_image">

            </div>
    
    
            
            <div class="form-group">
            <label for="username"> username </label>
            <input type="text" name="username" class="form-control" >

            </div>
    
    
            
            <div class="form-group">
            <label for="first_name"> First Name  </label>
            <input type="text" name="first_name" class="form-control" >

            </div>

            <div class="form-group">
            <label for="last_name">Last Name</label>

            <input type="text" name="last_name" class="form-control" >

            </div>
            <div class="form-group">
            <label for="password">Password</label>

            <input type="password" name="password" class="form-control" >

            </div>
            <div class="form-group">

            <input type="submit" name="create" class="btn btn-primary pull-right">

            </div>


   






    
    
    </div>


    
        </form>








    </div>
</div>
<!-- /.row -->



</div>

        
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>