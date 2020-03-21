<!--Add Modal -->
<div class="modal fade" id="addEquipmentOperatorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form method="post" id="formAdd" name="formAdd" action="./index.php?controller=Equipment&action=insert">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#4e73df;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white">เพิ่มอุปกรณ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>ชื่ออุปกรณ์ <label style="color:red;">*</label><input type="text" id="name_e_add"
                            name="name_e_add" class="form-control"></input></div>
                    <div>หมวดอุปกรณ์ <label style="color:red;">*</label>
                        <select id="name_t_edit" name="name_t_edit" class="form-control">
                            <!-- <option selected value="0">เลือกหมวดอุปกรณ์</option> -->
                            <?php foreach ($typeList as $prod) { ?>
                            <option value="<?= $prod->getId_t(); ?>"><?= $prod->getName_t(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>รายละเอียด <input type="text" id="note_add" name="note_add" class="form-control"></input></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-success" id="addEqu">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editEquipmentOperatorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form method="post" id="formEdit" name="formEdit" action="./index.php?controller=Equipment&action=update">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#4e73df;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white">แก้ไขอุปกรณ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>ชื่ออุปกรณ์ <label style="color:red;">*</label><input type="text" id="name_e_edit"
                            name="name_e_edit" class="form-control"></input>
                    </div>
                    <div>หมวดอุปกรณ์ <label style="color:red;">*</label>
                        <select id="name_t_edit" name="name_t_edit" class="form-control">
                            <!-- <option selected>เลือกหมวดอุปกรณ์</option> -->
                            <?php foreach ($typeList as $prod) { ?>
                            <option selected value="<?= $prod->getName_t(); ?>"><?= $prod->getName_t(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>รายละเอียด <input type="text" id="note_edit" name="note_edit" class="form-control"></input>
                    </div>

                </div>
                <input type="hidden" id="id_e_edit" name="id_e_edit" class="form-control"></input>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="editEqu" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>