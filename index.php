<?php $debug = 0 ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Wordpress Plugin Boilerplate Generator">
    <meta name="robots" content="index, follow">
    <title>Wordpress Plugin Boilerplate Generator</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" id="font-awesome-css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link href="style.css" rel="stylesheet" id="style-css">
    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175506445-1"></script>
    <script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-175506445-1');
    </script>


</head>
<body>
<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
            <h3>Wordpress</h3>
            <h3>Plugin</h3>
            <h3>Boilerplate</h3>
            <h3>Generator</h3>
            <p>Powered by <a href="http://wppb.io/">WPPB</a> codebase.</p>
        </div>
        <div class="col-md-9 register-right">

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h4 class="register-heading">Type your plugin details in the form below and a zip file will be generated</h4>
                    <form action="build.php" method="post">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="plugin_name" placeholder="Plugin name" value="<?= $debug == true ? 'Test Plugin Name' : '' ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="plugin_slug" placeholder="Plugin slug" value="<?= $debug == true ? 'test-plugin-slug' : '' ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="plugin_uri" placeholder="Plugin URI" value="<?= $debug == true ? 'https://test-plugin-uri.com' : '' ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="author_name" placeholder="Author name" value="<?= $debug == true ? 'Author Name' : '' ?>">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="author_email" placeholder="Author email" value="<?= $debug == true ? 'author@email.com' : '' ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="author_uri" placeholder="Author URI" value="<?= $debug == true ? 'https://author-uri.com' : '' ?>">
                                </div>

                                <input type="submit" class="btnBuild" value="Build plugin"/>
                            </div>
                        </div>
                    </form>
                    <div class="text-left" style="margin: -50px 0 20px 100px;">
                        <i class="fa fa-check" aria-hidden="true"></i> Include ACF support <br>
                        <i class="fa fa-check" aria-hidden="true"></i> Add Common class <br>
                        <i class="fa fa-check" aria-hidden="true"></i> Comments are cleared <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center" style="font-size: 0.8em">
            © <?= date( 'Y' ) ?> <a href="https://github.com/andrewchuev">Chuev Research Lab</a>
        </div>
    </div>
</div>

</body>
</html>



