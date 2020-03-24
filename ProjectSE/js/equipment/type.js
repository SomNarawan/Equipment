
$( document ).ready(function() {
    console.log("test");
    $('.tt').tooltip();

    $('#addType').click(function(){
        console.log("hh");
        $("#addModal").modal();
    });
    $('.editType').click(function(){
        // alert('edit');
        $("#editModal").modal();

        var id_t = $(this).attr('id_t');
        var name_t = $(this).attr('name_t');
        var note = $(this).attr('note');
        
        $("#id_t_edit").val(id_t);
        $("#name_t_edit").val(name_t);
        $("#note_edit").val(note);
    });
    $('#add').click(function(){
        // alert("ass");
        $('#add').attr("type","submit");
    });
    $('#edit').click(function(){
        // alert("ass");
        
        $('#edit').attr("type","submit");
    });
});

function delfunction(_name_t,_id_t) {
    // alert(_did);
    swal({
            title: "คุณต้องการลบ",
            text: `${_name_t} หรือไม่ ?`,
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
                        delete_1(_name_t,_id_t)
                    }
    
                });
            } else {
    
            }
        });
    
    }
    function delete_1(_name_t,_id_t) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = './index.php?controller=Member&action=menu_type';
            // alert(this.responseText);
        }
    };
    xhttp.open("POST", "./index.php?controller=Type&action=delete", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id_t=${_id_t}&request=delete&name_t=${_name_t}`);
    
    }