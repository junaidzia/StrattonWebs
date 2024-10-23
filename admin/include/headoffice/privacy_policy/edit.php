<?php 
$condition = array(
    'select'       =>  'pp_status, pp_title, pp_des'
    ,'where'        =>  array(
                               'is_deleted'  => 0,
                               'pp_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(PRIVACYPOLICY, $condition);

echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="pp_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" data-choices name="pp_status" required>
                            <option value=""> Choose one</option>';
                            foreach(get_status() as $key => $status):
                                echo'<option value="'.$key.'" '.($row['pp_status'] == $key?'selected':'').'>'.$status.'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="pp_title" value="'.$row['pp_title'].'" placeholder="Enter Title" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Detail</label>
                        <textarea name="pp_des" id="ckeditor" class="form-control">'.html_entity_decode($row['pp_des']).'</textarea>
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