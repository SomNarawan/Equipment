$( document ).ready(function() {

    $('.addBorrow').click(function(){
        console.log("addBorrow");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // window.location.href = './index.php?controller=Member&action=menu_type';
                // alert(this.responseText);
                equipmentBorrow = this.responseText;
                obj = JSON.parse(equipmentBorrow);
                alert(obj);
                show ="";
                i=0;
                for(o in obj){
                show +=  "<tr>"+
                "<td>"+o+"</td>"+
                "<td>คอมพิวเตอร์</td>"+
                "<td>Logitec</td>"+
                "<td><input type='number' name='prod_$i' id='prod_$i' value='0' min='0' /></td>"+
                "<td><button type='button' class='btn btn-danger' style='width:150px;'>ลบ</button></td>"+
                "</tr>";
                }
                
                $('#borrow_e').html(show);
            }
        };
        xhttp.open("GET", "./index.php?controller=Borrow&action=addBorrow", true);
        xhttp.send();
    

    });

});