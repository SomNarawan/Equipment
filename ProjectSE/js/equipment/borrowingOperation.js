
$( document ).ready(function() {
    console.log("test");
    $('.returnEquipment').click(function(){
        var id_e = $(this).attr('id_e');
        var name_e = $(this).attr('name_e');
        var id_b = $(this).attr('id_b');
        var id_i = $(this).attr('id_i');

        $("#name_e_return").val(name_e);
        $("#id_i_return").val(id_i);
        $("#id_b_return").val(id_b);
        $("#returnEquipmentModal").modal();

    });
    $('#returnEqu').click(function(){
        $('#returnEqu').attr("type","submit");

    });
    $('.editId_i').click(function(){

        var id_e = $(this).attr('id_e');
        var id_i = $(this).attr('id_i');

        var name_e = $(this).attr('name_e');
        alert(name);
        var id_b = $(this).attr('id_b');

        $("#name_e_edit").val(name_e);
        $("#id_b_edit").val(id_b);


        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // window.location.href = './index.php?controller=Member&action=menu_type';
                // alert(this.responseText);
                itemList = this.responseText;
                console.log(itemList);
                obj = JSON.parse(itemList);
                
                console.log(obj);
                show ="";
                for(o in obj){
                    show += "<option value='"+obj[o]+"'>"+obj[o]+"</option>";
                }
                $('#id_i_get').html(show);

                $('#id_i_get').val(id_i);


            }
        };
        xhttp.open("POST", "./index.php?controller=Item&action=pull", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send(`id_e=${id_e}`);
    
       
        $("#getEquipmentModal").modal();

    });


    $('.getEquipment').click(function(){
        console.log("hh");

        var id_e = $(this).attr('id_e');
        var name_e = $(this).attr('name_e');
        var id_b = $(this).attr('id_b');

        $("#name_e_get").val(name_e);
        $("#id_b_get").val(id_b);


        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // window.location.href = './index.php?controller=Member&action=menu_type';
                // alert(this.responseText);
                itemList = this.responseText;
                console.log(itemList);
                obj = JSON.parse(itemList);
                
                console.log(obj);
                show ="";
                for(o in obj){
                    show += "<option value='"+obj[o]+"'>"+obj[o]+"</option>";
                }

                $('#id_i_get').html(show)

            }
        };
        xhttp.open("POST", "./index.php?controller=Item&action=pull", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send(`id_e=${id_e}`);
    
       
        $("#getEquipmentModal").modal();

    });

    $('#getEqu').click(function(){
        $('#getEqu').attr("type","submit");

    });
    
    
});