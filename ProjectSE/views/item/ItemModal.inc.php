<!--Add Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form method="post" id="formAdd" name="formAdd" action="./index.php?controller=Item&action=insert">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#4e73df;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white">เพิ่มอุปกรณ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>เลขครุภัณฑ์ <label style="color:red;">*</label><input type="text" id="id_i_add"
                            name="id_i_add" class="form-control"></input></div>
                    <div>รายละเอียด <input type="text" id="note_add" name="note_add" class="form-control"></input></div>
                    <br>
                    <div>สถานะ <label style="color:red;">*</label>
                        <input type="radio" id="1_add" name="status_i_add" value="1">
                        <label for="1">ยืมได้</label>
                        <input type="radio" id="3_add" name="status_i_add" value="3">
                        <label for="3">ยืมไม่ได้</label>
                    </div>

                </div>
                <input type="hidden" id="id_e_add" name="id_e_add" class="form-control"></input>
                <input type="hidden" id="name_e_add" name="name_e_add" class="form-control"></input>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-success" id="addI">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form method="post" id="formEdit" name="formEdit" action="./index.php?controller=Item&action=update">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#4e73df;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white">แก้ไขอุปกรณ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>เลขครุภัณฑ์ <label style="color:red;">*</label><input disabled type="text" id="id_i_edit"
                            name="id_i_edit" class="form-control"></input>
                    </div>
                    <div>รายละเอียด <input type="text" id="note_edit" name="note_edit" class="form-control"></input>
                    </div>
                    <br>
                    <div>สถานะ <label style="color:red;">*</label>
                        <input type="radio" id="1_edit" name="status_i_edit" value="1">
                        <label for="1">ยืมได้</label>
                        <input type="radio" disabled id="2_edit" name="status_i_edit" value="2">
                        <label for="2">ถูกยืม</label>
                        <input type="radio" id="3_edit" name="status_i_edit" value="3">
                        <label for="3">ยืมไม่ได้</label>
                    </div>

                </div>
                <input type="hidden" id="id_i_e" name="id_i_e" class="form-control"></input>
                <input type="hidden" id="id_e_edit" name="id_e_edit" class="form-control"></input>
                <input type="hidden" id="name_e_edit" name="name_e_edit" class="form-control"></input>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="editI" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>