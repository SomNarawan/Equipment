
$( document ).ready(function() {
    console.log("test");

    $('#addEquip').click(function(){
        console.log("hh");
        $("#addEquipmentOperatorModal").modal();
    });
    $('.item').click(function(){
        // alert("item");
        var id_e = $(this).attr('id_e');
        var name_e = $(this).attr('name_e');
        window.location.href = "./index.php?controller=Equipment&action=item&id_e="+id_e+"&name_e="+name_e;
    });
    $('.editEquip').click(function(){

        $("#editEquipmentOperatorModal").modal();

        var id_e = $(this).attr('id_e');
        var name_e = $(this).attr('name_e');
        var id_t = $(this).attr('id_t');
        var note = $(this).attr('note');
        // alert(name_t);
        // document.getElementById("name_e_edit").value = name_t;
        $("#id_e_edit").val(id_e);
        $("#name_e_edit").val(name_e);
        $("#id_t_edit").val(id_t); //.attr("selected","selected");
        $("#note_edit").val(note);
    });
    $('#addEqu').click(function(){
        // alert("ass");
        $('#addEqu').attr("type","submit");
    });
    $('#editEqu').click(function(){
        // alert("ass");
        
        $('#editEqu').attr("type","submit");
    });
});

function delfunction(_name_e,_id_e) {
    // alert(_did);
    swal({
            title: "คุณต้องการลบ",
            text: `${_name_e} หรือไม่ ?`,
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
                        delete_1(_name_e,_id_e)
                    }
    
                });
            } else {
    
            }
        });
    
    }
    function delete_1(_name_e,_id_e) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = './index.php?controller=Member&action=menu_equipmentO';
            // alert(this.responseText);
        }
    };
    xhttp.open("POST", "./index.php?controller=Equipment&action=delete", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id_e=${_id_e}&request=delete&name_e=${_name_e}`);
    
    }