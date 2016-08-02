<?php 


include_once('/ssi/db.php');





//$packageName=$_POST['packageName'];


$packageName=$_POST['packageName'];


if($packageName!=""){


/* echo  '<div class="panel panel-default">';
				      echo '<div class="panel-heading">Panel with panel-default class</div>';
				      echo '<div class="panel-body">Panel Content</div>';
				    echo '</div>';*/
	




			echo '<div class="jumbotron">';





			echo " <div class='panel-group'> ";


				   	
				      
				      
			

			


				$dB=mysqli_query($con,"SELECT * FROM package WHERE package_id='$packageName' ");	
			
			
				while($row0 = mysqli_fetch_array($dB)) {



					$areasForHotelsArray = array();

		echo  '<div class="panel panel-success">';


					echo '<div class="panel-heading">PACKAGE NAME : ';



					echo  $packageName ;



					echo "</div>";




					echo '<div class="panel-body">LOCATION';

					echo "</div>";




					$locationIdForLocation=$row0['location_id'];


					$areasForLocationDetilsArray = array();

					echo '<div class="panel-body">';

						echo "<select>";

						$dB1=mysqli_query($con,"SELECT * FROM location WHERE location_id='$locationIdForLocation' ");	
					
					
						while($row1 = mysqli_fetch_array($dB1)) {




							$areasForLocationDetilsArray[]=$row1['ticket'];
							$areasForLocationDetilsArray[]=$row1['description'];
							$areasForLocationDetilsArray[]=$row1['duration'];













							$areasForHotelsArray[]=$row1['area'];



							echo "<option>";



								echo $row1['name'];




							echo "</option>";







						}

		





						foreach($areasForLocationDetilsArray as $value){


							echo "<br/>";

							echo "<lable>$value</lable>";

							echo "<br/>";


						}



						echo "</select>";


						echo "</div>";


						$arraySize=sizeof($areasForLocationDetilsArray);


						
					

						for ($x = 0; $x < $arraySize; $x+=3) {



							if($areasForLocationDetilsArray[$x]==1){




									$dB3=mysqli_query($con,"SELECT * FROM ticket WHERE location_id='$locationIdForLocation' ");	
					
					
									while($row3 = mysqli_fetch_array($dB3)) {



										$age=$row3['age'];



										if($age==0){


											echo "<br/>";

											echo "<lable>Age :  Adults </lable>";

											echo "<br/>";


										}else{


											echo "<br/>";

											echo "<lable>Kids</lable>";

											echo "<br/>";




										}


										$country=$row3['country'];


										if($country==0){


											echo "<lable>Sri Lankan</lable>";


										}else{



											echo "<lable>Foreign</lable>";


										}

										
										$fee=$row3['fee'];


										

										
										echo "<lable>Fee:  $fee </lable>";


									}





								//tickets


							}

							$a=$areasForLocationDetilsArray[$x+1];
							$b=$areasForLocationDetilsArray[$x+2];

							echo "<br/>";


							echo "<lable>Description $a </lable>";


							echo "<br/>";
							echo "<lable>Duration  $b </lable>";

							echo "<br/>";


							



							



				    


						} 






						echo "<br/>";



							$budget=$row0['package_budget'];


							echo "<br/>";
							echo "<lable>Budget : $budget</lable>";

							echo "<br/>";


						echo "<lable>HOTELS</lable>";


						echo "<br/>";


						$transportTemp=null;


						echo "<select>";


						foreach($areasForHotelsArray as $value){





								$dB2=mysqli_query($con,"SELECT * FROM hotel WHERE area='$value' ");	
							
							
								while($row2 = mysqli_fetch_array($dB2)) {


									if($transportTemp==null){


										$transportTemp=$row2['transport'];
										$hotelIdTemp=$row2['hotel_id'];



									}


									echo "<option>";



										echo $row2['name'];



									echo "</option>";







								}






						}



						echo "</select>";

						echo "<br/>";




						echo '</div>';


						echo "<lable>TRANSPORT</lable>";


						echo "<br/>";


						if($transportTemp==1){


							$dB5=mysqli_query($con,"SELECT * FROM vehicle WHERE id='$hotelIdTemp' ");	
							
							
								while($row5 = mysqli_fetch_array($dB5)) {


									$comfort=$row5['comfort'];
									$model=$row5['model'];
									$passengers=$row5['passengers'];
									$type=$row5['type'];



									echo "<br/>";
									echo "<lable>Comfort : $comfort</lable>";
									echo "<br/>";

									echo "<br/>";
									echo "<lable>Model : $model</lable>";
									echo "<br/>";

									echo "<br/>";
									echo "<lable>Passengers : $passengers</lable>";
									echo "<br/>";

									echo "<br/>";
									echo "<lable>Type : $type</lable>";
									echo "<br/>";



								}


							



						}else{


							echo "<select>";



							$dB6=mysqli_query($con,"SELECT * FROM transport ");	
							
							
								while($row6 = mysqli_fetch_array($dB6)) {


									$address=$row6['address'];
									$contact=$row6['contact'];
									$email=$row6['email'];
									$name=$row6['name'];



									echo "<option>";
									
										echo " Address : ".$address." - Contact : ".$contact." - ".$email." - ".$name;

									echo "</option>";


									echo "<br/>";
									echo "<lable>Address : $address</lable>";
									echo "<br/>";

									echo "<br/>";
									echo "<lable>$contact</lable>";
									echo "<br/>";

									echo "<br/>";
									echo "<lable>$email</lable>";
									echo "<br/>";

									echo "<br/>";
									echo "<lable>Name : $name</lable>";
									echo "<br/>";



								}


								echo "</select>";





						}
						


						








echo '</div>';

				
				
				}
















}




echo "</div>";

echo "</div>";


?>






