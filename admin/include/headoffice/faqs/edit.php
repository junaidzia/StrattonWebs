<?php 
$condition = array(
    'select'       =>  'faq_status, faq_title, faq_des'
    ,'where'        =>  array(
                               'is_deleted'  => 0,
                               'faq_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(FAQS, $condition);

echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="faq_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" data-choices name="faq_status" required>
                            <option value=""> Choose one</option>';
                            foreach(get_status() as $key => $status):
                                echo'<option value="'.$key.'" '.($row['faq_status'] == $key?'selected':'').'>'.$status.'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="faq_title" value="'.$row['faq_title'].'" placeholder="Enter Title" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Detail</label>
                        <textarea name="faq_des" id="ckeditor" class="form-control">'.html_entity_decode($row['faq_des']).'</textarea>
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