<!--@author Axel DURAND-->
<h2> <strong>  Demander un congé</strong></h2>
<?php echo form_open('Demander_conge/create_conge'); ?>
	<table>		
				<tr>
			<td>
				<label>	<p id="motif"  >Motif </p> </label>
			</td>
			<td>
				<input type="text" name="motif" >	
			</td>
			<br />
			</label>	
		</tr>
		<br />

		<tr>
			<td>
				<label> Debut du congé:	</label>
			</td>
			<td>
				<input type="date" name="conge_debut" id="start" value=""    />	
			</td>
		</tr>
		<br />

		<tr>
			<td>
				<label>	Duree	</label>
			</td>
			<td>
				<input type="number" name="duree" value="" id="temps"   />	
			</td>	
			<td>
				jour(s).
			</td>	
		</tr>
		<br />

		<tr>
			<td>
				<label> Fin du congé:	</label>
			</td>
			<td>
				<input type="date" name="conge_fin" value="" id="end"   />	
			</td>
		</tr>
		<br />


	</table>					
	<input type="submit" value="Demander un congé" name="send" />
<?php echo form_close(); ?>
	<p id="error"></p>
		<script>
			var debut=document.getElementById('start');
			var fin=document.getElementById('end');
			var duree=document.getElementById('temps');
			fin.addEventListener("change",()=>{
				var start=new Date(debut.value);
				var end=new Date(fin.value);
				var lst=new Date(end.getYear(),end.getMonth()+1,0).getDate();
				var mois=end.getMonth()-start.getMonth();
				var calc=end.getDate()-start.getDate()+1+(mois*lst);
				if(calc-1>=25){
					var p=document.getElementById('error');
					p.innerHTML="Vous ne pouvez pas dépasser 25 jours de congés";
				}
				else{
				duree.value=calc;
			}
			});
			//https://www.scriptol.fr/javascript/dates-difference.php
				duree.addEventListener("change",function(){
				var start=new Date(debut.value);
				var toki=duree.value;
				
				if(toki>=25){//fctionne
					var p=document.getElementById('error');
					p.innerHTML="Vous ne pouvez pas dépasser 25 jours de congés";					
				}
				else{//bleme
				var lst=new Date(start.getYear(),start.getMonth()+1,0).getDate();
				var tst=parseInt(toki)+parseInt(start.getDate()-1);
				

				if(tst>lst){
					var dte=new Date(start.getYear(),start.getMonth()+1,toki+start.getDate-lst-1);
				}
				else{
					var dte=new Date(start.getFullYear(),start.getMonth(),tst);
				}
				var year=""+dte.getFullYear();
				var month=""+(dte.getMonth()+1);
				var day=""+dte.getDate();
				if(dte.getMonth()<10){
					fin.value=year+"-0"+month+"-"+day;
				}
				else{
				fin.value=year+"-"+month+"-"+day;
				}
			};
				
				
			});
			
			/*settage des dates*/
			//debut.setDate();//recupere elemnt byid
			//recupere date debut
			//verifier que la duree est rempli 
			//si rempli on la récupère et on calcule la date de fin qu on ajoute 
			//sinon on recupere date de fin et on calcule la durée 
			</script>
			
		
