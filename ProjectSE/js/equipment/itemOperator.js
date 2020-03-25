
$( document ).ready(function() {
    console.log("test");

    $('#addItem').click(function(){
        console.log("hh");
        var id_e = $(this).attr('id_e');
        //alert(id_e);
        $("#id_e_add").val(id_e);
        $("#addItemModal").modal();
    });
    $('.editItem').click(function(){
        $("#editItemModal").modal();
        var id_i = $(this).attr('id_i');
        var note = $(this).attr('note');
        //alert(note);
        var id_e = $(this).attr('id_e');
        //alert(id_e)
        var status_i = $(this).attr('status_i');
        // document.getElementById("name_e_edit").value = name_t;
        $("#id_i_edit").val(id_i);
        $("#note_edit").val(note);
        $("#id_e_edit").val(id_e);
        $("#status_i_edit").val(status_i); //.attr("selected","selected");   
    });
    $('#addI').click(function(){
        // alert("ass");

        $('#addI').attr("type","submit");
    });
    $('#editI').click(function(){
        // alert("ass");
        
        $('#editI').attr("type","submit");
    });
});

function delfunction(_id_e,_id_i,_name_e) {
    //alert(_name_e);
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
                        delete_1(_id_e,_id_i,_name_e)
                    }
    
                });
            } else {
    
            }
        });
    
    }
    function delete_1(_id_e,_id_i,_name_e) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // alert(this.responseText);

                window.location.href = './index.php?controller=Equipment&action=item&id_e='+_id_e+'&name_e='+_name_e;
            }
        };
        xhttp.open("POST", "./index.php?controller=Item&action=delete", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`id_i=${_id_i}&request=delete&id_e=${_id_e}&name_e=${_name_e}`);
        
        }