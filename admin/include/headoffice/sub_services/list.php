<?php
$search_word    = '';
$search_query   = '';
$filters        = 'search';

if (!empty($_GET['search_word'])) {
    $search_word     = $_GET['search_word'];
    $search_query   .= 'AND (ss_title LIKE "%'.$search_word.'%")';
    $filters        .= '&search_word='.$search_word.'';
}

$search_word = (isset($_GET['search']) ? $_GET['search_word'] : '');
$condition = array(
                     'select'       =>  'ss_id, ss_status, service_title,ss_title, ss_icon, ss_banner'
                    ,'join'         =>  'inner join '.SERVICES.' as s ON s.service_id=ss.id_service'
                    ,'where'        =>  array(
                                                'ss.is_deleted'  => 0
                                            )
                    ,'search_by'    =>  ''.$search_query.''
                    ,'order_by'     =>  'ss_id ASC'
                    ,'return_type'  =>  'count'
);
$count     = $dblms->getRows(SUBSERVICES .' as ss' , $condition);
echo'
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1"><i class="ri-file-paper-2-fill align-bottom me-1"></i>'.moduleName(0).'</h5>
            <div class="flex-shrink-0">
                <a href="?add" class="btn btn-primary btn-sm"><i class="ri-add-circle-line align-bottom me-1"></i>'.moduleName(0).'</a>
            </div>
        </div>
    </div>
    <div class="card-body">   
        <div class="row justify-content-end">
            <div class="col-3">
                <form action="" class="form-horizontal" id="form" enctype="multipart/form-data" method="get" autocomplete="off" accept-charset="utf-8">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search" name="search_word" value="'.$search_word.'">
                        <button type="submit" class="btn btn-primary btn-sm" name="search"><i class="ri-search-2-line"></i></button>
                    </div>
                </form>
            </div>
        </div>     ';       
        if ($page == 0 || empty($page)) { $page = 1; }
        $prev        = $page - 1;
        $next        = $page + 1;
        $lastpage    = ceil($count / $Limit);   //lastpage = total pages // items per page, rounded up
        $lpm1        = $lastpage - 1;        

        $condition['order_by'] = "ss_id ASC LIMIT " . ($page - 1) * $Limit . ",$Limit";
        $condition['return_type'] = 'all';

        $regions     = $dblms->getRows(SUBSERVICES .' as ss', $condition);
        if ($regions) {
            echo'
            <div class="table-responsive table-card">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="40" class="text-center">Sr.</th>
                            <th width="100">Icon</th>
                            <th width="100">Banner</th>
                            <th>Title</th>
                            <th>Service</th>
                            <th width="70" class="text-center">Status</th>
                            <th width="100" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        if ($page == 1) {
                            $srno = 0;
                        } else {
                            $srno = ($page - 1) * $Limit;
                        }

                        foreach ($regions as $row) {
                            $srno++;
                            echo '
                            <tr style="vertical-align: middle;">
                                <td class="text-center">'.$srno.'</td>
                                <td><img src="../images/services/sub_services/'.$row['ss_icon'].'" width="50"></td>
                                <td><img src="../images/services/sub_services/banner/'.$row['ss_banner'].'" width="50"></td>
                                <td>'.html_entity_decode($row['ss_title']).'</td>
                                <td>'.html_entity_decode($row['service_title']).'</td>
                                <td class="text-center">'.get_status($row['ss_status']).'</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-soft-primary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end" style="cursor: pointer;">
                                            <li><a href="?id='.$row['ss_id'].'" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li><a class="dropdown-item" onclick="confirm_modal(\''.moduleName().'.php?deleteid='.$row['ss_id'].'\');"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>';
                        }
                        echo'
                    </tbody>
                </table>';                
                include_once('include/pagination.php');
                echo'
            </div>';
        } else {
            echo'
            <div class="noresult" style="display: block">
                <div class="text-center">
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                    </lord-icon>
                    <h5 class="mt-2">Sorry! No Record Found</h5>
                    <!--<p class="text-muted">We\'ve searched more than 150+ Orders We did not find any orders for you search.</p>-->
                </div>
            </div>';
        }
        echo'
    </div>
</div>';
?>