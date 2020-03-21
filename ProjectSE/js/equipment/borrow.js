$( document ).ready(function() {

    $('.addBorrow').click(function(){
        console.log("addBorrow");

        var id_e = $(this).attr('id_e');
        var name_e = $(this).attr('name_e');
        var name_t = $(this).attr('name_t');
        var note = $(this).attr('note');
        var num = $('#'+id_e).val();

        console.log(num);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // window.location.href = './index.php?controller=Member&action=menu_type';
                // alert(this.responseText);
                equipmentBorrow = this.responseText;
                console.log(equipmentBorrow);
                obj = JSON.parse(equipmentBorrow);
                
                console.log(obj);
                show ="";
                i=0;
                for(o in obj){
                    show +=  "<tr>"+
                    "<td>"+obj[o].name_e+"</td>"+
                    "<td>"+obj[o].name_t+"</td>"+
                    "<td>"+obj[o].note+"</td>"+
                    "<td><input type='number' name='prod_$i' id='prod_$i' value='"+obj[o].num+"' min='0' /></td>"+
                    "<td><button type='button' class='btn btn-danger delBorrow' value='"+obj[o].id_t+"' id_e='"+obj[o].id_e+"' style='width:150px;'>ลบ</button></td>"+
                    "</tr>";
                }
                
                $('#borrow_e').html(show);
               
                $('.delBorrow').click(function(){
                    console.log("delBorrow");
            
                    var id_e = $(this).attr('id_e');
            
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            // window.location.href = './index.php?controller=Member&action=menu_type';
                            // alert(this.responseText);
                            equipmentBorrow = this.responseText;
                            console.log(equipmentBorrow);
                            obj = JSON.parse(equipmentBorrow);
                            console.log(obj);
                            show ="";
                            i=0;
                            for(o in obj){
                                show +=  "<tr>"+
                                "<td>"+obj[o].name_e+"</td>"+
                                "<td>"+obj[o].name_t+"</td>"+
                                "<td>"+obj[o].note+"</td>"+
                                "<td><input type='number' name='prod_$i' id='prod_$i' value='"+obj[o].num+"' min='0' /></td>"+
                                "<td><button type='button' class='btn btn-danger delBorrow' value='"+obj[o].id_t+"' style='width:150px;'>ลบ</button></td>"+
                                "</tr>";
                            }
                            
                            $('#borrow_e').html(show);
                        }
                    };
                    xhttp.open("POST", "./index.php?controller=Borrow&action=addBorrow", true);
                    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xhttp.send(`action=del&id_e=${id_e}`);
                
            
                });


            }
        };
        xhttp.open("POST", "./index.php?controller=Borrow&action=addBorrow", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send(`action=add&id_e=${id_e}&name_e=${name_e}&name_t=${name_t}&note=${note}&num=${num}`);
    

    });
    

});