<!--Add Modal -->
<div class="modal fade" id="editId_iModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form method="post" id="formGet" name="formGet" action="./index.php?controller=Borrow&action=insertGet">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#4e73df;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white">แก้ไขเลขครุภัณฑ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>อุปกรณ์ <input type="text" disabled id="name_e_edit" name="name_e_edit"
                            class="form-control"></input>
                    </div>
                    <div>เลขครุภัณฑ์
                        <select id="id_i_edit" name="id_i_edit" class="form-control">
                            <!-- <option selected>เลือกหมวดอุปกรณ์</option> -->

                        </select>
                    </div>

                </div>
                <input type="hidden" id="id_b_edit" name="id_b_edit" class="form-control"></input>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="getEqu" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- getEquipmentModal -->
<div class="modal fade" id="getEquipmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form method="post" id="formGet" name="formGet" action="./index.php?controller=Borrow&action=insertGet">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#4e73df;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white">เลือกเลขครุภัณฑ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>อุปกรณ์ <input type="text" disabled id="name_e_get" name="name_e_get"
                            class="form-control"></input>
                    </div>
                    <div>เลขครุภัณฑ์
                        <select id="id_i_get" name="id_i_get" class="form-control">
                            <!-- <option selected>เลือกหมวดอุปกรณ์</option> -->

                        </select>
                    </div>

                </div>
                <input type="hidden" id="id_b_get" name="id_b_get" class="form-control"></input>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="getEqu" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- returnEquipmentModal -->
<div class="modal fade" id="returnEquipmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form method="post" id="formGet" name="formGet" action="./index.php?controller=Borrow&action=insertReturn">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#4e73df;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white">ยืนยันการคืน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>อุปกรณ์ <input type="text" disabled id="name_e_return" name="name_e_return"
                            class="form-control"></input>
                    </div>
                    <div>เลขครุภัณฑ์
                      <input type="text" disabled id="id_i_return" name="id_i_return"
                            class="form-control"></input>
                    </div>

                </div>
                <input type="hidden" id="id_b_return" name="id_b_return" class="form-control"></input>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="returnEqu" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>
