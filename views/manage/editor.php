<!DOCTYPE html>


<html>

<head>
    <!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

    <meta name="description" content="Admins only guys">
    <meta name="keywords" content="driedsponge.net editor">
    <meta name="author" content="Jordan Tucker">
    <meta property="og:site_name" content="DriedSponge.net | Editor" />

    <?php
    include("views/includes/meta.php");
    ?>

    <title>Editor</title>
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css">
    
</head>

<body>


    <style>
        .dropdown-head-link {
            color: black;
            text-decoration: none;

        }

        .dropdown-head-link:hover {
            color: black;
            text-decoration: underline;

        }
    </style>

    <div class="app">
        <div class="container-fluid-lg" style="padding-top: 30px;">

            <div class="container-fluid">

                <?php
                $ivalidid = false;
                if (isset($_SESSION['steamid'])) {
                    include('steamauth/userInfo.php');
                    if (isMasterAdmin($_SESSION['steamid'])) {
                        
                        $currentq = SQLWrapper()->prepare("SELECT content,title,privacy,slug,description FROM content WHERE thing = :thing");
                        $currentq->execute([':thing' => $pageid]);
                        $current = $currentq->fetch();
                        $editname = $current['title'];
                        $currentdes = $current['description'];
                        $cp = $current['privacy'];
                        $cs = $current['slug'];
                        if (!empty($current)) {



                ?>
                            <hgroup>
                                <h1 class="display-4"><strong>DriedSponge.net Editor</strong></h1>
                            </hgroup>
                            <br>
                            <script>
                                $(document).ready(function() {
                                    $("#editor-form").submit(function(event) {
                                        $("#editor-form").hide()
                                        Loading(true, "#editor-form-feedback")
                                        event.preventDefault();
                                        var pagename = $("#title").val();
                                        var privacy = $("#privacy").val();
                                        console.log(privacy);
                                        var description = $("#des").val();
                                        var title = $("#title").val();
                                        var slug = $("#slug").val();
                                        var content = $("#content").val()
                

                                        $("#error-message").addClass("d-none");
                                        $("#success-message").addClass("d-none");
                                        $.post("/manage/ajax/edit-page.php", {
                                                savepage: 1,
                                                id: "<?=htmlspecialchars($pageid);?>",
                                                pagename: pagename,
                                                title: title,
                                                privacy: privacy,
                                                description: description,
                                                slug: slug,
                                                content: content
                                            })
                                            .done(function(data) {
                                                Loading(false, "#editor-form-feedback")
                                                if (data.success) {
                                                    $("#editor-form").show()
                                                    $("#success-message").removeClass("d-none");
                                                    $("#success_message_text").html(data.message)
                                                    Validate("#title")
                                                    Validate("#privacy")
                                                    Validate("#des")
                                                    Validate("#slug")
                                                    Validate("#content")
                                                    setInterval(function(){
                                                        $("#success-message").addClass("d-none");
                                                    }, 10000)
                                                } else {
                                                    $("#editor-form").show()
                                                    if (data.SysError) {
                                                        $("#error-message").removeClass("d-none");
                                                        $("#error_message_text").html(data.message)
                                                    }else{
                                                        $("#error-message").removeClass("d-none");
                                                        $("#error_message_text").html("Please check the data you entered. <b>Changes not saved</b>")
                                                    }
                                                     if(data.basics){
                                                        if(data.errorNAMETXT != null){
                                                            InValidate("#title",data.errorNAMETXT)
                                                        }else{
                                                            Validate("#title")
                                                        }
                                                        if(data.errorPRIVACYTXT != null){
                                                            InValidate("#privacy",data.errorPRIVACYTXT)
                                                        }else{
                                                            Validate("#privacy")
                                                        }
                                                        if(data.errorDESTXT != null){
                                                            InValidate("#des",data.errorDESTXT)
                                                        }else{
                                                            Validate("#des")
                                                        }
                                                        if(data.errorSLGTXT != null){
                                                            InValidate("#slug",data.errorSLGTXT)
                                                        }else{
                                                            Validate("#slug")
                                                        }
                                                        if(data.errorCONTXT != null){
                                                            InValidate("#content",data.errorCONTXT)
                                                        }else{
                                                            Validate("#content")
                                                        }
                                                    }

                                                }
                                            });
                                    });
                                });
                            </script>
                            <div id="editor-form-feedback"></div>
                            <div id="error-message" class="d-none">
                                <div class="alert alert-danger text-center" role="alert">
                                    <span><b>Error:</b> <span id="error_message_text"><i>insert success message here</i></span></span>
                                </div>
                            </div>
                            <div id="success-message" class="d-none">
                                <div class="alert alert-success text-center" role="alert">
                                    <span><b>Success:</b> <span id="success_message_text"><i>insert success message here</i></span></span>
                                </div>
                            </div>
                            
                            <form id="editor-form" method="post">
                                <div class="form-group">
                                    <button id="save-changes"  type="submit" class="btn btn-primary">Save</button>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">Page Title</label>
                                        <input class="form-control" feedback="#title-feedback" placeholder="Enter Title" value="<?= htmlspecialchars($editname); ?>" name="title" id="title" maxlength="50"></input>
                                        <div id="title-feedback"></div>
                                    </div>
                                    <div class="col">
                                        <label for="privacy">Privacy</label>
                                        <select class="form-control" id="privacy" feedback="#privacy-feedback" name="privacy">
                                            <option value="1">Public</option>
                                            <option value="2">Must be logged in</option>
                                            <option value="3">Must be verified in discord</option>
                                            <option value="4">Must be admin</option>
                                            <option value="5">Must be owner</option>
                                        </select>
                                        <div id="privacy-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="des">Page Description</label>
                                        <input maxlength="160" feedback="#des-feedback" class="form-control" placeholder="Enter Meta Description" value="<?= htmlspecialchars($currentdes); ?>" name="des" id="des"></input>
                                        <div id="des-feedback"></div>
                                    </div>
                                    <div class="col">
                                        <label for="slug">Slug</label>
                                        <input id="slug" name="slug" feedback="#slug-feedback" class="form-control" placeholder="https://driedsponge.net/{slug}" value="<?= htmlspecialchars($cs); ?>" type="text" maxlength="20">
                                            <div id="slug-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" style="color: black;">Edit the contents</label>
                                    <br>
                                    <textarea id="content" name="content" feedback="#content-feedback" rows="40" class="form-control"><?= htmlspecialchars_decode($current["content"]); ?></textarea>
                                    <div id="content-feedback"></div>
                                </div>
                            </form>

                        <?php
                        } else {
                        ?>
                            <h1 class="display-2" style="color:red;"><strong>Can't edit that page because it does not exist!</strong></h1>

                        <?php
                        }
                    } else {
                        ?>
                        <hgroup>
                            <h1 class="display-2"><strong>You are not management, get out!</strong></h1>
                            <?php
                            header("Location: /home/");
                            ?>

                            <br>
                        </hgroup>

                    <?php
                    }
                } else {
                    ?>
                    <h1 class="articleh1">Please login to manage.</h1>
                    <br>
                    <p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
                <?php
                }
                ?>
            </div>
        </div>

    </div>
    <!-- end of app -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/dom10ctinmaceofbm524vgsfebgy22lsh2ooomg0oqs8wu28/tinymce/5/tinymce.min.js"></script>
    <script>
        $(function() {
            $("#privacysettings").val('<?php echo $cp; ?>');
        });
    </script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: "link,anchor,autoresize,autosave,image,wordcount,searchreplace,fullscreen,code,lists,visualblocks",
            menubar: "file edit insert view format table tools help ",
            content_css: ['https://fonts.googleapis.com/css?family=Bangers','https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',"<?=v(url());?>css/argon.min.css",'<?=v(url());?>css/formatting.css'],
            
            font_formats: 'Arial Black=arial black,avant garde;Indie Flower=Bangers, cursive;Times New Roman=times new roman,times;',
            toolbar: "undo redo | styleselect | bold italic underline strikethrough format code | align left center right justify | link image anchor numlist bullist | wordcount ",
            default_link_target: "_blank",
            style_formats: [
                { title: 'Headers', items: [
                { title: 'Content Box Heading', block: 'h1', classes: 'heading' },
                { title: 'Content Box Subheading', block: 'h2', classes: 'subheading' }
                ]},
                { title: 'Text', items: [
                { title: 'Paragraph', block: 'p', classes: 'paragraph' }
                ]},
                { title: 'Containers', items: [
                { title: 'Fluid Container', block: 'div', wrapper: true, classes: 'container-fluid',merge_siblings: false },
                { title: 'Content Box', block: 'div', wrapper: true, classes: 'content-box', exact: true,merge_siblings: false}
                ] },
                { title: 'Badges', items: [
                    { title: 'Normal Badges', items: [
                    { title: 'Primary', inline: 'span', classes: 'badge badge-primary' },
                    { title: 'Secondary', block: 'div', wrapper: true, classes: 'content-box' }
                    ] },
                    { title: 'Pill Badges', items: [
                    { title: 'Normal Badges', block: 'div', wrapper: true, classes: 'container-fluid', },
                    { title: 'B', block: 'div', wrapper: true, classes: 'content-box', exact: true}
                    ] }
                ] },
                { title: 'Layouts', items: [
                    { title: 'Row', block: 'div', wrapper: true, classes: 'row display-flex', exact: true, merge_siblings: false },
                    { title: 'Col', block: 'div', wrapper: true, classes: 'col indexcol',  exact: true, merge_siblings: false}
                ] },
                { title: 'Components', items: [
                    { title: 'Cards', items: [
                    { title: 'Card', block: 'div', wrapper: true, classes: 'card card-border', exact: true  },
                    { title: 'Card Body', block: 'div', wrapper: true, classes: 'card-body', exact: true}
                    ] }
                ] },
                
            ],
            end_container_on_empty_block: true,
            preview_styles: false
        });
    </script>

</body>

</html>