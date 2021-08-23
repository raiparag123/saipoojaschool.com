<?php
ob_start();
require 'db.php'; 
session_start();
$year=$_SESSION["year"];
$fy_id=$_SESSION["fy_id"];
$month_list = array("NA","April", "May", "June","July","August","September","October","November","December","January","February","March");
$feeid="";
$status="";
$class_id="";
$alt_row="";
$tamt="";
	if(isset($_POST["del_stud"]))	{
						$reg=$_POST['del_stud'];
						$stmt = $mysqli->prepare("UPDATE stud_regist_master SET is_delete = 0  WHERE registration_id=?");
						$stmt->bind_param("d",$reg);
						if (!$stmt->execute()) { 
								trigger_error('Error executing MySQL query: ' . $stmt->error);
								$status=0;
						
						}else {
							$status=1;
							
						}
						$stmt->close();
						
						echo $status;
						exit;
		
		
		
	}
	
	
	if(isset($_REQUEST["edit_fname"]))	{
		$id=intval($_REQUEST['edit_fname']);
		$feests="Add Fee name";
		$feeid=$id;
		if(!$feeid==0){
		$fee_name="";
		//230420#11  add isdelete in select query to exclude delete rows 
		$stmt = $mysqli->prepare("select fee_name from fee_name_master where fee_name_id=? and is_delete=1");
		$stmt->bind_param("d",$id);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($fee_names);
		$count=$stmt->num_rows;
		while($data = $stmt->fetch())
		{
			$fee_name=$fee_names;
			
		}
		$stmt->close();
		$feests="Edit Fee name";

		}		?>
		
	 <form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $feests; ?></h4>
            </div>
            <div class="modal-body">
			<p class="statusMsg"></p>
                <form class="form-horizontal">
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="txtname" > Fee Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="feename" name="txtname" value="<?php if(!$feeid==0) echo $fee_name;?>">
								<input type="hidden" id="feeid" value="<?php echo $id; ?>" >
                            </div>
                        </div>
						<div class="form-group">
						<div class="col-sm-6">
						 <button type="button" data-dismiss="modal">Cancel</button>
						 <button type="button" id="SaveFeeNames" onclick="SaveFeeName()" >Save</button>
						 </div>
						</div>
                        
                    </div>
                </form>
            </div>
        </div>
    </form>
		
		
		
		
		
		
		
		
		
		
		
	<?php 	
	}
?>



<?php 

if(isset($_POST['fee_id'])) 
	{
		$fname=$_POST['fee_name'];
		$fid=$_POST['fee_id'];
		if($fid == 0){
			$stmt = $mysqli->prepare("insert into  fee_name_master (fee_name) values (?)");
		$stmt->bind_param("s",$fname);
			
		}else {
		$stmt = $mysqli->prepare("update fee_name_master set fee_name=?,dou= CURRENT_TIMESTAMP()  where fee_name_id=?"); //@1 : Added dou in column to get update timestamp in fee_name_master table
		$stmt->bind_param("sd",$fname,$fid);
		}
						if (!$stmt->execute()) { 
								trigger_error('Error executing MySQL query: ' . $stmt->error);
								
								$status = 0;
						}else
						{	
						
						$status = 1;
						}
						$stmt->close();
						echo $status;die;
		
		
		
	}



if(isset($_POST["class_struct"]))	{ //fetch table data for class fee structure.

$class_id=$_POST['class_struct'];
$medm_id=$_POST['medm_id'];

						/*change_080229#8 adding a.fy_id in query & "and b.is_delete = 1" to get active 
						$stmt = $mysqli->prepare("select a.fee_id,b.fee_struct_id,b.fee_amount,c.fee_name,c.fee_name_id from fee_master a,fee_struct_master b,fee_name_master c where a.fee_id=b.fee_id and b.fee_name_id=c.fee_name_id and a.class_id=(select class_id from class_master where class_name=? and medium=?)");
						$stmt->bind_param("ss",$class_id,$medm_id);
						*/
						$stmt = $mysqli->prepare("select a.fee_id,b.fee_struct_id,b.fee_amount,c.fee_name,c.fee_name_id from fee_master a,fee_struct_master b,fee_name_master c where a.fee_id=b.fee_id and b.fee_name_id=c.fee_name_id and b.is_delete = 1 and c.is_delete=1 and a.class_id=(select class_id from class_master where class_name=? and medium=?)");
						$stmt->bind_param("ss",$class_id,$medm_id);
						$result = $stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($fee_id,$fstruct_id,$famt,$fname,$fnid);
						$rw=$stmt->num_rows;
						
						
						while($data = $stmt->fetch())
						{
							
						$status .="<tr><td>$fname</td><td>".$famt."</td><td><button id='editclassfee'   data-toggle='modal' data-target='#ClassFeeModal' data-id='".$fstruct_id."'   class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button><button id='deleteclassfee'   	 data-id='".$fstruct_id."'  class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button></td></tr>";
						}
						if($rw == 0)
							$status .="<tr><td></td><td>No Data found.</td><td></td></tr>";
				
				echo $status;exit;

		
		
	}
	
	
	
	if(isset($_REQUEST["edit_classfee"]) ||    isset($_REQUEST["add_struct"]) )	{
		$fy_id=$_SESSION["fy_id"];
		$feests="Add Class Fee";
		$feeid="";
		
		$fee_name="";
		if(!isset($_REQUEST["add_struct"])){
		$id=intval($_REQUEST['edit_classfee']);
		$feeid=$id;
		$stmt = $mysqli->prepare("select b.fee_struct_id,b.fee_amount,c.fee_name,c.fee_name_id from fee_name_master c,fee_struct_master b where  b.fee_name_id=c.fee_name_id and b.fee_struct_id=?");
		$stmt->bind_param("d",$id);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($fee_struct_id,$fee_amt,$fee_name,$feenameid);
		$count=$stmt->num_rows;
		while($data = $stmt->fetch())
		{

		}
		$stmt->close();
		$feests="Edit Class Fee";

		}
		else		
		{
			$cls_id=$_REQUEST['add_struct'];
			$mdmid=$_REQUEST['medm_id'];

			//230420#9 : added fy_id into query to get the fee_id for current fy_id.
			$stmt = $mysqli->prepare("select a.fee_id from fee_master a,class_master b where  a.class_id=b.class_id and b.class_name=? and b.medium=?");
			$stmt->bind_param("ss",$cls_id,$mdmid);
			$result = $stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($feeid);
			$count=$stmt->num_rows;
			while($data = $stmt->fetch())
			{}
				if($count == 0)
				{
				$stmt = $mysqli->prepare("select class_id from class_master  where class_name=? and medium=?");
				$stmt->bind_param("ss",$cls_id,$mdmid);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($class_id);
				$count=$stmt->num_rows;
				while($data = $stmt->fetch())
				{}
				
				$stmt = $mysqli->prepare("insert into fee_master (class_id)  values (?)");
				$stmt->bind_param("d",$class_id);
				$stmt->execute();
				
				$feeid=$mysqli->insert_id;
				$stmt->close();
				}
				
			
			
		}
		
		?>
		
	 <form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $feests; ?></h4>
            </div>
            <div class="modal-body">
			<p class="statusMsg"></p>
                <form class="form-horizontal">
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="txtname" > Fee Name</label>
                            <div class="col-sm-6">
                                <!--<input type="text" class="form-control" id="feename" name="txtname" value="<?php //if(!$feeid==0) echo $fee_name;?>">-->
								<select id="feename">
								<?php
								
								$stmt = $mysqli->prepare("select fee_name,fee_name_id from fee_name_master where is_delete=1");
								$result = $stmt->execute();
								$stmt->store_result();
								$stmt->bind_result($fee_name,$fee_name_id);
								//$count=$stmt->num_rows;
								while($data = $stmt->fetch())
								{
									?>
								<option <?php if($fee_name_id == $feenameid) echo "selected";?>   value="<?php echo $fee_name_id; ?>"><?php echo $fee_name; ?></option>
										
								<?php
								}
								$stmt->close();
								?>
								</select>								
								<input type="hidden" id="feestid" value="<?php if(!isset($_REQUEST["add_struct"])) echo $fee_struct_id; ?>" >
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-6 control-label" for="txtname" > Fee Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="feeamt" name="txtname" value="<?php if(!isset($_REQUEST["add_struct"])) echo $fee_amt;?>">
								<input type="hidden" id="feestructid" value="<?php echo $id; ?>" >
								<input type="hidden" id="feeid" value="<?php echo $feeid; ?>" >
                            </div>
                        </div>
						<div class="form-group">
						<div class="col-sm-6">
						 <button type="button" data-dismiss="modal">Cancel</button>
						 <?php if(!isset($_REQUEST["add_struct"])){?><button type="button" id="SaveClassFeenames" onclick="SaveClassFeeName()" >Save</button><?php }?>
						<?php if(isset($_REQUEST["add_struct"])){?><button type="button" id="AddClassFeenames" onclick="AddClassFeeName()" >Add</button><?php }?>
						 </div>
						</div>
                        
                    </div>
                </form>
            </div>
        </div>
    </form>
	
<?php
	
	}	
	
	
	
	
	if(isset($_POST['savefee_struct']) || isset($_POST['addfee_struct'])) 
	{
		
		$fsid=$_POST['savefee_struct'];
		$flag=$_POST['flag'];
		
		$fname=$_POST['fee_names'];
		$fee_amt=$_POST['fee_amt'];
		$fid=isset($_POST['addfee_struct']);
		if($flag == 0 && !isset($_POST['addfee_struct'])){
		//$stmt = $mysqli->prepare("insert into  fee_name_master (fee_name) values (?)");
			$stmt = $mysqli->prepare("select fee_id from fee_struct_master where fee_struct_id=?");
			$stmt->bind_param("d",$fsid); 
			$result = $stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($fee_id);
						$rw=$stmt->num_rows;
						
						while($data = $stmt->fetch())
						{
						$fid=$fee_id;	
						}	
							
						// $stmt = $mysqli->prepare("delete from fee_struct_master where fee_struct_id=?");
						// $stmt->bind_param("d",$fsid); 
						// #10 
						$stmt = $mysqli->prepare("update fee_struct_master set  is_delete=0  ,dou= CURRENT_TIMESTAMP()  where fee_struct_id=?");
						$stmt->bind_param("d",$fsid); 
						$stmt->execute();
						$stmt->close();
		}else {

		// @1 :Added dou in column to get update timestamp (Ajax_calls.php)	
		$stmt = $mysqli->prepare("update fee_struct_master set fee_name_id=? ,dou= CURRENT_TIMESTAMP() where fee_struct_id=?"); 
		$stmt->bind_param("dd",$fname,$fsid);
		
						if (!$stmt->execute()) { 
								trigger_error('Error executing MySQL query: ' . $stmt->error);
								
								$status = 0;
						}else
						{
						$stmt->close();							
						// @1 :Added dou in column to get update timestamp (Ajax_calls.php)	
						$stmt = $mysqli->prepare("update fee_struct_master set  fee_amount=? ,dou= CURRENT_TIMESTAMP() where fee_struct_id=?");
						$stmt->bind_param("dd",$fee_amt,$fsid);
						$stmt->execute();
						$stmt->close();
						}
						
						}
						
						if($flag == 1){
							#230420#11 : add isdelete in query to exclude delete rows	
						$stmt = $mysqli->prepare("select b.fee_struct_id,b.fee_amount,c.fee_name,c.fee_name_id from fee_struct_master b,fee_name_master c where b.is_delete = 1 and b.fee_name_id=c.fee_name_id and b.fee_id=(select fee_id from fee_struct_master where fee_struct_id=?)");
						$stmt->bind_param("d",$fsid);
						}
						else{
								if(isset($_POST['addfee_struct'])){
									$fid=$_POST['addfee_struct'];
								$stmt = $mysqli->prepare("insert into fee_struct_master (fee_amount,fee_name_id,fee_id)  values (?,?,?)");
								$stmt->bind_param("ddd",$fee_amt,$fname,$fid);
								$stmt->execute();
								$stmt->close();
								
								
								}
							
						#230420#11 : add isdelete in query to exclude delete rows	
						$stmt = $mysqli->prepare("select b.fee_struct_id,b.fee_amount,c.fee_name,c.fee_name_id from fee_struct_master b,fee_name_master c where b.is_delete = 1 and b.fee_name_id=c.fee_name_id and b.fee_id=?");
						$stmt->bind_param("d",$fid);
						}
						$result = $stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($fstruct_id,$famt,$fname,$fnid);
						$rw=$stmt->num_rows;
						$status="";
						while($data = $stmt->fetch())
						{
						$status .="<tr><td>".$fname."</td><td>".$famt."</td><td><button id='editclassfee'   data-toggle='modal' data-target='#ClassFeeModal' data-id='".$fstruct_id."'   class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button><button id='deleteclassfee'   	 data-id='".$fstruct_id."'  class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button></td></tr>";
						}
						if($rw == 0)
							$status .="<tr><td></td><td>No Data founds</td><td></td></tr>";
						
						$stmt->close();
						echo $status;die;
		
	}
	
	
	
	if(isset($_POST["addfeerow"]))
	{
		//#11 : add isdelete in select query to exclude delete rows 
		$stmt = $mysqli->prepare("select fee_name,fee_name_id from fee_name_master where is_delete=1");
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($fee_name1,$fee_name_id1);
		//$status="<select class='form-control  select2'>";
		while($data1 = $stmt->fetch()){		
			$status .="<option value='".$fee_name_id1."' selected>".$fee_name1."</option>";
		}
		$stmt->close();
		
		echo $status;die;

	}

	if(isset($_POST["feecollect"]))
	{
		$paidby=$_POST["paidby"];
		$studfeeid=$_POST['studfeeid'];
		$month=$_POST['month1'];
		$noofmonth=1;
		$i=0;
		//echo $item['feename'];
		//echo $item['month'];echo $item['amount'];	echo $item['tamount'];
		foreach ($_POST['rows'] as $item) {
			
			for($i=0; $i<$item['month']; $i++){
			
			if($item['month'] > $noofmonth)
			$noofmonth=$item['month'];
			//$imonth=$month+$i;
			$id=$studfeeid+$i;
			$stmt = $mysqli->prepare("insert into stud_fee_log_master(stud_fee_id,fee_name_id,fee_amount) value(?,?,?)");
			$stmt->bind_param("ddd",$id,$item['feename'],$item['amount']);
			$stmt->execute();
			//$count=$stmt->affected_rows;
			}
			$stmt->close();
		}
		$i=0;
		$_SESSION["s_id"]=$studfeeid+$i;
		$end_id=0;
		for($i=0;$i<$noofmonth;$i++)
		{
			$id=$studfeeid+$i;
			$doc=date('Y-m-d H:i:s');
			$stmt = $mysqli->prepare("update  stud_fee_master set status=1,datetimes=?,paidby=? where stud_fee_id=?");
			$stmt->bind_param("ssd",$doc,$paidby,$id);
			$stmt->execute();
			//$count=$stmt->affected_rows;
			//echo $paidby;
		$_SESSION["e_id"]=$id;
		}
		
		
		header("Location:print_fees.php");
	}

			if(isset($_POST["showcolfess"])) //alter_fees.php show fees colleted columns.
			{
				$showcolfess= $_POST["showcolfess"];
				$pname="A";
				$stmt = $mysqli->prepare("select a.fee_name_id,b.fee_name,a.fee_amount,c.paidby from stud_fee_log_master a,fee_name_master b,stud_fee_master c where a.fee_name_id=b.fee_name_id and a.stud_fee_id=c.stud_fee_id and c.stud_fee_id=?");
				$stmt->bind_param("d",$showcolfess);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($fee_name_id,$fee_name,$fee_amount,$pname);		
				$i=1;
				while($data1 = $stmt->fetch()){		
					$status .="<tr>";
					$status .="<td><button ' type='button'  onClick='delfeecol(this);' class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button></td>";
					$status .="<td><select class='form-control  select2' name='rows[".$i."][feename]'>";
					$stmt1 = $mysqli->prepare("select fee_name,fee_name_id from fee_name_master where is_delete=1");
																	$result1 = $stmt1->execute();
																	$stmt1->store_result();
																	$stmt1->bind_result($fee_name1,$fee_name_id1);
																	while($data1 = $stmt1->fetch()){
																	if($fee_name_id==$fee_name_id1)
																			$status .="<option value='".$fee_name_id1."' selected>".$fee_name1."</option>";
																	else
																			$status .="<option value='".$fee_name_id1."' >".$fee_name1."</option>";
																			
																		
																	}
																	$stmt1->close();
					$status .="</select></td>";
					
					
					$status .="<td><input type='text'  name='rows[".$i."][amount]' class='form-control' value='".$fee_amount."' id='amt_txt".$i."'/></td>";
					$status .="</tr>";
				$i++;
				}
				$status .="<input type=hidden name='paidname' id='paidname' value='".$pname."'>";
				$stmt->close();
				//status="done";
				echo $status;die;
			}
			if(isset($_POST["showdcr"]))
			{
				
				$showdcr= $_POST["showdcr"];
				$cs_id=0;
				$father_name="";
				$dates=date('Y-m-d',strtotime($showdcr));
									$stmt = $mysqli->prepare("SELECT e.father_name,a.cs_id,e.regno,e.first_name,d.class_name,f.month_name,sum(b.fee_amount),g.fy_name,f.month_id 
									FROM stud_fee_master a,stud_fee_log_master b,class_stud_master c,class_master d,stud_regist_master e,month_master f,
								   fy_master g WHERE a.month_id=f.month_id and g.fy_id=c.fy_id and   a.stud_fee_id=b.stud_fee_id and c.cs_id=a.cs_id and
									d.class_id=c.class_id and e.registration_id=c.student_id and a.datetimes like '%$dates%' 
									and c.fy_id=? and c.is_delete = 1  and e.status <> 0 and e.is_delete <> 0 
									GROUP by c.cs_id");
									$stmt->bind_param("d",$fy_id);
									$result = $stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($father_name,$cs_id,$reg,$fname,$class_name,$month,$amount,$fy,$month_id);
									$i=1;
									//$count=2;
									$count=$stmt->num_rows;
									
									if($count>0)
									{
										$status .="<thead>
										<tr align='left'>
											<th >Sr. No</th>
											<th >Date</th>
											<th >Reg No.</th>
											<th >Full Name</th>
											<th >Father Name</th>
											<th >Class</th>
											<th >Month</th>
											<th >To Month</th>
											<th >Amount</th>
										</tr>
									</thead>
									
									<tbody>";
										
									}
									$tamt=0;

						
									while($data = $stmt->fetch()){

									

											if($month_id<10)
											$month=$month." ' ".substr($fy,2,2);
											else
											$month=$month." ' ".substr($fy,5,2);
		

										/*if($month_id<10)
										$month=$month." ' ".substr($fy,2,2);
										else
										$month=$month." ' ".substr($fy,5,2);*/

										/*$stmt1 = $mysqli->prepare("select month_name,month_id from month_master where month_id=(select max(month_id) from stud_fee_master where cs_id=? and datetimes like '%$dates%')");
										$stmt1->bind_param("d",$cs_id);
										$result1 = $stmt1->execute();
										$stmt1->store_result();
										$stmt1->bind_result($tomonth,$month_id);
										while($data1 = $stmt1->fetch()){}*/
									$tamt =$tamt+$amount;
									$dates=date('Y-m-d',strtotime($showdcr));



										$stmt1 = $mysqli->prepare("select month_name,month_id from month_master where month_id=(select max(month_id) from stud_fee_master where cs_id=? and datetimes like '%$dates%')");
										$stmt1->bind_param("d",$cs_id);
										$result1 = $stmt1->execute();
										$stmt1->store_result();
										$stmt1->bind_result($tomonth,$tomonth_id);
										$count1=$stmt1->num_rows;
										while($data1 = $stmt1->fetch()){}
											if($tomonth_id<10)
											$tomonth=$tomonth." ' ".substr($fy,2,2);
											else
											$tomonth=$tomonth." ' ".substr($fy,5,2);


									$status .="<tr><td>$i</td><td>$dates</td><td>$reg</td><td>$fname</td><td>$father_name</td><td>$class_name</td><td>$month</td><td>$tomonth</td><td>$amount</td></tr>";
										$i++;
									}
									if($count>0)
									{
										$status .="<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>Total</b></td><td><b>$tamt</b></td></tr></tbody>";
									}
									else
									{
										$status ="No Data Found";
										
									}
									//$status=$amount;
									echo $status;die;
									
									
				
			}	
			
			if(isset($_POST["printfees"])) //alter_fees.php show fees colleted columns.
			{
				$month_name="";
				$fy_name="";
				$first_name="";
				$registration_id="";
				$father_name="";
				$class_name="";
				$fee_name_id="";
				$fee_name="";
				$fee_amount="";
				$datetimes="";
				$month_id="";
				$fy_name="";
				$total="";
				$printfees= $_POST["printfees"];
				$status .="<div class='row'><div class='col-md-2 offset-md-1 text-right'><img src='../assets/img/logo.png' alt='logo' class='img-responsive' height=100px width=100px/></div><div class='col-md-6 text-center'><h2>SAI POOJA  J. HIGH SCHOOL</h2></div></div><hr>";
				$stmt = $mysqli->prepare("SELECT sum(fee_amount) FROM stud_fee_master a,stud_fee_log_master b where a.stud_fee_id=b.stud_fee_id and a.stud_fee_id=?");
				$stmt->bind_param("d",$printfees);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($total);
				$data = $stmt->fetch();
				
				$stmt = $mysqli->prepare("select g.month_id,g.month_name,h.fy_name,e.first_name,e.regno,e.father_name,f.class_name,a.fee_name_id,b.fee_name,a.fee_amount,DATE_FORMAT(c.datetimes,'%d-%m-%Y') as datetimes from stud_fee_log_master a,fee_name_master b,stud_fee_master c,class_stud_master d,stud_regist_master e,class_master f,month_master g,fy_master h where h.fy_id=d.fy_id and c.month_id=g.month_id and f.class_id=d.class_id and d.student_id=e.registration_id and  c.cs_id=d.cs_id and a.fee_name_id=b.fee_name_id and a.stud_fee_id=c.stud_fee_id and c.stud_fee_id=?");
				$stmt->bind_param("d",$printfees);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($month_id,$month_name,$fy_name,$first_name,$registration_id,$father_name,$class_name,$fee_name_id,$fee_name,$fee_amount,$datetimes);		
				$rw=$stmt->num_rows;
				$i=1;
				while($data = $stmt->fetch()){
					if($month_id<10)
						$month_name=$month_name." ' ".substr($fy_name,2,2);
					else
						$month_name=$month_name." ' ".substr($fy_name,5,2);
						if($i==1){
				$status .="<div class='row'><div class='col-md-4 text-left'><p  style='font-size:15px;'><b>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b>$first_name</p><p style='font-size:15px;'><b>F. Name&nbsp;:&nbsp;&nbsp;</b>$father_name</p><p style='font-size:15px;'><b>Month&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b>$month_name</p></div><div class='col-md-4 offset-md-4 text-right'><p style='font-size:15px;'><b>Date&nbsp;:&nbsp;&nbsp;</b> $datetimes</p><p style='font-size:15px;'><b>Reg. No&nbsp;:&nbsp;&nbsp;</b> $registration_id&nbsp;</p><p style='font-size:15px;'><b>Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b>$class_name</p></div></div>";
				$status .="<div style='font-size:12px;' class='row'><div class='col-md-12'><div class='table-repsonsive-md text-center'><table  class='table' style='font-size:12px;'>";
				$status .="<thead style='font-size:13px;'><tr><th width='10%'  class='text-center'>Sr. No</th><th   class='text-left'>Paticulars</th><th  class='text-right'>Amount</th><th  width='10%'class='text-right'> </th><th  class='text-center' width='15%'>Month</th><th  class='text-right' width='10%'>Total</th></tr></thead><tbody>";
						}
				$status .="<tr style='font-size:12px;'><td class='text-center'>$i</td><td class='text-left'>$fee_name</td><td class='text-right'>$fee_amount</td><td class='text-right'>x</td><td class='text-center'>1</td><td class='text-right'>$fee_amount.00</td></tr>";
						
				$i++;
				}
				$status .="<tr><td>Sign</td><td></td><td></td><td></td><th class='text-right'>Grand Total</th><th class='text-right'>$total.00</th></tr>";
				$status .="</tbody></table></div></div></div>";
				//$status .=$printfees;
				echo $status;die;
				
				
				
				
			}
			
			
			
			if(isset($_POST["pfees1"])) //alter_fees.php show fees colleted columns.
			{
				$month_name="";
				$fy_name="";
				$first_name="";
				$registration_id="";
				$father_name="";
				$class_name="";
				$fee_name_id="";
				$fee_name="";
				$fee_amount="";
				$datetimes="";
				$month_id="";
				$fy_name="";
				$total="";
				$pfees1= $_POST["pfees1"];
				$pfees2= $_POST["pfees2"];
				$text2= $_POST["text2"];
				$nomonth=1;
				$status .="<div class='row'><div class='col-md-2 offset-md-1 text-right'><img src='../assets/img/logo.png' alt='logo' class='img-responsive' height=100px width=100px/></div><div class='col-md-6  text-center'><h2>SAI POOJA  J. HIGH SCHOOL</h2></div></div><hr>";
				$stmt = $mysqli->prepare("SELECT sum(fee_amount) FROM stud_fee_master a,stud_fee_log_master b where a.stud_fee_id=b.stud_fee_id and a.stud_fee_id between ? and ?");
				$stmt->bind_param("dd",$pfees1,$pfees2);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($total);
				$data = $stmt->fetch();
				
				$stmt = $mysqli->prepare("select month_id from stud_fee_master where stud_fee_id=?");
				$stmt->bind_param("d",$pfees2);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($text2);
				$data = $stmt->fetch();
				if($text2 < 10)
						$month_name1=$month_list[$text2]." ' ".substr($year,2,2);
					else
						$month_name1=$month_list[$text2]." ' ".substr($year,5,2);
				
				$stmt = $mysqli->prepare("select g.month_id,g.month_name,h.fy_name,e.first_name,e.regno,e.father_name,f.class_name,a.fee_name_id,b.fee_name,a.fee_amount,DATE_FORMAT(c.datetimes,'%d-%m-%Y') as datetimes,count(c.month_id) from stud_fee_log_master a,fee_name_master b,stud_fee_master c,class_stud_master d,stud_regist_master e,class_master f,month_master g,fy_master h where h.fy_id=d.fy_id and c.month_id=g.month_id and f.class_id=d.class_id and d.student_id=e.registration_id and  c.cs_id=d.cs_id and a.fee_name_id=b.fee_name_id and a.stud_fee_id=c.stud_fee_id and c.stud_fee_id BETWEEN ? and ? group by a.fee_name_id");
				$stmt->bind_param("dd",$pfees1,$pfees2);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($month_id,$month_name,$fy_name,$first_name,$registration_id,$father_name,$class_name,$fee_name_id,$fee_name,$fee_amount,$datetimes,$nomonth);		
				$rw=$stmt->num_rows;
				$i=1;
				while($data = $stmt->fetch()){
					if($month_id < 10)
						$month_name=$month_name." ' ".substr($fy_name,2,2);
					else
						$month_name=$month_name." ' ".substr($fy_name,5,2);
						if($i==1){
				$status .="<div class='row'><div class='col-md-4 text-left'><p  style='font-size:15px;'><b>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b>$first_name</p><p style='font-size:15px;'><b>F. Name&nbsp;:&nbsp;&nbsp;</b>$father_name</p><p style='font-size:15px;'><b>Month&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b>$month_name - $month_name1</p></div><div class='col-md-4 offset-md-4 text-right'><p style='font-size:15px;'><b>Date&nbsp;:&nbsp;&nbsp;</b> $datetimes</p><p style='font-size:15px;'><b>Reg. No&nbsp;:&nbsp;&nbsp;</b> $registration_id&nbsp;</p><p style='font-size:15px;'><b>Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b>$class_name</p></div></div>";
				$status .="<div style='font-size:12px;' class='row'><div class='col-md-12'><div class='table-repsonsive-md text-center'><table  class='table' style='font-size:12px;'>";
				$status .="<thead style='font-size:13px;'><tr><th width='10%'  class='text-center'>Sr. No</th><th   class='text-left'>Paticulars</th><th  class='text-right'>Amount</th><th  width='10%'class='text-right'> </th><th  class='text-center' width='15%'>Month</th><th  class='text-right' width='10%'>Total</th></tr></thead><tbody>";
						}
						$fee_tamount=$fee_amount * $nomonth;
				$status .="<tr style='font-size:12px;'><td class='text-center'>$i</td><td class='text-left'>$fee_name</td><td class='text-right'>$fee_amount</td><td class='text-right'>x</td><td class='text-center'>$nomonth</td><td class='text-right'>$fee_tamount.00</td></tr>";
						
				$i++;
				}
				$status .="<tr><td>Sign</td><td></td><td></td><td></td><th class='text-right'>Grand Total</th><th class='text-right'>$total.00</th></tr>";
				$status .="</tbody></table></div></div></div>";
				//$status .=$printfees;
				echo $status;die;
				
				
				
				
			}
			
			
			
			
			
			if(isset($_POST["fee_print_drp2"]))
				{
				$fee_print_drp2= $_POST["fee_print_drp2"];
				$stmt = $mysqli->prepare("SELECT month_id,stud_fee_id FROM stud_fee_master where cs_id=(select DISTINCT cs_id from stud_fee_master where stud_fee_id=?) and status=1 and stud_fee_id >= ?");
				$stmt->bind_param("dd",$fee_print_drp2,$fee_print_drp2);
				
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($month_id,$stud_fee_id);
				$i=0;
				$d=array();
				while($data = $stmt->fetch())
				{
				$d[$i][0]=$month_id;
				$d[$i][1]=$stud_fee_id;
				if($month_id < 10 ){
				$year=$_SESSION["year"];
				$year=substr($year,2,2);
				$d[$i][2]=" ' ".$year;
				
				}
				else			{
					$year=$_SESSION["year"];
					$year=substr($year,5,2);
					$d[$i][2]=" ' ".$year;
				}
				$i++;
				}
				echo json_encode($d);
		}
			
			

	
	if(isset($_POST["alterfee"]))
	{

		$studfeeid=$_POST['month2'];
						$stmt = $mysqli->prepare("delete from stud_fee_log_master WHERE stud_fee_id=?");
						$stmt->bind_param("d",$studfeeid);
						$stmt->execute();
						$stmt->close();			
							
		foreach ($_POST['rows'] as $item) {
			$stmt = $mysqli->prepare("insert into stud_fee_log_master(stud_fee_id,fee_name_id,fee_amount) value(?,?,?)");
			$stmt->bind_param("ddd",$studfeeid,$item['feename'],$item['amount']);
			$stmt->execute();
			
			}
			$stmt->close();
			header('Location:all_fee_collection.php');
	}			
	
	




if(isset($_REQUEST["edit_sname"]))	{
		$id=intval($_REQUEST['edit_sname']);
		$subjectsts="Add Subject name";
		$subjectid=$id;
		if(!$subjectid==0){
		$subject_name="";
		$stmt = $mysqli->prepare("select subject_name from subject_master where subject_id=?");
		$stmt->bind_param("d",$id);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($subject_names);
		$count=$stmt->num_rows;
		while($data = $stmt->fetch())
		{
			$subject_name=$subject_names;
			
		}
		$stmt->close();
		$subjectsts="Edit Subject name";

		}		?>
		
	 <form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $subjectsts; ?></h4>
            </div>
            <div class="modal-body">
			<p class="statusMsg"></p>
                <form class="form-horizontal">
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="txtname" > Subject Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="subjectname" name="txtname" value="<?php if(!$subjectid==0) echo $subject_name;?>">
								<input type="hidden" id="subjectid" value="<?php echo $id; ?>" >
                            </div>
                        </div>
						<div class="form-group">
						<div class="col-sm-6">
						 <button type="button" data-dismiss="modal">Cancel</button>
						 <button type="button" id="SaveSubjectNames" onclick="SaveSubjectName()" >Save</button>
						 </div>
						</div>
                        
                    </div>
                </form>
            </div>
        </div>
    </form>		
	<?php 	
	}
	
	if(isset($_POST['subject_id'])) 
	{
		$sname=$_POST['subject_name'];
		$sid=$_POST['subject_id'];
		if($sid == 0){
			/* change080320#6
			Rolled back below lines
			$stmt = $mysqli->prepare("insert into  subject_master (subject_name) values (?)");
			$stmt->bind_param("s",$sname);*/
			$stmt = $mysqli->prepare("insert into  subject_master (subject_name) values (?)");
			$stmt->bind_param("s",$sname);
			
		}else {
		$stmt = $mysqli->prepare("update subject_master set subject_name=? where subject_id=?");
		$stmt->bind_param("sd",$sname,$sid);
		}
						if (!$stmt->execute()) { 
								trigger_error('Error executing MySQL query: ' . $stmt->error);
								
								$status = 0;
						}else
						{	
						
						$status = 1;
						}
						$stmt->close();
						echo $status;die;
		
		
		
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>



