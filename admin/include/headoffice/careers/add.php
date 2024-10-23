<?php

echo'
<div class="card mb-5">
    <div class="modal-header bg-primary p-3">
        <h5 class="modal-title" id="exampleModalLabel"><i class="ri-add-circle-line align-bottom me-1"></i>Add '.moduleName(0).'</h5>
    </div>
    <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="card-body">
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-control" data-choices name="career_status" required>
                        <option value=""> Choose one</option>';
                        foreach(get_status() as $key => $status):
                            echo'<option value="'.$key.'">'.$status.'</option>';
                        endforeach;
                        echo'
                    </select>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="career_title" placeholder="Enter Title" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label mb-0">Detail</label>
                    <textarea name="career_des" id="ckeditor" class="form-control"></textarea>
                </div>
            </div>
            <div id="career_detail"></div>
            <button type="button" class="btn btn-primary" onclick="add_career_detail()">Add Career Detail</button>
        </div>
        <div class="card-footer">
            <div class="hstack gap-2 justify-content-end">
                <a href="'.moduleName().'.php" class="btn btn-danger btn-sm"><i class="ri-close-circle-line align-bottom me-1"></i>Close</a>
                <button type="submit" class="btn btn-primary btn-sm" name="submit_add"><i class="ri-add-circle-line align-bottom me-1"></i>Add '.moduleName(0).' </button>
            </div>
        </div>
    </form>
</div>
';
?>
