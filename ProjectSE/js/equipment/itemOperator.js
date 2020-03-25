
$( document ).ready(function() {
    console.log("test");

    $('#addItem').click(function(){
        console.log("hh");
        var id_e = $(this).attr('id_e');
        var name_e = $(this).attr('name_e');

        //alert(id_e);
        $("#id_e_add").val(id_e);
        $("#name_e_add").val(name_e);
        $("#addItemModal").modal();
    });
    $('.editItem').click(function(){
        $("#editItemModal").modal();
        var id_i = $(this).attr('id_i');
        var note = $(this).attr('note');
        var name_e = $(this).attr('name_e');

        //alert(note);
        var id_e = $(this).attr('id_e');
        //alert(id_e)
        var status_i = $(this).attr('status_i');
        // alert(status_i);
        $("#name_e_edit").val(name_e);
        $("#id_i_edit").val(id_i);
        $("#note_edit").val(note);
        $("#id_e_edit").val(id_e);
        $("#id_i_e").val(id_i);

        if(status_i == 1){
            document.getElementById("1_edit").disabled = false;
            $('input:radio[name="status_i_edit"][value="1"]').prop('checked', true);
            document.getElementById("3_edit").disabled = false;

        }else if(status_i == 2){
            document.getElementById("1_edit").disabled = true;
            $('input:radio[name="status_i_edit"][value="2"]').prop('checked', true);
            document.getElementById("3_edit").disabled = true;

        }else{
            document.getElementById("1_edit").disabled = false;
            $('input:radio[name="status_i_edit"][value="3"]').prop('checked', true);
            document.getElementById("3_edit").disabled = false;

        }
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