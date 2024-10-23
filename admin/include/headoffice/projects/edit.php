<?php 
$condition = array(
    'select'       =>  'project_status, project_title, project_title_support, project_des, project_btn_title, project_challanges, project_solutions, project_web, id_platform, id_services'
    ,'where'        =>  array(
                               'is_deleted'  => 0,
                               'project_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(PROJECTS, $condition);

echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="project_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" data-choices name="project_status" required>
                            <option value=""> Choose one</option>';
                            foreach(get_status() as $key => $status):
                                echo'<option value="'.$key.'" '.($key == $row['project_status'] ? 'selected' : '' ).'>'.$status.'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" value="'.$row['project_title'].'" name="project_title" placeholder="Enter Title" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title Support <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" value="'.$row['project_title_support'].'" name="project_title_support" placeholder="Enter Title Support" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Image<span class="text-danger"> ( 600 by 400 ) px</span></label>
                        <input class="form-control" type="file" name="project_img" accept=".jpg,.jpeg,.png" >
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Banner<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                        <input class="form-control" type="file" name="project_banner" accept=".jpg,.jpeg,.png" >
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Description Image<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                        <input class="form-control" type="file" name="project_desimg" accept=".jpg,.jpeg,.png">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Contact Page Btn Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" value="'.$row['project_btn_title'].'" name="project_btn_title" placeholder="Enter Btn Title" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Project Website <span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="project_web" value="'.$row['project_web'].'" placeholder="Enter Project Website Link" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Platforms <span class="text-danger"> *</span></label>
                        <input type="text" name="id_platform" value="'.$row['id_platform'].'" data-choices data-choices-removeItem  required>';
                        // echo '
                        // <select class="form-control" data-choices name="id_platform" required>
                        //     <option value=""> Choose one</option>';
                        //     foreach($platforms as $value):
                        //         echo'<option value="'.$value['platform_id'].'" '.($value['platform_id'] == $row['id_platform'] ? 'selected':'').'>'.$value['platform_title'].'</option>';
                        //     endforeach;
                        //     echo'
                        // </select>';
                        echo '
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Services <span class="text-danger"> *</span></label>
                        <input type="text" name="id_services" value="'.$row['id_services'].'" data-choices data-choices-removeItem  required>';
                        // echo '
                        // <select class="form-control" multiple data-choices name="id_services[]" required>
                        //     <option value=""> Choose one</option>';
                        //     foreach($services as $value):
                        //         echo'<option value="'.$value['service_id'].'" '.(in_array($value['service_id'],explode(",",$row['id_services'])) ? 'selected':'').'>'.$value['service_title'].'</option>';
                        //     endforeach;
                        //     echo'
                        // </select>';
                        echo '
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Detail</label>
                        <textarea name="project_des" id="ckeditor" class="form-control">'.html_entity_decode($row['project_des']).'</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Challanges</label>
                        <textarea name="project_challanges" id="ckeditorchallanges" class="form-control">'.html_entity_decode($row['project_challanges']).'</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Solutions</label>
                        <textarea name="project_solutions" id="ckeditorsolutions" class="form-control">'.html_entity_decode($row['project_solutions']).'</textarea>
                    </div>
                </div>    
            </div>
            <div class="card-footer">
                <div class="hstack gap-2 justify-content-end">
                    <a href="'.moduleName().'.php" class="btn btn-danger btn-sm"><i class="ri-close-circle-line align-bottom me-1"></i>Cancel</a>
                    <button type="submit" class="btn btn-info btn-sm" name="submit_edit"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</button>
                </div>
            </div>
        </form>
    </div>';
?>