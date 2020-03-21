
$( document ).ready(function() {
    console.log("test");

    $('#addItem').click(function(){
        console.log("hh");
        $("#addItemModal").modal();
    });
    $('.editItem').click(function(){

        $("#editItemModal").modal();

        var id_i = $(this).attr('id_i');
        var note = $(this).attr('note');
        //var id_e = $(this).attr('id_e');
        //var status_i = $(this).attr('status_i');
        // document.getElementById("name_e_edit").value = name_t;
        $("#id_i_edit").val(id_i);
        $("#note_edit").val(note);
        //$("#id_e_edit").val(id_e);
        //$("#status_i_edit").val(status_i); //.attr("selected","selected");
        
    });
    $('#addIt_em').click(function(){
        // alert("ass");
        $('#addIt_em').attr("type","submit");
    });
    $('#editIt_em').click(function(){
        // alert("ass");
        
        $('#editIt_em').attr("type","submit");
    });
});

function delfunction(_id_i) {
    // alert(_did);
    swal({
            title: "คุณต้องการลบ",
            text: `${_id_i} หรือไม่ ?`,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            cancelButtonClass: "btn-secondary",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: false,
            closeOnCancel: function() {
                $('[data-toggle=tooltip]').tooltip({
                    boundary: 'window',
                    trigger: 'hover'
                });
                return true;
            }
        },
        function(isConfirm) {
            if (isConfirm) {
    
                swal({
    
                    title: "ลบข้อมูลสำเร็จ",
                    type: "success",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "ตกลง",
                    closeOnConfirm: false,
    
                }, function(isConfirm) {
                    if (isConfirm) {
                        delete_1(_id_i)
                    }
    
                });
            } else {
    
            }
        });
    
    }
    function delete_1(_id_i) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = './index.php?controller=Member&action=menu_equipmentO';
            // alert(this.responseText);
        }
    };
    xhttp.open("POST", "./index.php?controller=Item&action=delete", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id_i=${_id_i}&request=delete&name_i=${_name_i}`);
    
    }