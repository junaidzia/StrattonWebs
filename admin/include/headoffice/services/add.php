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
                    <select class="form-control" data-choices name="service_status" required>
                        <option value=""> Choose one</option>';
                        foreach(get_status() as $key => $status):
                            echo'<option value="'.$key.'">'.$status.'</option>';
                        endforeach;
                        echo'
                    </select>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="service_title" placeholder="Enter Title" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Title Support <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="service_title_support" placeholder="Enter Title Support" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label">Sub Services Title <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="service_subtitle" placeholder="Enter Sub Services Title" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Contact Page Btn Title <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="service_btn_title" placeholder="Enter Btn Title" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Icon<span class="text-danger"> ( 45 by 45 ) px</span></label>
                    <input class="form-control" type="file" name="service_icon" accept=".jpg,.jpeg,.png" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label">Background Image<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                    <input class="form-control" type="file" name="service_bg" accept=".jpg,.jpeg,.png">
                </div>
                <div class="col mb-2">
                    <label class="form-label">Image<span class="text-danger"> ( 600 by 400 ) px</span></label>
                    <input class="form-control" type="file" name="service_img" accept=".jpg,.jpeg,.png" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Banner<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                    <input class="form-control" type="file" name="service_banner" accept=".jpg,.jpeg,.png" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label mb-0">Background Image Text</label>
                    <textarea name="service_bgdes" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label mb-0">Details</label>
                    <textarea name="service_des" id="ckeditor" class="form-control"></textarea>
                </div>
            </div>
            <div id="services_detail"></div>
            <button type="button" class="btn btn-primary" onclick="add_services_detail()">Add Services Detail</button>

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
