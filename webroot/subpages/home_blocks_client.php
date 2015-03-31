  <?php
 if($_SERVER['SERVER_NAME'] =='localhost')
        echo "<span style ='color:red;'>home_blocks_clients.php #INC159</span>";
 ?>
<div class="row">


	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-copy"></i>Documents
			</div>

		</div>

	</div>
	</div>


                <?php 
                $class = array('blue-madison','red','yellow','purple','green-meadow','blue','yellow-saffron','grey-cascade','blue-steel','green','red-intense');
                //echo $id;
                $doc = $this->requestAction('/documents/getDocument');
                $i=0;
                if($doc){
                    foreach($doc as $d)
                    {
                        
                        //$csubdoc = $this->requestAction('/clients/getCSubDoc/'.$id.'/'.$d->id);
                        $csubdoc = $this->requestAction('/settings/all_settings/0/0/client/'.$id.'/'.$d->id);
                        //var_dump($csubdoc);
                        
                        if($i==11)
                        $i=0;
                        ?>
                        <?php
                        /*
                            $countClientDoc = $this->requestAction('clients/countClientDoc/'.$id.'/'.$d->document_type);
                            $ccd = 0;
                            foreach($countClientDoc as $c)
                            {
                                $ccd++;
                            } */
                            if($csubdoc['display'] == 1 && $d->display==1) {
                        ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

    					<div class="dashboard-stat <?php echo $class[$i]; ?>">
                            <div class="whiteCorner"></div>
    
                            <div class="visual">
    							<i class="fa fa-copy"></i>
    						</div>
    						<div class="details">
    							<div class="number">
    								<?php if($d->orders==0)echo $cnt = $this->requestAction('/documents/get_documentcount/'.$d->id."/".$id); ?>
                                    <?php if($d->orders==1)echo $cnt = $this->requestAction('/documents/get_orderscount/'.$d->table_name."/".$id); ?>
    							</div>
    							<div class="desc">
    								 <?php echo ucfirst($d->title); ?>
    							</div>
    						</div>
    						<a class="more" href="<?php echo $this->request->webroot;?>documents/index?type=<?php echo urlencode($d->title);?>">
    						View more <i class="m-icon-swapright m-icon-white"></i>
    						</a>
    					</div>
                        <div class="dusk"></div>
    
                    </div>
                    
                        <?php
                        }
                        $i++;
                    }
                }
                
                 ?>
			<!--	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue-madison">
                        <div class="whiteCorner"></div>

                        <div class="visual">
							<i class="fa fa-copy"></i>
						</div>
						<div class="details">
							<div class="number">
								 1349
							</div>
							<div class="desc">
								 Pre-Screening
							</div>
						</div>
						<a class="more" href="#">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
                    <div class="dusk"></div>

                </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat yellow">
						<div class="whiteCorner"></div>

                        <div class="visual">
							<i class="fa fa-copy"></i>
						</div>
						<div class="details">
							<div class="number">
								 1012
							</div>
							<div class="desc">
								Driver Application
							</div>
						</div>
						<a class="more" href="#">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>                    
                    <div class="dusk"></div>

    </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                    <div class="dashboard-stat red">  <div class="whiteCorner"></div>
						<div class="visual">
							<i class="fa fa-copy"></i>
						</div>
						<div class="details">
							<div class="number">
								 803
							</div>
							<div class="desc">
								<?php //echo ucfirst($settings->client);?>
                                MEE Consent
							</div>
						</div>
						<a class="more" href="#">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
                    <div class="dusk"></div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                    <div class="dashboard-stat green">     <div class="whiteCorner"></div>
						<div class="visual">
							<i class="fa fa-copy"></i>
						</div>
						<div class="details">
							<div class="number">
								 541
							</div>
							<div class="desc">
								<?php //echo ucfirst($settings->profile);?>
                                Driver Evaluation
							</div>
						</div>
						<a class="more" href="#">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
                    <div class="dusk"></div>

                </div>
				
			-->	
			</div>