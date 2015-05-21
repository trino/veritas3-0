<?php
    if ($this->request->session()->read('debug')) {
        echo "<span style ='color:red;'>subpages/profile/feedback.php #INC124445</span>";
    }
?>

<div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-briefcase"></i>Surveys Submitted
        </div>
    </div>
    <div class="portlet-body">

        <div class="table-scrollable">

            <table
                class="table table-condensed  table-striped table-bordered table-hover dataTable no-footer">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Survey Name</th>
                    <th>Submitted On</th>
                    <th>Actions</th>

                </tr>
                </thead>
                <tbody class="allpt">
                <tr>
                    <td>1</td>
                    <td>60 day survey</td>
                    <td>3/3/15 20:45</td>
                    <td><a href="javascript:;" class="btn btn-info editptype" id="editptype_1">View</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>60 day survey</td>
                    <td>6/31/15 20:45</td>
                    <td><a href="javascript:;" class="btn btn-info editptype" id="editptype_1">View</a></td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
