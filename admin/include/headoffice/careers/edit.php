<?php 
$condition = array(
    'select'       =>  'career_status, career_title, career_des'
    ,'where'        =>  array(
                               'is_deleted'  => 0,
                               'career_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(CAREERS, $condition);
$condition = array(
    'select'       =>  'cd_title, cd_highlight'
    ,'where'        =>  array(
                               'id_career' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'all'
);
$careerdetails     = $dblms->getRows(CAREERDETAIL, $condition);

echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="career_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" data-choices name="career_status" required>
                            <option value=""> Choose one</option>';
                            foreach(get_status() as $key => $status):
                                echo'<option value="'.$key.'" '.($row['career_status'] == $key?'selected':'').'>'.$status.'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="career_title" value="'.$row['career_title'].'" placeholder="Enter Title" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Detail</label>
                        <textarea name="career_des" id="ckeditor" class="form-control">'.html_entity_decode($row['career_des']).'</textarea>
                    </div>
                </div>
                <div id="career_detail">';
                if($careerdetails){
                    $count = 0;
                    foreach ($careerdetails as $detail) {
                        ++$count;
                        echo '
                        <div class="p-3 mb-1 bg-light align-items-end">
                            <button class="" onclick="remove(this)">X</button>
                            <div class="row">
                                <div class="col mb-2">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="cd_title[]" value="'.$detail['cd_title'].'" required>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="col mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="cd_highlight[]" value="1" '.($detail['cd_highlight'] ?'checked':'').' type="checkbox" role="switch" id="highlights-'.$count.'">
                                        <label class="form-check-label" id="highlightsfor-'.$count.'" for="highlights-'.$count.'">Add this in Higlights</label>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                }
                echo '
                </div>
                <button type="button" class="btn btn-primary" onclick="add_career_detail()">Add Career Detail</button>
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