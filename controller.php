<?php
include("SteamID.php");
$APIKEY = "0EBBACAEBC6039B06DF1066807D55D4C";
$WHO = $_GET["id"];
try
{
	// Constructor also accepts Steam3 and Steam2 representations
	$s = new SteamID( $WHO );
}
catch( InvalidArgumentException $e )
{
	header("Location: steamerror.php");;
}
// Renders SteamID in it's Steam3 representation (e.g. [U:1:24715681])
$id3 = $s->RenderSteam3() . PHP_EOL;

// Renders SteamID in it's Steam2 representation (e.g. STEAM_0:1:12357840)
$idn = $s->RenderSteam2() . PHP_EOL;

// Converts this SteamID into it's 64bit integer form (e.g. 76561197984981409)
$id64 = $s->ConvertToUInt64() . PHP_EOL;

$json = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$APIKEY."&steamids=$id64");
$apidata = json_decode($json);
$name = $apidata->response->players[0]->personaname;
$img = $apidata->response->players[0]->avatarfull;
if (isset($apidata->response->players[0]->realname) == false ){
    $realname = "N/A";
} else{
    $realname = $apidata->response->players[0]->realname;
}

if (isset($apidata->response->players[0]->loccountrycode) == false ){
    $country = "N/A";
} else{
    $country = $apidata->response->players[0]->loccountrycode;
}
$url = $apidata->response->players[0]->profileurl;
if ($name == null || $img == null ){
    header("Location: steamerror.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        <?php 
            include("meta.php"); 
            ?>
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="description"  content="Name: <?php echo $name; ?>,SteamID64: <?php echo $id64; ?>, SteamID: <?php echo $idn; ?>, SteamID3: <?php echo $id3; ?>, URL: <?php echo $url; ?>" />
        <meta name="keywords" content="<?php echo $name; ?>, <?php echo $id64; ?>, <?php echo $idn; ?>, <?php echo $id3; ?>" />
        <meta property="og:site_name" content="DriedSponge.net | SteamID Finder" /> <!-- Replace with your name or whatever you want-->
        <meta property="og:title" content="Info on <?php echo $name; ?>" />
        <meta property="og:image" content="<?php echo $img;?>" />
        <meta property="og:image:type" content="image/png" />
        <meta name="author" content="Jordan Tucker">
        
        <meta property="og:site_name" content="<?php echo $name; ?> - driedsponge.net" />
        
            
        <title><?php echo $name; ?> - driedsponge.net</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <style>
            .url{
                 color: white; 
                 text-decoration: underline;
            }
            .url:hover{
                 color: rgb(228, 228, 228); 
                 text-decoration: underline;
            }
            
        </style>
    </head>
    
 <body>

     <div class="app">
    <div class="container-fluid-lg">
        <div class="page-header">
        
            <nav class="navbar navbar-expand-lg navbar-dark  nbth fixed-top" >
                    <a class="navbar-brand" href="#"><strong>driedsponge.net</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                    <div class="collapse navbar-collapse" id="navbarmain">
                            
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="webdesign.php">Web Projects</a></li>
                            <li class="nav-item"><a class="nav-link" href="lua.php">Lua Projects</a></li>
                            <li class="nav-item"><a class="nav-link" href="tutorials/index.php">Coding Tutorials</a></li>
                            <li class="nav-item active"><a class="nav-link" href="steam.php">Steam Tool<span class="sr-only">(current)</span></a></li>
                        </ul>  
                        </div>
                  </nav>
                
                  
        </div>
        
    </div>
    <div class="container-fluid-lg" style="padding-top: 80px;">
        

        
            <div class="container">
               
                    <hgroup>
                        <h2><strong>Steam ID Tool</strong></h2>
                        <br>
                        
                      <div class="form-group">
                        
                        <input id="id64" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter a SteamID/SteamID64/SteamID3">
                      </div>
                      <button onclick="go()" type="submit" class="btn btn-primary">Submit</button>
                    
                    <br>
                    </hgroup>
                    <div class="jumbotron" style="text-align: center;">
                    <h2><img src="<?php echo $img; ?>"</h2>
                    <h1>Results for: <?php echo $name; ?></h1>
                    <p class="paragraph"><strong>SteamID64:</strong> <?php echo $id64; ?> <button  value="<?php echo $id64; ?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="paragraph"><strong>SteamID:</strong> <?php echo $idn; ?> <button  value="<?php echo $idn; ?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="paragraph"><strong>SteamID3:</strong> <?php echo $id3; ?> <button value="<?php echo $id3; ?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="paragraph"><strong>Profile URL:</strong> <a class="url" target="_blank" href="<?php echo $url; ?>"><?php echo $url; ?></a> <button value="<?php echo $url; ?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <h4 class="subheading" style="color: white;">Personal Info (This may not be accurate)</h4><br>
                    <p class="paragraph"><strong>Real Name:</strong> <?php echo $realname; ?> <button value="<?php echo $realname; ?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="paragraph"><strong>Country</strong>: <?php echo $country; ?> <button value="<?php echo $country; ?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button> </p>
                    
                    </div>
                    
                       
            



                    

                        </div>
</div>
</div> 
<!-- End of "app" -->
<?php 
    include("footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>




                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script src="main.js"></script>
        
        <script>
          function  copything(value){
            

            navigator.clipboard.writeText(value)
            alert("Copied " + value + " to clipboard");

          }


        </script>
        <script src="search.js"></script>
 </body>






</html>