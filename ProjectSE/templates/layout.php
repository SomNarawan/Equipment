<?php
    include Router::getSourcePath()."templates/layout_head.php"; 
?>

<body id="page-top">
    <div id="wrapper">
        <?php include("header.inc.php"); //หาไม่เจอ จะหาที่โฟลเดอร์เดียวกัน ?>
        <div id="contenter-fluid">
            <?= $content ?>
        </div>
    <div id="footer">
        <?php include("footer.inc.php"); ?>
    </div>
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    
</body>

</html>