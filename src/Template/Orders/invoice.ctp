<?php $settings = $this->requestAction('settings/get_settings');?>
<link href="<?php echo $this->request->webroot;?>assets/admin/pages/css/invoice.css" rel="stylesheet" type="text/css"/>
<h3 class="page-title">
    Invoice <small>orders invoice</small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="index.html">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Extra</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Invoice</a>
		</li>
	</ul>
	<!--<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
			Actions <i class="fa fa-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="#">Action</a>
				</li>
				<li>
					<a href="#">Another action</a>
				</li>
				<li>
					<a href="#">Something else here</a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="#">Separated link</a>
				</li>
			</ul>
		</div>
	</div>-->
    <div class="clearfix"></div>
    <div class="chat-form"> 
        <form action="" method="get">
    		<div class="row">
    			<div class="col-md-11" align="right" style="margin-right:0;padding-right:0">
                    <div style="float:right;">
                    
                        <select name="client_id" class="form-control showprodivision input-inline">
                        <option value="">Client</option>
                        <?php 
                            foreach($clients as $c)
                            {?>
                             <option value="<?php echo $c->id;?>" <?php if(isset($_GET['client_id']) &&$_GET['client_id']==$c->id)echo "selected='selected'";?>><?php echo $c->company_name;?></option>       
                        <?php
                             }
                        ?>
                        </select>
                    </div>
    				<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
    					<span class="input-group-addon"> Start </span>
    					<input type="text" class="form-control" name="from" value="<?php if(isset($_GET['from'])) echo $_GET['from'];?>" />
    					<span class="input-group-addon"> to </span>
    					<input type="text" class="form-control" name="to" title="Leave blank to end at today" value="<?php if(isset($_GET['to'])) echo $_GET['to'];?>">
                        <!--button type="submit" class="btn btn-primary" style="float">Search</button-->
    
    				</div>
    			</div>
    			<!--div class="col-md-4" style="position: relative;  top: 50%;  transform: translateY(+20%);">
    				<input type="checkbox" name="drafts" value="1" <?php if($isdraft){ echo "checked";}?> ><label class="control-label" for="drafts">Drafts</label>
    			</div-->
    			<div class="col-md-1" align="right" style="padding-left:0;margin-left:0">
                    <button type="submit" class="btn btn-primary">Search</button>
    			</div>
    		</div>
    	</form>
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->

    	
<div class="invoice">

	<div class="row invoice-logo">
		<div class="col-xs-6 invoice-logo-space">
         <?php if(isset($_GET['client_id'])){
                $client = $this->requestAction("/clients/getClient/".$_GET['client_id'])?>
            <img class="img-responsive" style="max-width:180px;" id="clientpic" alt=""
             src="<?php if (isset($client->image) && $client->image)
                 {
                     echo $this->request->webroot; ?>img/jobs/<?php echo $client->image . '"';
                 }
                 else
                 {
                    echo $this->request->webroot;?>img/clients/<?php echo $settings->client_img;?>"
            <?php
                }
                
            ?> />
			<?php }?>
		</div>
		<div class="col-xs-6">
			<p>
				 #5652256 / <?php echo date('d M Y');?> <span class="muted">
				Consectetuer adipiscing elit </span>
			</p>
		</div>
	</div>
	<hr/>
	<div class="row">
    <?php if(isset($_GET['client_id'])){?>
        
        <div class="col-xs-4">
			<h3>Client:</h3>
			<ul class="list-unstyled">
				<li>
					 <?php echo $client->title;?>
				</li>
				<li>
					<?php echo $client->company_name;?>
				</li>
				<li>
					 <?php echo $client->address;?>
				</li>
				
			</ul>
		</div>
		<div class="col-xs-4">
			<h3>About:</h3>
			<ul class="list-unstyled">
				<li>
					 <?php echo $client->description;?>
				</li>
			</ul>
		</div>
		<div class="col-xs-4 invoice-payment">
			<h3>Payment Details:</h3>
			<ul class="list-unstyled">
				<li>
					<strong>V.A.T Reg #:</strong> 542554(DEMO)78
				</li>
				<li>
					<strong>Account Name:</strong> FoodMaster Ltd
				</li>
				<li>
					<strong>SWIFT code:</strong> 45454DEMO545DEMO
				</li>
				<li>
					<strong>V.A.T Reg #:</strong> 542554(DEMO)78
				</li>
				<li>
					<strong>Account Name:</strong> FoodMaster Ltd
				</li>
				<li>
					<strong>SWIFT code:</strong> 45454DEMO545DEMO
				</li>
			</ul>
		</div>
        <?php }?>
	</div>
	<div class="row">
    <?php if(count($orders)>0){?>
		<div class="col-xs-12">
			<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th>
					 #
				</th>
				<th>
					 Item
				</th>
				<th class="hidden-480">
					 Description
				</th>
				<th class="hidden-480">
					 Quantity
				</th>
				<th class="hidden-480">
					 Unit Cost
				</th>
				<th>
					 Total
				</th>
			</tr>
			</thead>
			<tbody>
            <?php foreach($orders as $o){?>
            <tr>
          		<td>
					 <?php echo $o->id;?>
				</td>
				<td>
					 <?php echo $o->title;?>
				</td>
				<td class="hidden-480">
					 Server hardware purchase
				</td>
				<td class="hidden-480">
					 32
				</td>
				<td class="hidden-480">
					 $75
				</td>
				<td>
					 $2152
				</td>
                
            </tr>
            <?php }?>
		
			</tbody>
			</table>
		</div>
        <?php }
        else{
            echo "<strong>No Results Found!</strong>";
        }?>
        
	</div>
	<div class="row">
		<div class="col-xs-4">
			<div class="well">
				<address>
				<strong>Loop, Inc.</strong><br/>
				795 Park Ave, Suite 120<br/>
				San Francisco, CA 94107<br/>
				<abbr title="Phone">P:</abbr> (234) 145-1810 </address>
				<address>
				<strong>Full Name</strong><br/>
				<a href="mailto:#">
				first.last@email.com </a>
				</address>
			</div>
		</div>
		<div class="col-xs-8 invoice-block">
			<ul class="list-unstyled amounts">
				<li>
					<strong>Sub - Total amount:</strong> $9265
				</li>
				<li>
					<strong>Discount:</strong> 12.9%
				</li>
				<li>
					<strong>VAT:</strong> -----
				</li>
				<li>
					<strong>Grand Total:</strong> $12489
				</li>
			</ul>
			<br/>
			<a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
			Print <i class="fa fa-print"></i>
			</a>
			<a class="btn btn-lg green hidden-print margin-bottom-5">
			Submit Your Invoice <i class="fa fa-check"></i>
			</a>
		</div>
	</div>
</div>