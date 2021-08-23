

var rows_count=0;

function Calc2()
{
	document.getElementById('calculate_div').style.display ='block';
	
	var ut1=0;
	var ut2=0;
	var act1=0;
	var act2=0; 
	var int1=0;
	var int2=0;
	var sa1=0;
	var sa2=0;
	var total=0;
	var marksobtain=0;
	for(i=1;i<=rows_count;i++)
	{
		ut1=document.getElementById('ut1_'+i).value;
		if(!ut1  || document.getElementById('ut1_'+i).value=='Ab'){
			ut1=0;
			document.getElementById('ut1_'+i).value='Ab';
		}
		ut2=document.getElementById('ut2_'+i).value;
		if(!ut2  || document.getElementById('ut2_'+i).value=='Ab'){
			ut2=0;
			document.getElementById('ut2_'+i).value='Ab';
		}

		act1=document.getElementById('act1_'+i).value;   
		if(!act1  || document.getElementById('act1_'+i).value=='Ab'){
		act1=0;
		document.getElementById('act1_'+i).value='Ab';
		}
		act2=document.getElementById('act2_'+i).value;   
		if(!act2  || document.getElementById('act2_'+i).value=='Ab'){
		act2=0;
		document.getElementById('act2_'+i).value='Ab';
		}



		sa1=document.getElementById('sa1_'+i).value;
		if(!sa1  ||  document.getElementById('sa1_'+i).value=='Ab'){
		sa1=0; 
		document.getElementById('sa1_'+i).value='Ab';
		}
		sa2=document.getElementById('sa2_'+i).value;
		if(!sa2  ||  document.getElementById('sa2_'+i).value=='Ab'){
		sa2=0; 
		document.getElementById('sa2_'+i).value='Ab';
		}


		int1=document.getElementById('int1_'+i).value; 
		if(!int1 || document.getElementById('int1_'+i).value=='Ab'){
		int1=0;
		document.getElementById('int1_'+i).value='Ab'; 
		}
		int2=document.getElementById('int2_'+i).value; 
		if(!int2 || document.getElementById('int2_'+i).value=='Ab'){
		int2=0;
		document.getElementById('int2_'+i).value='Ab'; 
		}


		total=parseFloat(ut1)+parseFloat(ut2)+parseFloat(act1)+parseFloat(act2)+parseFloat(sa1)+parseFloat(sa2)+parseFloat(int1)+parseFloat(int2);
		marksobtain = marksobtain + total;
		document.getElementById('total_'+i).value=total;
		var gradedrop=document.getElementById('grade_'+i);
		
		if(total >180)
		gradedrop.selectedIndex=0;
		else if(total>160 && total <181)
		gradedrop.selectedIndex=1;
		else if(total>140 && total <161)
		gradedrop.selectedIndex=2;
		else if(total>120 && total <141)
		gradedrop.selectedIndex=3;
		else if(total>100 && total <121)
		gradedrop.selectedIndex=4;
		else if(total>80 && total <101)
		gradedrop.selectedIndex=5;
		else if(total>60 && total <81)
		gradedrop.selectedIndex=6;
		else if(total>40 && total <61)
		gradedrop.selectedIndex=7;
		else if(total <41)
		gradedrop.selectedIndex=8;

		


	}
	document.getElementById('txtmarksobtain').value=marksobtain; 
	document.getElementById('txtmaxmarks').value=rows_count*200;
	percent();



}


function percent()
{
var obtain=document.getElementById('txtmarksobtain').value;
var maxmarks=document.getElementById('txtmaxmarks').value;
document.getElementById('txtpercent').value=(obtain/maxmarks)*100;
var percentage=(obtain/maxmarks)*100;
var result = document.getElementById('selectresult');
if(percentage > 33)
	result.selectedIndex=0;
else
	result.selectedIndex=1;



}

function Calc()
{
	document.getElementById('calculate_div').style.display ='block';
	var i=0;
	var ut1=0;
	
	var act1=0;
	
	var int1=0;
	
	var sa1=0;
	
	var total=0;
	var marksobtain=0;

	if(rows_count == 0)
	rows_count=document.getElementById('no_of_rows').value;     

	//alert(rows_count);   
	//if(el.options[el.selectedIndex].value ==1)
	for(i=1;i<=rows_count;i++)
	{
		ut1=document.getElementById('ut1_'+i).value;
		if(!ut1  || document.getElementById('ut1_'+i).value=='Ab'){
			ut1=0;
			document.getElementById('ut1_'+i).value='Ab';
		}
		act1=document.getElementById('act1_'+i).value;   
		if(!act1  || document.getElementById('act1_'+i).value=='Ab'){
		act1=0;
		document.getElementById('act1_'+i).value='Ab';
		}
		sa1=document.getElementById('sa1_'+i).value;
		if(!sa1  ||  document.getElementById('sa1_'+i).value=='Ab'){
		sa1=0; 
		document.getElementById('sa1_'+i).value='Ab';
		}
		int1=document.getElementById('int1_'+i).value; 
		if(!int1 || document.getElementById('int1_'+i).value=='Ab'){
		int1=0;
		document.getElementById('int1_'+i).value='Ab'; 
		}
		total=parseFloat(ut1)+parseFloat(act1)+parseFloat(sa1)+parseFloat(int1);
		marksobtain = marksobtain + total;
		document.getElementById('total_'+i).value=total;
		var gradedrop=document.getElementById('grade_'+i);
		if(total >90)
		gradedrop.selectedIndex=0;
		else if(total>80 && total <91)
		gradedrop.selectedIndex=1;
		else if(total>70 && total <81)
		gradedrop.selectedIndex=2;
		else if(total>60 && total <71)
		gradedrop.selectedIndex=3;
		else if(total>50 && total <61)
		gradedrop.selectedIndex=4;
		else if(total>40 && total <51)
		gradedrop.selectedIndex=5;
		else if(total>30 && total <41)
		gradedrop.selectedIndex=6;
		else if(total>20 && total <31)
		gradedrop.selectedIndex=7;
		else if(total <21)
		gradedrop.selectedIndex=8;
	}
	document.getElementById('txtmarksobtain').value=marksobtain; 
	document.getElementById('txtmaxmarks').value=rows_count*100;
	percent();




}


function delsubj(el)
{
      $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(800,function(){
                    $(this).remove();
                });   
				
}





function termchange(el)
{
	document.getElementById("btncalc").onclick ="";
	document.getElementById('calculate_div').style.display ='none';
		var values = el.options[el.selectedIndex].value;
		var stud_id=document.getElementById("namemarksdrp").value

		if(values ==0){
			//document.getElementById("table1").innerHTML="";	
			document.getElementById("MarksSaveBtn").style.display = "none";
		}
		else{
		if(stud_id==0){
			alert("Please select Student");
			document.getElementById("MarksSaveBtn").style.display = "none";
			el.selectedIndex=0;
		}
		else{
			
	$.ajax({
		url:'ajax_calls_marks.php',
		type:'POST',
		data:'term_change='+values+'&student_id='+stud_id,
		success: function(response){
			var drpval = JSON.parse(response);
			if(drpval[0][0]>0)
			{
				el.selectedIndex=0;
				alert("Marks Already present");
				document.getElementById("MarksSaveBtn").style.display = "none";
				//document.getElementById("tablehead").innerHTML=""; 

			}
			else{
		

					rows_count=0;
				if(drpval[0][1]==0){
					document.getElementById("btncalc").style.display ='none';
					alert("Subject not present for this class");
					document.getElementById("MarksSaveBtn").style.display = "none";
					$("#table1").find("tr:gt(0)").remove(); //delete all row except first
					}
					else if(drpval[0][3]==0){
						document.getElementById("btncalc").style.display ='none';
					alert("Insert marks for 1st Term first");
					document.getElementById("MarksSaveBtn").style.display = "none";
					$("#table1").find("tr:gt(0)").remove(); //delete all row except first
					el.selectedIndex=0;
					}
				else{
					document.getElementById("btncalc").style.display ='block';
					if(values ==1){
						document.getElementById("btncalc").onclick =Calc;
						document.getElementById("tablehead").innerHTML="";
						document.getElementById("tablehead").innerHTML="<th>Subject</th><th> UT1</th><th> ACT1</th><th> INT1</th><th> SA1</th><th>Total(100)</th><th> GRADE </th>";
					}
					else{
						document.getElementById("btncalc").onclick =Calc2;
						document.getElementById("tablehead").innerHTML="";
						document.getElementById("tablehead").innerHTML="<th>Subject</th><th> UT1</th><th> ACT1</th><th> INT1</th><th> SA1</th><th> UT2</th><th> ACT2</th><th> INT2</th><th> SA2</th><th>Total(200)</th><th> GRADE </th>";
					}
					document.getElementById("MarksSaveBtn").style.display = "block";
					$("#table1").find("tr:gt(0)").remove(); //delete all row except first
						

						
					for(var i=1;i<= drpval[0][1];i++)
					{
						
						var tables=document.getElementById("table1");
						var newRow = tables.insertRow(-1);
						var newCell = newRow.insertCell(0);
						rows_count++;
						if(values == 1){
						 newCell.innerHTML = drpval[rows_count][1]+'<input type="hidden" name="rows['+rows_count+'][subj]" value="'+drpval[rows_count][0]+'">';
						newCell = newRow.insertCell(1);	
						newCell.innerHTML = '<input type="text" onclick="this.select();" style="width:50px;" id="ut1_'+rows_count+'"    class="form-control  text-center" name="rows['+rows_count+'][ut1]"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" >';
						newCell = newRow.insertCell(2);	
						newCell.innerHTML = '<input type="text" onclick="this.select();" style="width:50px;"  id="act1_'+rows_count+'" class="form-control  text-center" name="rows['+rows_count+'][act1]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
						newCell = newRow.insertCell(3);	
						
						
						newCell.innerHTML ='<input type="text" onclick="this.select();" style="width:50px;" id="int1_'+rows_count+'" class="form-control  text-center" name="rows['+rows_count+'][int1]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
						newCell = newRow.insertCell(4);	
						
						
						newCell.innerHTML = '<input type="text"  onclick="this.select();" style="width:50px;" id="sa1_'+rows_count+'" class="form-control  text-center" name="rows['+rows_count+'][sa1]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';	
						newCell = newRow.insertCell(5);	
						newCell.innerHTML = '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control text-center"  id="total_'+rows_count+'"  name="rows['+rows_count+'][total]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';	
						newCell = newRow.insertCell(6);	
						
						newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option value="A1">A1</option><option value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
						newCell = newRow.insertCell(7);
						}
						else
						{
						newCell.innerHTML = drpval[rows_count][1]+'<input type="hidden" name="rows['+rows_count+'][subj]" value="'+drpval[rows_count][0]+'">';
						newCell = newRow.insertCell(1);	
						newCell.innerHTML = '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" value="'+drpval[rows_count][2]+'"  readonly name="rows1['+rows_count+'][ut1]" id="ut1_'+rows_count+'"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
						newCell = newRow.insertCell(2);	
						newCell.innerHTML = '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" value="'+drpval[rows_count][3]+'"   readonly name="rows1['+rows_count+'][act1]" id="act1_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
						
						newCell = newRow.insertCell(3);
						newCell.innerHTML ='<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" value="'+drpval[rows_count][4]+'"   readonly name="rows1['+rows_count+'][int1]" id="int1_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
						
						newCell = newRow.insertCell(4);	
						newCell.innerHTML = '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" value="'+drpval[rows_count][5]+'"  readonly name="rows1['+rows_count+'][sa1]" id="sa1_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';	
						 
						newCell = newRow.insertCell(5);
						newCell.innerHTML += '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" name="rows['+rows_count+'][ut2]" id="ut2_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';	
						newCell = newRow.insertCell(6);	
						newCell.innerHTML += '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" name="rows['+rows_count+'][act2]" id="act2_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
						
						newCell = newRow.insertCell(7);
						newCell.innerHTML +='<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" name="rows['+rows_count+'][int2]" id="int2_'+rows_count+'"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">';		
						newCell = newRow.insertCell(8);	
						
						newCell.innerHTML += '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" name="rows['+rows_count+'][sa2]" id="sa2_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
						newCell = newRow.insertCell(9);
						newCell.innerHTML += '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" name="rows['+rows_count+'][total]" id="total_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
						newCell = newRow.insertCell(10);


						newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" id="grade_'+rows_count+'" class="form-control  text-center"><option value="A1">A1</option><option value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
						newCell = newRow.insertCell(11);
							

						}

					}
					
					
			
				}





			}
			
		}



		});

		}
	}
			
}


function cgnamemarks(el)
{
	
	var values = el.options[el.selectedIndex].value;
	document.getElementById("btncalc").style.display ='none';
	document.getElementById('calculate_div').style.display ='none';


	$.ajax({
                    url:'ajax_calls_marks.php',
                    type:'POST',
                    data:'marksvalues='+values,
                    success: function(response){
						var drpval = JSON.parse(response);
						//for(var i=0; i<	drpval.length;i++)
                     document.getElementById("regno").innerHTML = drpval[0][4];
					document.getElementById("regno1").value = drpval[0][4];
					document.getElementById("first_name").value = drpval[0][0];
					document.getElementById("father_name").innerHTML = drpval[0][1];
					document.getElementById("father_name1").value = drpval[0][1];
					document.getElementById("mother_name").innerHTML = drpval[0][2];
					document.getElementById("mother_name1").value = drpval[0][2];
					document.getElementById("class_name").innerHTML = drpval[0][3];
					document.getElementById("class_name1").value = drpval[0][3];
					document.getElementById("cs_id").value = drpval[0][5];

					var term = document.getElementById('termdrp');
					term.selectedIndex=0;
					$("#table1").find("tr:gt(0)").remove(); //delete all row except first  
                    }
                });     
				
				
}