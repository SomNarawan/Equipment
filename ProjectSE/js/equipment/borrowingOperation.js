
$( document ).ready(function() {
    console.log("test");

    $('#addBorrowOpeType').click(function(){
        console.log("hh");
        window.location.href = './index.php?controller=Member&action=menu_borrow';
    });
});