
$(document).ready(function(){	

    

  



    // Delete 
    $('.deleteuser').click(function(){
		
        if(confirm("Are you sure you want to remove this??"))
			{			
					var el = this;
					var id = this.id;
		                      
        // AJAX Request
        $.ajax({
            url: 'ajax_calls1.php',
            type: 'POST',
            data: { del_user:id },
            success: function(response){

                if(response == 1){
                    // Remove row from HTML Table
                    $(el).closest('tr').css('background','tomato');
                    $(el).closest('tr').fadeOut(800,function(){
                        $(this).remove();
                    });
                }else{
                    alert('Invalid ID.');
                }
            }
        });
	}
    });
});


$(document).on('click','#EditFeename',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'ajax_calls.php',
                type:'POST',
                data:'edit_fname='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fail(function(){
                $('#content-data').html('<p>Error</p>');
            });
        });
		
		
	
		$(document).on('click','#AddFeename',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'ajax_calls.php',
                type:'POST',
                data:'edit_fname='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fail(function(){
                $('#content-data').html('<p>Error</p>');
            });
        });
		
		
		
	function SaveFeeName(){
    
           var feeid=document.getElementById("feeid").value;
		   var feename=document.getElementById("feename").value;
		   if(feename.trim() == '' ){
					alert('Please enter Fee name.');
			$('#feename').focus();
		   return false;
		   }
		   else{
		   $.ajax({
                url:'ajax_calls.php',
                type:'POST',
                data:'fee_name='+feename+'&fee_id='+feeid,
				success: function(response){
                if(response == 1){
					//$('.statusMsg').html('<span style="color:green;">Fee Name Edited</p>');
					
					//var Table = document.getElementById("feetable");
					//Table.innerHTML = "";
					 location.reload();
					$('#FeeNameModal').modal('hide');
				} 
				else{
					$('.statusMsg').html('<span style="color:green;">Error in fee name editing</p>');
				}
            }
			
			
            });
		
		
		
		}
	}
	
	$(document).on('click','#shwfeebtn',function(e){
            e.preventDefault();
			var cls_id=document.getElementById("class_drop").value;
			var mdm_id=document.getElementById("medium_drop").value;
			
			if(mdm_id == '0' ){
					alert('Please select medium.');
					return false;
			} else if(cls_id == '0' ){
					alert('Please select Class.');
					return false;
			}
			else {
				
				$.ajax({
            url: 'ajax_calls.php',
            type: 'POST',
            data: 'class_struct='+cls_id+'&medm_id='+mdm_id,   //{ class_struct:cls_id,medm_id:mdm_id },
            success: function(response){

                
                   document.getElementById("feetbls").innerHTML =response;
                    document.getElementById("addclassfee").style.display = "block";
                
					}
				});
				
				
				
			}
            
        });
		
		
		$(document).on('click','#addclassfee',function(e){
            e.preventDefault();
				var cls_id=document.getElementById("class_drop").value;
			var mdm_id=document.getElementById("medium_drop").value;
			
			if(mdm_id == '0' ){
					alert('Please select medium.');
					return false;
			} else if(cls_id == '0' ){
					alert('Please select Class.');
					return false;
			}else
			{	
		
            $('#content-data').html('');
			$("#ClassFeeModal").modal();
            $.ajax({
                url:'ajax_calls.php',
                type:'POST',
                data:'add_struct='+cls_id+'&medm_id='+mdm_id,
                dataType:'html'
            }).done(function(data){
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fail(function(){
                $('#content-data').html('<p>Error</p>');
            });
			
		}
      });
		
		
		
		$(document).on('click','#editclassfee',function(e){
            e.preventDefault();
            var cls_struct_id=$(this).data('id');
            $('#content-data').html('');
            $.ajax({
                url:'ajax_calls.php',
                type:'POST',
                data:'edit_classfee='+cls_struct_id,
                dataType:'html'
            }).done(function(data){
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fail(function(){
                $('#content-data').html('<p>Error</p>');
            });
        });
		
		
		
		
		
		
		
			$(document).on('click','#deleteclassfee',function(e){
            e.preventDefault();
			if(confirm("Are you sure you want to remove this??"))
			{
            var cls_struct_id=$(this).data('id');
			var flg=0;
            //$('#content-data').html('');
            $.ajax({
                url:'ajax_calls.php',
                type:'POST',
                data:'savefee_struct='+cls_struct_id+'&flag='+flg,
                success: function(response){
					document.getElementById("feetbls").innerHTML ="";
					document.getElementById("feetbls").innerHTML =response;
					
				}
				 });
            }
			});
	
	
	
	function SaveClassFeeName(){
    
           var cls_struct = document.getElementById('feestructid').value;
		   //var strSel = "The Value is: " + drop.options[drop.selectedIndex].value;
		   var feeamt = document.getElementById('feeamt').value;
		   var feename=document.getElementById("feename").value;
		   var flg=1;
		   if(feeamt.trim() == '' ){
					alert('Please enter Fee Amount.');
			$('#feeamt').focus();
		   return false;
		   }
		   else{
		   $.ajax({
                url:'ajax_calls.php',
                type:'POST',
                data:'savefee_struct='+cls_struct+'&fee_names='+feename+'&fee_amt='+feeamt+'&flag='+flg,
				success: function(response){
					
					//$('.statusMsg').html('<span style="color:green;">Error in fee name '+response+'</p>');
					
              //  if(response == 1){
					//$('.statusMsg').html('<span style="color:green;">Fee Name Edited</p>');
					
					//var Table = document.getElementById("feetable");
					//Table.innerHTML = "";
					 //location.reload();
					$('#ClassFeeModal').modal('hide');
					document.getElementById("feetbls").innerHTML ="";
					document.getElementById("feetbls").innerHTML =response;
				//} 
				//else{
			//	//	$('.statusMsg').html('<span style="color:green;">Error in fee name editing</p>');
			//	}
            }
    	});
		
		
		
		}
	}
	
	
	function AddClassFeeName(){
    
           var fee_id = document.getElementById('feeid').value;
		   
		   var feeamt = document.getElementById('feeamt').value;
		   var feename=document.getElementById("feename").value;
		   var flg=0;
		   if(feeamt.trim() == '' ){
					alert('Please enter Fee Amount.');
			$('#feeamt').focus();
		   return false;
		   }
		   else{
		   $.ajax({
                url:'ajax_calls.php',
                type:'POST',
                data:'addfee_struct='+fee_id+'&fee_names='+feename+'&fee_amt='+feeamt+'&flag='+flg,
				success: function(response){
					$('#ClassFeeModal').modal('hide');
					document.getElementById("feetbls").innerHTML ="";
					document.getElementById("feetbls").innerHTML =response;
				
										}
	      		 });
				}
            }
            

                var m4=1;
            function monthchgedrp(monvalue){
                var m1=document.getElementById("month1").value;
                var m2=(monvalue.value)-m1;
                 m4=m2+1;
                var i; 
                //var p2=1;
                //var tk="";
                //var rows = document.getElementById("table1").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
                for (i = 1; i <= rows_count; i++){
                    //tk="rows["+p2+"][month]";
                    //alert(tk);
                    if(document.getElementById('tamt'+i+'0'))
                    {document.getElementById('tamt'+i+'0').value=m4;
                    document.getElementById('tamt'+i+'0').max=m4;
                    }
                }

				var t1,t2,t3;				
                for (i = 1; i <=rows_count; i++){
                    if (document.getElementById('tamt'+i)){
                    t1=document.getElementById('tamt'+i).value;
             		t2=document.getElementById('tamt'+i+'0').value;
                	t3=t1*t2;
                    document.getElementById('tamt'+i+'1').value=t3;
                    }
				}
                
            }

            function addfeerows()
            {
                var fee_id=1;
                
                $.ajax({
                    url:'ajax_calls.php',
                    type:'POST',
                    data:'addfeerow='+fee_id,
                    success: function(response){
                        var tables=document.getElementById("table1");
                        var newRow = tables.insertRow(-1);
                        var newCell = newRow.insertCell(0);
                        rows_count++;
                        newCell.innerHTML = '<button id="delbtn'+rows_count+'" type="button" onClick="delfeecol(this);" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>';
                        newCell = newRow.insertCell(1);
                        newCell.innerHTML ='<select style="width:150px;" name="rows['+rows_count+'][feename]" class="form-control  select2">'+response+'</select>'; 
                        newCell = newRow.insertCell(2);
                        newCell.innerHTML ='<div class="input-group spinner"><span class="input-group-btn"><button class="btn btn-default" data-dir="dwn" id="dnbtn'+rows_count+'" type="button" ><span class="fa fa-minus"></span></button></span><input type="number" class="form-control text-center" value="1"  min="1" max="'+m4+'"  value="'+m4+'"  name="rows['+rows_count+'][month]" readonly id="tamt'+rows_count+'0"> <span class="input-group-btn"><button class="btn btn-default" data-dir="up" id="upbtn'+rows_count+'"  type="button"><span class="fa fa-plus"></span></button> </span></div>';
                        newCell = newRow.insertCell(3);
                        newCell.innerHTML ='<input type="text"  value="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="rows['+rows_count+'][amount]"  id="tamt'+rows_count+'" onblur="multiply(this);" /> ';
                        newCell = newRow.insertCell(4);
                        newCell.innerHTML ='<input type="text"  value="0"  style="font-weight:bold" readonly class="form-control" name="rows['+rows_count+'][tamount]" id="tamt'+rows_count+'1"/>';
                        
                        
                        
                        }
                       });  
            }

            function multiply(el)
            {
                var elm=el.id;
                var t1=document.getElementById(elm).value;
                var t2=document.getElementById(elm+'0').value;
                var t3=t1*t2;
                document.getElementById(elm+'1').value=t3;
            }


            function delfeecol(el)
            {
                $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(800,function(){
                    $(this).remove();
                });    

            }
            
            function altermonthdrp(el)
            {
                var values = el.options[el.selectedIndex].value;
                if(values ==0)
                document.getElementById("addnew").style.display = "none";
                else
                document.getElementById("addnew").style.display = "block";
                $.ajax({
                    url:'ajax_calls.php',
                    type:'POST',
                    data:'showcolfess='+values,
                    success: function(response){
                        document.getElementById("tablebody").innerHTML =response;
                        
						
						//document.getElementById("paidby").value="A";
						//document.getElementById("paidname").value;
                        //rows_count = document.getElementById("table1").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
                    }
                });        
                

            }

            function alteraddrow()
            {
                var fee_id=1;
                var rows_count=document.getElementById("table1").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
                $.ajax({
                    url:'ajax_calls.php',
                    type:'POST',
                    data:'addfeerow='+fee_id,
                    success: function(response){
                        var tables=document.getElementById("table1");
                        var newRow = tables.insertRow(-1);
                        var newCell = newRow.insertCell(0);
                        rows_count++;
                        newCell.innerHTML = '<button id="delbtn'+rows_count+'" type="button" onClick="delfeecol(this);" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>';
                        newCell = newRow.insertCell(1);
                        newCell.innerHTML ='<select name="rows['+rows_count+'][feename]" class="form-control  select2">'+response+'</select>'; 
                        newCell = newRow.insertCell(2);
                        newCell.innerHTML ='<input type="text"  class="form-control" name="rows['+rows_count+'][amount]"  " /> ';
                    }
                });
            }


       
		
		
		