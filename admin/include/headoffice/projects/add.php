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
                    <select class="form-control" data-choices name="project_status" required>
                        <option value=""> Choose one</option>';
                        foreach(get_status() as $key => $status):
                            echo'<option value="'.$key.'">'.$status.'</option>';
                        endforeach;
                        echo'
                    </select>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="project_title" placeholder="Enter Title" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Title Support <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="project_title_support" placeholder="Enter Title Support" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label">Image<span class="text-danger"> ( 600 by 400 ) px</span></label>
                    <input class="form-control" type="file" name="project_img" accept=".jpg,.jpeg,.png" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Banner<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                    <input class="form-control" type="file" name="project_banner" accept=".jpg,.jpeg,.png" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Description Image<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                    <input class="form-control" type="file" name="project_desimg" accept=".jpg,.jpeg,.png" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label">Contact Page Btn Title <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="project_btn_title" placeholder="Enter Btn Title" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Project Website <span class="text-danger"> *</span></label>
                    <input class="form-control" type="text" name="project_web" placeholder="Enter Project Website Link" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label">Platforms <span class="text-danger"> *</span></label>
                    <input type="text" name="id_platform" data-choices data-choices-removeItem  required>';
                    // echo '
                    // <select class="form-control" data-choices name="id_platform" required>
                    //     <option value=""> Choose one</option>';
                    //     foreach($platforms as $value):
                    //         echo'<option value="'.$value['platform_id'].'">'.html_entity_decode($value['platform_title']).'</option>';
                    //     endforeach;
                    //     echo'
                    // </select>';
                    echo '
                </div>
                <div class="col mb-2">
                    <label class="form-label">Services <span class="text-danger"> *</span></label>
                    <input type="text" name="id_services" data-choices data-choices-removeItem  required>';
                    // echo '
                    // <select class="form-control" multiple data-choices name="id_services[]" required>
                    //     <option value=""> Choose one</option>';
                    //     foreach($services as $value):
                    //         echo'<option value="'.$value['service_id'].'">'.html_entity_decode($value['service_title']).'</option>';
                    //     endforeach;
                    //     echo'
                    // </select>';
                    echo '
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label mb-0">Detail</label>
                    <textarea name="project_des" id="ckeditor" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label mb-0">Challanges</label>
                    <textarea name="project_challanges" id="ckeditorchallanges" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label mb-0">Solutions</label>
                    <textarea name="project_solutions" id="ckeditorsolutions" class="form-control"></textarea>
                </div>
            </div>
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
