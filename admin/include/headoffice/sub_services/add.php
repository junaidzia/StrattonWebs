<?php
$condition = array(
    'select'       =>  'service_id, service_title'
   ,'where'        =>  array(
                                'service_status'    => 1
                               ,'is_deleted'        => 0
                           )
   ,'order_by'     =>  'service_id ASC'
   ,'return_type'  =>  'all'
);
$services     = $dblms->getRows(SERVICES , $condition);
echo'
<div class="card mb-5">
    <div class="modal-header bg-primary p-3">
        <h5 class="modal-title" id="exampleModalLabel"><i class="ri-add-circle-line align-bottom me-1"></i>Add '.moduleName(0).'</h5>
    </div>
    <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="card-body">
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label">Services <span class="text-danger">*</span></label>
                    <select class="form-control" data-choices name="id_service" required>';
                        foreach($services as $service):
                            echo'<option value="'.$service['service_id'].'">'.html_entity_decode($service['service_title']).'</option>';
                        endforeach;
                        echo'
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-control" data-choices name="ss_status" required>
                        <option value=""> Choose one</option>';
                        foreach(get_status() as $key => $status):
                            echo'<option value="'.$key.'">'.$status.'</option>';
                        endforeach;
                        echo'
                    </select>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="ss_title" placeholder="Enter Title" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Title Support <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="ss_titlesupport" placeholder="Enter Title Support" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <label class="form-label">Icon<span class="text-danger"> ( 45 by 45 ) px</span></label>
                    <input class="form-control" type="file" name="ss_icon" accept=".jpg,.jpeg,.png" required>
                </div>
                <div class="col mb-2">
                    <label class="form-label">Banner<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                    <input class="form-control" type="file" name="ss_banner" accept=".jpg,.jpeg,.png" required>
                </div>
            </div>
            <div id="subservices_content"></div>
            <button type="button" class="btn btn-primary mb-2" onclick="add_subservices_content()">Add Sub Services Content</button>
            <div id="subservices_detail"></div>
            <button type="button" class="btn btn-primary" onclick="add_subservices_detail()">Add Sub Services Detail</button>

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
