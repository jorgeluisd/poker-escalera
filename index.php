<?php 

class Poker
{ 
	private function getConsecutive($array){
		if (is_array($array) && count($array)) {
	        $newArray = array();
	        $count= array();
		    
		    foreach($array as $pos => $num){
		        if($pos>0){
		            if(($newArray[($pos-1)]+1)==$num){
		                //array_push($newArray, $num);
		                $count[$pos-1] = true;
		            }else{
		                $count[$pos-1] = false;
		            }   
		        }
		        $newArray[$pos] = $num;
		    }

		    //Llena el validador con false para los casos en que sean solo 5 cartas o 6 o 7
		    for ($i=0; $i <= 5; $i++) { 
		    	if (!isset($count[$i])) {
		    		$count[$i] = false;
		    	}
		    }

		    //Revisa las 3 opciones para ser escalera, las 5 primeras posiciones, las 5 del medio o las ultimas 5
		    if ( ($count[0] && $count[1] && $count[2] && $count[3]) || ($count[1] && $count[2] && $count[3] && $count[4]) || ($count[2] && $count[3] && $count[4] && $count[5]) ) {
		    	return 'true => Es una escalera';
		    } 
		}
	    return false;
    }

    public function orderArray($array)
    {
    	// Organiza array de manera descendente
    	if (is_array($array) && count($array)) {
	    	$order = array();
	    	asort($array);
	        foreach ($array as $value) {
	        	array_push($order, $value);
	        }
	        return $order;
    	}
    	return false;
    }

	public function isStraight($cards)
	{
		if(is_array($cards) && count($cards)){
			// Ordena arreglo
            $sortCards = $this->orderArray($cards);
            // Revisa que sea escalera
            $response = $this->getConsecutive($sortCards);

            if (!$response) {
            	// Revisa que el ultimo numero sea 14 para cambiarlo por 1 y consultar de vuelta
            	//Así probamos el AS como 1 o 14
            	$count = count($sortCards);

            	if ($sortCards[$count-1] == 14) {
            		$sortCards[$count-1] = 1;
            		$order = $this->orderArray($sortCards);
            		$response = $this->getConsecutive($order);
            		$response = ($response) ? $response : 'false => No es una escalera';
            	} else {
            		$response = 'false => No es una escalera';
            	}
            }
            return $response;
        } else{
            return false;
        }
	}
}

// CASOS DE PRUEBA
$results = new Poker();

//La funcion valida los casos de prueba siguientes
$results1 = $results->isStraight([2, 3, 4 ,5, 6]);
$results2 = $results->isStraight([14, 5, 4 ,2, 3]); 
$results3 = $results->isStraight([7, 7, 12 ,11, 3, 4, 14]); 
$results4 = $results->isStraight([7, 3, 2]); 

print_r($results1);
echo "<br>";
print_r($results2);
echo "<br>";
print_r($results3);
echo "<br>";
print_r($results4);
echo "<br>";