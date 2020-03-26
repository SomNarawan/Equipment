
$( document ).ready(function() {
    console.log("test");

    $('#addBorrowingType').click(function(){
        console.log("hh");
        window.location.href = './index.php?controller=Member&action=menu_borrow';

    });
    // $('#detailE').click(function(){
    //     console.log("ee6523");
    //     $("#editBorrowingModal").modal();
    // });
});