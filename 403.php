<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="DriedSponge.net | 403">
        <meta name="keywords" content="Portfolio">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | 403" />
       
        <?php 
            include("meta.php"); 
            ?>
        
        <title>Access Denied</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <style>
        hgroup h1{
            text-align: center;
            font-size: 60px; 
            color: white;
        }
        .ep{
            text-align: center;
            font-size: 30px; 
            color: white;
            
        }
        .btntext{
            font-size: 30px; 
        }
    </style>
    </head>
 <body>
 <?php
include("navbar.php")
?>
    

    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">
      
   
        
            <div class="container">
                <div class="jumbotron">
                <hgroup >
                        <h1><i class="fas fa-user-shield"></i></h1>
                    <h1><strong>Error: 403</strong></h1>

                    <br>
                </hgroup>

                <p class="ep">Uh oh! Your access to this page/directory has been restricted/denied. Please contact an administrator if you believe this was a mistake!</p>
                <br>
                <p style="text-align: center;"><button class="btn btn-success" onclick="goback()"><strong class="btntext">Go Back</strong></button></p>
                 </div>

            </div>
        </div>
    </div>
            <!-- end of app -->
            <?php 
            include("footer.php"); // we include footer.php here. you can use .html extension, too.
            ?>
                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/popper.js@1"></script>
                <script src="https://unpkg.com/tippy.js@4"></script>
                <script src="main.js"></script>
                <script>
                      function goback() {
                        window.history.back();
                            }

                 </script>   
                 <script>
                    navitem = document.getElementById('homelink').classList.add('active')
                </script>
     
 </body>






</html>