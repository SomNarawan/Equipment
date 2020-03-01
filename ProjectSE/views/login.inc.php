<?php
$title = "ระบบยืม-คืนอุปกรณ์";
try {
    ob_start();

?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" name="loginForm" id="loginForm" method="post"
                                        action=<?= Router::getSourcePath() . "index.php?controller=Member&action=login" ?>>
                                        <div class="form-group">
                                            <label for="username" style="float:left;">Username</label>

                                            <input type="text" class="form-control form-control-user" id="username"
                                                name="username" required="" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" style="float:left;">Password</label>

                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" required="" placeholder="Password">
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <div style="color: red;">
                                            <?php
                                            if(isset($_GET['msg'])){
                                                echo $_GET['msg'];
                                                echo "</br></br>";
                                            }
                                            ?>
                                        </div>
                                        
                                        <button class="btn btn-primary btn-user btn-block" type="submit">Sign In</button>
                                        <button class="btn btn-danger btn-user btn-block" type="reset">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <?php

    $content = ob_get_clean();

    include Router::getSourcePath()."templates/layout_login.php";
} // -- try
catch (Throwable $e) {
    ob_clean(); // ล้าง output เดิมที่ค้างอยู่จากการสร้าง page
    echo "Access denied: No Permission to view this page";
    exit(1);
}
?>
        <?php
/*echo "<hr/>";
echo "<pre><code>";
show_source(__FILE__);
echo "</code></pre>";*/