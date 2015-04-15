<?php 


$data = json_decode($_POST['data']);

class Game {

private $previousX;
private $previousY;
private $nextX;
private $nextY;


public function __construct($a1,$a2,$a3,$a4)
		{
			$this->previousX = $a1;
			$this->previousY = $a2;
			$this->nextX = $a3;
			$this->nextY = $a4;
		}


public function diagonalMove($d)	
{	
	global $data;
	$x = $this->nextX;
	$y = $this->nextY;
	
	$i = 0;
	$j = 0;
	$boolW = false;
	$boolR = false;
	$boolKingWhite = false;
	$boolKingRed = false;

	if(abs($this->previousX - $x) != abs($this->previousY - $y) ) return false;
	else
	{	
		if($d[$this->previousX][$this->previousY] > 0)
		{
			for($i = 0;$i<8;$i++)
		    {
				for($j = 0;$j<8;$j++)
					{
						if(($d[$i][$j] > 0) && (($this->previousX != $i) || ($this->previousY != $j)))
						{
							if($this->hasTaking($d,$i,$j)) $boolW = true;
							if(    $d[$i][$j] == 2 &&    
									  ($this->upRightWay($data,$i,$j)[0] 
									|| $this->upLeftWay($data,$i,$j)[0]
									|| $this->downRightWay($data,$i,$j)[0]
									|| $this->downLeftWay($data,$i,$j)[0])
							  ) $boolKingWhite = true;
						}
					}
		    }
		}
	
		if($d[$this->previousX][$this->previousY] < 0)
		{
			for($i = 0;$i<8;$i++)
		    {
				for($j = 0;$j<8;$j++)
					{
						if(($d[$i][$j] < 0) && (($this->previousX != $i) || ($this->previousY != $j)))
						{
							if($this->hasTaking($d,$i,$j)) $boolR = true;
							if($d[$i][$j] == -2 &&    
									  ($this->upRightWay($data,$i,$j)[0] 
									|| $this->upLeftWay($data,$i,$j)[0]
									|| $this->downRightWay($data,$i,$j)[0]
									|| $this->downLeftWay($data,$i,$j)[0])
							  ) $boolKingRed = true;	
						}
					}
		    }
		}
	
	
	 if(abs($d[$this->previousX][$this->previousY]) == 2)
	 {
		if($d[$this->previousX][$this->previousY] == 2)
		{
			if(    !$this->upRightWay($data,$this->previousX,$this->previousY)[0] 
				&& !$this->upLeftWay($data,$this->previousX,$this->previousY)[0]
				&& !$this->downRightWay($data,$this->previousX,$this->previousY)[0]
				&& !$this->downLeftWay($data,$this->previousX,$this->previousY)[0]
				&& $boolKingWhite == false
				&& $boolW == false
			  )
			{
				if(    multidimensional_search($this->upRightWay($data,$this->previousX,$this->previousY),array($x,$y))
					|| multidimensional_search($this->upLeftWay($data,$this->previousX,$this->previousY),array($x,$y))
					|| multidimensional_search($this->downRightWay($data,$this->previousX,$this->previousY),array($x,$y))
					|| multidimensional_search($this->downLeftWay($data,$this->previousX,$this->previousY),array($x,$y))
				  ) return true;
	
				else return false;  	
			}
		}
	
		if($d[$this->previousX][$this->previousY] == -2)
		{
			if(    !$this->upRightWay($data,$this->previousX,$this->previousY)[0] 
				&& !$this->upLeftWay($data,$this->previousX,$this->previousY)[0]
				&& !$this->downRightWay($data,$this->previousX,$this->previousY)[0]
				&& !$this->downLeftWay($data,$this->previousX,$this->previousY)[0]
				&& $boolKingRed == false
				&& $boolR == false
			  )
			{
				if(    multidimensional_search($this->upRightWay($data,$this->previousX,$this->previousY),array($x,$y))
					|| multidimensional_search($this->upLeftWay($data,$this->previousX,$this->previousY),array($x,$y))
					|| multidimensional_search($this->downRightWay($data,$this->previousX,$this->previousY),array($x,$y))
					|| multidimensional_search($this->downLeftWay($data,$this->previousX,$this->previousY),array($x,$y))
				  ) return true;
	
				else return false;  	
			}
		}
	
			if(    $this->upRightWay($data,$this->previousX,$this->previousY)[0] 
				&& multidimensional_search($this->upRightWay($data,$this->previousX,$this->previousY),array($x,$y))) 
			{
				
				return true;
			}
				   
	
				   
			
			
	
			else if($this->upLeftWay($data,$this->previousX,$this->previousY)[0] 
				&& multidimensional_search($this->upLeftWay($data,$this->previousX,$this->previousY),array($x,$y))) 
				   {
						
						return true;
					}
			 	
			
			else if(    $this->downRightWay($data,$this->previousX,$this->previousY)[0] 
				&& multidimensional_search($this->downRightWay($data,$this->previousX,$this->previousY),array($x,$y))) 
				   {
						
						return true;
					}
			
			
	
			else if(    $this->downLeftWay($data,$this->previousX,$this->previousY)[0] 
				&& multidimensional_search($this->downLeftWay($data,$this->previousX,$this->previousY),array($x,$y))) 
				   {
						
						return true;
					}
			
			else return false;
	 }
	
		
	
		
	
		
	
	
	
		if($d[$this->previousX][$this->previousY] == 1 && !$this->hasTaking($d,$this->previousX,$this->previousY) && $boolW == false && $boolKingWhite == false)
		{
			if(($this->previousX - $this->nextX != 1) || (abs($this->previousY - $this->nextY) != 1))
			return false;
			else return true;
		}
	
		if($d[$this->previousX][$this->previousY] == 1 && $this->hasTaking($d,$this->previousX,$this->previousY))
		{
			if(($this->previousX - $this->nextX != 2) || (abs($this->previousY - $this->nextY) != 2))
			return false;
	
			else 
			{
				
				return true;
			}
		}
	
		
	
		if($d[$this->previousX][$this->previousY] == -1 && !$this->hasTaking($d,$this->previousX,$this->previousY) && $boolR == false && $boolKingRed == false)
		{
			if(($this->previousX - $this->nextX != -1) || (abs($this->previousY - $this->nextY) != 1))
			return false;
			else return true;
		}
	
	
		if($d[$this->previousX][$this->previousY] == -1 && $this->hasTaking($d,$this->previousX,$this->previousY))
		{
			if(($this->previousX - $this->nextX != -2) || (abs($this->previousY - $this->nextY) != 2))
			return false;
			else 
			{
				
				return true;
			}
		}
	}
}
			
public function differentBlock(){
	if(($this->previousX == $this->nextX)&&($this->previousY == $this->nextY))
			return false;
	else 
			return true;

			}

public function previousBlockNotNull($d){
	if($d[$this->previousX][$this->previousY]==0) return false;
	else return true; 
		}

public function nextBlockNull($d){
	if($d[$this->nextX][$this->nextY]!=0) return false;
	else return true; 
}

public function turnWhiteIntoKing($d){
	if(($d[$this->previousX][$this->previousY] == 1) && ($this->nextX == 0))
		{
			return true;
					
		}
	else{
		return false;
		}
}

public function turnRedIntoKing($d){
	if(($d[$this->previousX][$this->previousY] == -1) && ($this->nextX == 7))
		{
			return true;
					
		}
	else{
		return false;
		}
}



public function hasTaking($d,$x,$y){



	if($d[$x][$y] == 1)

	{	
		if($x<=1) return false;

		else{
		
				if($y<=1)
				{
					if(($d[$x-1][$y+1] < 0) && ($d[$x-2][$y+2] == 0)) return true;
				}
		
				else if($y>=6)
				{
					if(($d[$x-1][$y-1] < 0) && ($d[$x-2][$y-2] == 0)) return true;
				}
				else{
						if(($d[$x-1][$y-1] < 0) && ($d[$x-2][$y-2] == 0)) return true;
				
						if(($d[$x-1][$y+1] < 0) && ($d[$x-2][$y+2] == 0)) return true;
					}
			}

		return false;
	}


	if($d[$x][$y] == -1)
	{
		
		if($x>=6) return false;

		else{	
				if($y<=1)
				{
					if(($d[$x+1][$y+1] > 0) && ($d[$x+2][$y+2] == 0)) return true;
				}
		
				else if($y>=6)
				{
					if(($d[$x+1][$y-1] > 0) && ($d[$x+2][$y-2] == 0)) return true;
				}
				else{
				
						if(($d[$x+1][$y-1] > 0) && ($d[$x+2][$y-2] == 0)) return true;
						 
						if(($d[$x+1][$y+1] > 0) && ($d[$x+2][$y+2] == 0)) return true;
					}
			}
			return false;
	}
}





public function upRightWay($d,$x,$y)
{
	$i = 0;
	$way = array();
	$count = 0;
	$way[0] = false;

		if($d[$x][$y] > 0)
		{
			for($i=1;(($x-$i)>=0 && ($y+$i)<=7);$i++)
			{	
				if($d[$x-$i][$y+$i] > 0) break;

				else if($d[$x-$i][$y+$i] < 0 && $count == 0)
				{	
					$count = 1;
					if($x-$i>0 && $y+$i<7)
					{
					 	if($d[$x-$i-1][$y+$i+1] == 0) 
						{
									 		$way = array();
									 		$way[0] = true;
									 		
									 		
						}
					}
				 
				}
				else if($d[$x-$i][$y+$i] < 0 && $count == 1)	break; 

				if($d[$x-$i][$y+$i] == 0) $way[$i] = [$x-$i,$y+$i];
			}
		}

		if($d[$x][$y] < 0)
		{
			for($i=1;(($x-$i)>=0 && ($y+$i)<=7);$i++)
			{	
				if($d[$x-$i][$y+$i] < 0) break;

				else if($d[$x-$i][$y+$i] > 0 && $count == 0)
				{	
					$count = 1;
					if($x-$i>0 && $y+$i<7){
									 	if($d[$x-$i-1][$y+$i+1] == 0) 
									 	{
									 		$way = array();
									 		$way[0] = true;
									 		
									 		
									 	}}
				
				 	
				}
				else if($d[$x-$i][$y+$i] > 0 && $count == 1) break;

				if($d[$x-$i][$y+$i] == 0) $way[$i] = [$x-$i,$y+$i];
			}
		}
	
		

	return $way;
}

public function upLeftWay($d,$x,$y)
{
	$i = 0;
	$way = array();
	$count = 0;
	$way[0] = false;

		if($d[$x][$y] > 0)
		{
			for($i=1;(($x-$i)>=0 && ($y-$i)>=0);$i++)
			{	
				if($d[$x-$i][$y-$i] > 0) break;

				else if($d[$x-$i][$y-$i] < 0 && $count == 0)
				{	
					
					$count = 1;
					if($x-$i>0 && $y-$i>0){
									 	if($d[$x-$i-1][$y-$i-1] == 0) 
									 	{
									 		$way = array();
									 		$way[0] = true;
									 		
									 		
									 	}}
				
				}
				else if($d[$x-$i][$y-$i] < 0 && $count == 1) break;	

				if($d[$x-$i][$y-$i] == 0) $way[$i] = [$x-$i,$y-$i];
			}
		}

		if($d[$x][$y] < 0)
		{
			for($i=1;(($x-$i)>=0 && ($y-$i)>=0);$i++)
			{	
				if($d[$x-$i][$y-$i] < 0) break;

				else if($d[$x-$i][$y-$i] > 0 && $count == 0)
				{	
					
					$count = 1;
					if($x-$i>0 && $y-$i>0){
									 	if($d[$x-$i-1][$y-$i-1] == 0) 
									 	{
									 		$way = array();
									 		$way[0] = true;
									 		
									 		
									 	}}
				 	
				}
				else if($d[$x-$i][$y-$i] > 0 && $count == 1) break; 

				if($d[$x-$i][$y-$i] == 0) $way[$i] = [$x-$i,$y-$i];
			}
		}
	
		

	return $way;
}


public function downRightWay($d,$x,$y)
{
	$i = 0;
	$way = array();
	$count = 0;
	$way[0] = false;

		if($d[$x][$y] > 0)
		{
			for($i=1;(($x+$i)<=7 && ($y+$i)<=7);$i++)
			{	
				if($d[$x+$i][$y+$i] > 0) break;

				else if($d[$x+$i][$y+$i] < 0 && $count == 0)
				{	
					
					$count = 1;
					if($x+$i<7 && $y+$i<7){
									 	if($d[$x+$i+1][$y+$i+1] == 0) 
									 	{
									 		$way = array();
									 		$way[0] = true;
									 		
									 		
									 	}}
				 	
				}
				else if($d[$x+$i][$y+$i] < 0 && $count == 1) break;

				if($d[$x+$i][$y+$i] == 0) $way[$i] = [$x+$i,$y+$i];
			}
		}

		if($d[$x][$y] < 0)
		{
			for($i=1;(($x+$i)<=7 && ($y+$i)<=7);$i++)
			{	
				if($d[$x+$i][$y+$i] < 0) break;

				else if($d[$x+$i][$y+$i] > 0 && $count == 0)
				{	
					
					$count = 1;
					if($x+$i<7 && $y+$i<7){
									 	if($d[$x+$i+1][$y+$i+1] == 0) 
									 	{
									 		$way = array();
									 		$way[0] = true;
									 		
									 		
									 	}}
				 	
				}
				else if($d[$x+$i][$y+$i] > 0 && $count == 1) break;

				if($d[$x+$i][$y+$i] == 0) $way[$i] = [$x+$i,$y+$i];
			}
		}
	
		

	return $way;
}


public function downLeftWay($d,$x,$y)
{
	$i = 0;
	$way = array();
	$count = 0;
	$way[0] = false;

		if($d[$x][$y] > 0)
		{
			for($i=1;(($x+$i)<=7 && ($y-$i)>=0);$i++)
			{	
				if($d[$x+$i][$y-$i] > 0) break;

				else if($d[$x+$i][$y-$i] < 0 && $count == 0)
				{	
					
					$count = 1;
					if($x+$i<7 && $y-$i>0){
									 	if($d[$x+$i+1][$y-$i-1] == 0) 
									 	{
									 		$way = array();
									 		$way[0] = true;
									 		
									 		
									 	}}
				 	
				}
				else if($d[$x+$i][$y-$i] < 0 && $count == 1) break;

				if($d[$x+$i][$y-$i] == 0) $way[$i] = [$x+$i,$y-$i];
			}
		}

		if($d[$x][$y] < 0)
		{
			for($i=1;(($x+$i)<=7 && ($y-$i)>=0);$i++)
			{	
				if($d[$x+$i][$y-$i] < 0) break;

				else if($d[$x+$i][$y-$i] > 0 && $count == 0)
				{	
					
					$count = 1;
					if($x+$i<7 && $y-$i>0){
									 	if($d[$x+$i+1][$y-$i-1] == 0) 
									 	{
									 		$way = array();
									 		$way[0] = true;
									 		
									 		
									 	}}
				 	
				}
				else if($d[$x+$i][$y-$i] > 0 && $count == 1) break;

				if($d[$x+$i][$y-$i] == 0) $way[$i] = [$x+$i,$y-$i];
			}
		}
	
		

	return $way;
}

public function kingHasTaking($d,$x,$y)
{
	if(		$this->upRightWay($d,$x,$y)[0] 
		|| $this->upLeftWay($d,$x,$y)[0]
		|| $this->downRightWay($d,$x,$y)[0]
		|| $this->downLeftWay($d,$x,$y)[0]) return true;
	else return false;
}

public function firstPion($array)
{	$i = 0;
	for($i=0;$i<count($array);$i++)
		{
			if($array[$i] != 0)
			{
				return $i;
			}	
		}
	return $i;	
}
	


public function isFull($d,$x,$y)
{
	if($d[$x][$y] != 0) return true;
	
	else return false; 
}



public function okToMove($data){
	if(  	$this->diagonalMove($data)
		 && $this->differentBlock()
		 && $this->previousBlockNotNull($data)
		 && $this->nextBlockNull($data)
		) return true;

	else return false;


}


			}

function multidimensional_search($parents, $searched) {
  if (empty($searched) || empty($parents)) {
    return false;
  }

  foreach ($parents as $key => $value) {
    $exists = true;
    foreach ($searched as $skey => $svalue) {
      $exists = ($exists && IsSet($parents[$key][$skey]) && $parents[$key][$skey] == $svalue);
    }
    if($exists){ return true; }
  }

  return false;
} 

$jeu = new Game($data[8][0],$data[8][1],$data[8][2],$data[8][3]); 

if($jeu->okToMove($data)){


  
	$turn = false;
 	

 	if($jeu->hasTaking($data,$data[8][0],$data[8][1]) 
 		       
 		       || ( abs($data[$data[8][0]][$data[8][1]]) == 2
 		       	     && $jeu->kingHasTaking($data,$data[8][0],$data[8][1])
					    
				  ) 
							   
	  ) 
 	{
 		$turn = true;
 	}

 	if($data[$data[8][0]][$data[8][1]] == 1 && $jeu->hasTaking($data,$data[8][0],$data[8][1]))
		{
			 
			
				if($data[8][1] - $data[8][3] == -2) $data[$data[8][0]-1][$data[8][1] + 1] = 0;
				else if($data[8][1] - $data[8][3] == 2) $data[$data[8][0]-1][$data[8][1] - 1] = 0;
	
				
		}
	
if($data[$data[8][0]][$data[8][1]] == -1 && $jeu->hasTaking($data,$data[8][0],$data[8][1]))
		{
			
				if($data[8][1] - $data[8][3] == -2) $data[$data[8][0]+ 1][$data[8][1] + 1] = 0;
				else if($data[8][1] - $data[8][3] == 2) $data[$data[8][0]+ 1][$data[8][1] - 1] = 0;
	
				
		}
		if(abs($data[$data[8][0]][$data[8][1]]) == 2)
		{
 	if(    $jeu->upRightWay($data,$data[8][0],$data[8][1])[0] 
				&& multidimensional_search($jeu->upRightWay($data,$data[8][0],$data[8][1]),array($data[8][2],$data[8][3]))) 
			{
				for($i=1;$i<($data[8][0] - $data[8][2]) ;$i++) $data[$data[8][0] -$i][$data[8][1] +$i] = 0;
				
			}
				   
	
				   
			
			
	
			else if($jeu->upLeftWay($data,$data[8][0],$data[8][1])[0] 
				&& multidimensional_search($jeu->upLeftWay($data,$data[8][0],$data[8][1]),array($data[8][2],$data[8][3]))) 
				   {
						for($i=1;$i<($data[8][0] - $data[8][2]) ;$i++) $data[$data[8][0] -$i][$data[8][1] -$i] = 0;
						
					}
			 	
			
			else if(    $jeu->downRightWay($data,$data[8][0],$data[8][1])[0] 
				&& multidimensional_search($jeu->downRightWay($data,$data[8][0],$data[8][1]),array($data[8][2],$data[8][3]))) 
				   {
						for($i=1;$i<($data[8][2] -$data[8][0]) ;$i++) $data[$data[8][0] +$i][$data[8][1] +$i] = 0;
						
					}
			
			
	
			else if(    $jeu->downLeftWay($data,$data[8][0],$data[8][1])[0] 
				&& multidimensional_search($jeu->downLeftWay($data,$data[8][0],$data[8][1]),array($data[8][2],$data[8][3]))) 
				   {
						for($i=1;$i<($data[8][2] - $data[8][0]) ;$i++) $data[$data[8][0] +$i][$data[8][1] -$i] = 0;
						
					}
			}
 	$data[$data[8][2]][$data[8][3]] = $data[$data[8][0]][$data[8][1]];
	if($jeu->turnRedIntoKing($data)) $data[$data[8][2]][$data[8][3]] = -2;
	if($jeu->turnWhiteIntoKing($data)) $data[$data[8][2]][$data[8][3]] = 2;
	$data[$data[8][0]][$data[8][1]] = 0;

	
 	if(!$turn || 
		!($jeu->hasTaking($data,$data[8][2],$data[8][3]) 
 		       
 		       || ( abs($data[$data[8][2]][$data[8][3]]) == 2
 		       	     && (
 		       	     	$jeu->upRightWay($data,$data[8][2],$data[8][3])[0] 
					 || $jeu->upLeftWay($data,$data[8][2],$data[8][3])[0]
					 || $jeu->downRightWay($data,$data[8][2],$data[8][3])[0]
					 || $jeu->downLeftWay($data,$data[8][2],$data[8][3])[0]
					    )
				  )))
 	{
 		if($data[8][4] == 1) $data[8][4] = -1;
 		else $data[8][4] = 1;
 	}
 	
 						}
 echo json_encode($data);
?>