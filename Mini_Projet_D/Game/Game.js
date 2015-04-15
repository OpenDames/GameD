window.onload = function(){

	 var turn = 1;
	 var clickXPos;
	 var clickYPos;
	 var a= 0;  // indicates how many times user clicked on the board
	 var prevDate;
	 var posX;
	 var posY;
	 var B = 	[
				 [0,-1,0,-1,0,-1,0,-1]
				,[-1,0,-1,0,-1,0,-1,0]
				,[0,-1,0,-1,0,-1,0,-1]
				,[0,0,0,0,0,0,0,0]
				,[0,0,0,0,0,0,0,0]
				,[1,0,1,0,1,0,1,0]
				,[0,1,0,1,0,1,0,1]
				,[1,0,1,0,1,0,1,0]
				,[null,null,null,null,1]
				
			 	]
	 
	 var canvasBoard = document.getElementById("board"); // canvas of the Board
	 var ctxBoard = canvasBoard.getContext("2d");
	 


	 var canvasWRect = document.createElement("canvas"); // canvas of white rect
	 var ctxWRect = canvasWRect.getContext("2d"); 

	 var canvasBRect = document.createElement("canvas"); // canvas of black rect
	 var ctxBRect = canvasBRect.getContext("2d"); 

	 var canvasSelectRect = document.createElement("canvas"); // canvas of the yellow Select rect
	 var ctxSelectRect = canvasSelectRect.getContext("2d"); 

	 var canvasSelect = document.getElementById("select");  
	 var ctxSelect = canvasSelect.getContext("2d");

	 var canvasWPion = document.createElement("canvas");
  	var ctxWPion = canvasWPion.getContext("2d");
	
	var canvasBPion = document.createElement("canvas");
  	var ctxBPion = canvasBPion.getContext("2d");

  	var canvasKing = document.createElement("canvas");
  	var ctxKing = canvasKing.getContext("2d");

  	var image = document.createElement("img");
  	image.src = "Messaging-Crown-icon.png";
    

  	ctxWPion.width = 50;
  	ctxBPion.width = 50;
  	ctxKing.width = 50;
  	
  	ctxBPion.height = 50;
    ctxWPion.height = 50;
    ctxKing.height = 50;
  	
  	ctxWPion.beginPath();
  	ctxBPion.beginPath();
  	
  	
  	ctxWPion.arc(25,25,20,0,2*Math.PI);
  	ctxBPion.arc(25,25,20,0,2*Math.PI);
  	

  	ctxWPion.fillStyle = "#F1F1F1";
  	ctxBPion.fillStyle = "#F10000";
  	ctxKing.drawImage(image, 10, 10);
  	

  	ctxBPion.fill();
  	ctxWPion.fill();
  	
	 
	 

	//indicates the content of an area 
	function isFull(T,x,y){
		return T[x][y];
	}

	

	function draw(){
		var i=0;
		var j=0;
		
		ctxWRect.fillStyle = "#5A76B7";
		ctxWRect.fillRect(0,0,50,50);

		ctxBRect.fillStyle = "#143174";
		ctxBRect.fillRect(0,0,50,50);

		ctxSelectRect.beginPath();
		ctxSelectRect.lineWidth = "4";
		ctxSelectRect.strokeStyle = "yellow";
		ctxSelectRect.rect(3,3,44,44);
		ctxSelectRect.stroke();

		for(i=0;i<8;i++)	{
			ctxBoard.font="20px Georgia";
			for(j=0;j<8;j++)	{

				if((i+j)%2==0) 		{
										ctxBoard.drawImage(canvasWRect,i*50,j*50);
									}
				
				if((i+j)%2==1)  	{
										ctxBoard.drawImage(canvasBRect,i*50,j*50);
									}
								  }}
		canvasSelect.addEventListener('mousemove' , function(evt){
			var date = new Date().getTime();
			if(date - prevDate > 4){
			
		
		var mousePos = getMousePos(canvasSelect,evt);
		var x = mousePos.x - (mousePos.x)%50;
		var y = mousePos.y - (mousePos.y)%50;
		var message = 'Mouse Position in the canvasSelect' + mousePos.x +','+ mousePos.y;
		document.getElementById("coor").innerHTML = message; 
		ctxSelect.drawImage(canvasSelectRect,x,y);
		if((a)>=2) a=0;
		if((a)==0)
		//Clear the previous yellow Rect
		clearExcept(ctxSelect,x,y);

		// if the user aonce the rect is not cleared
		if(a==1){
			clearExcept(ctxSelect,x,y);
			ctxSelect.drawImage(canvasSelectRect,clickXPos,clickYPos);
			}


		
	
}prevDate = date;}, false);

		
		canvasSelect.addEventListener('mousedown' ,move, false);					

		

				
				
			

   }

   //Returns the Mouse position in the canvas (x,y) 
   function getMousePos(canvas,evt){
   	var rect = canvas.getBoundingClientRect();
   	return{
   		x: Math.round(evt.clientX - rect.left),
   		y: Math.round(evt.clientY - rect.top)
   	};

   }

// clear the context except the defined area
function clearExcept(context,x,y){
   var i = 0;
   var j = 0;

   for(i=0;i<8;i++)	{

   	for(j=0;j<8;j++)		{

   		if((i*50 != x) || (j*50 != y))	{	

   		   									context.clearRect(i*50,j*50,50,50);}
   										}
   							}

   						}

  function drawPion(T){
  	

  	for(i=0;i<8;i++){
			
			for(j=0;j<8;j++){

					if(isFull(T,i,j) < 0) 	{	ctxBoard.clearRect(j*50,i*50,50,50);

												if((i+j)%2==0) 	{
																ctxBoard.drawImage(canvasWRect,j*50,i*50);
																}
							
												if((i+j)%2==1)  {
																ctxBoard.drawImage(canvasBRect,j*50,i*50);
																}
												ctxBoard.drawImage(canvasBPion,j*50,i*50);
											}
				
					if(isFull(T,i,j) > 0)  	{	ctxBoard.clearRect(j*50,i*50,50,50);

												if((i+j)%2==0) 	{
																ctxBoard.drawImage(canvasWRect,j*50,i*50);
																}
							
												if((i+j)%2==1)  {
																ctxBoard.drawImage(canvasBRect,j*50,i*50);
																}
												ctxBoard.drawImage(canvasWPion,j*50,i*50);
											}

					if(Math.abs(isFull(T,i,j)) == 2)
											{
												ctxBoard.drawImage(canvasKing,j*50,i*50);
											}
							
					if(isFull(T,i,j) == 0)  	{
												ctxBoard.clearRect(j*50,i*50,50,50);

												if((i+j)%2==0) 	{
																ctxBoard.drawImage(canvasWRect,j*50,i*50);
																}
							
												if((i+j)%2==1)  {
																ctxBoard.drawImage(canvasBRect,j*50,i*50);
																}

											}
							}
						}




  }

function move(evt){
		if(a>=2) a=0;
		a++;
		var mousePos = getMousePos(canvasSelect,evt);
		clickXPos = mousePos.x - (mousePos.x)%50;
		clickYPos = mousePos.y - (mousePos.y)%50;
		
			

		if(a==1){
			B[8][0] =  clickYPos/50;
			B[8][1] =  clickXPos/50;
		}
		
		if(a==2){
			clearExcept(ctxSelect,clickXPos,clickYPos);
			B[8][2] =  clickYPos/50;
			B[8][3] =  clickXPos/50;
		}
		var message = '';

		
		if(a==2){
			if(B[8][4] == 1 && B[B[8][0]][B[8][1]] > 0)
			{
					var jsonString = JSON.stringify(B);
			   		$.ajax	(	{
			        type: "POST",
			        url: "Game.php",
			        data: {data : jsonString}, 
			        cache: false,
			
			        success: function(msg)	{
			        	B = JSON.parse(msg);
			        	drawPion(B);
			        	
						
						if(B[8][4] == -1) message = 'Red Turn';
						document.getElementById("Pos").innerHTML = message;
			        	}
			    				}
			    			);
			}

			else if(B[8][4] == -1 && B[B[8][0]][B[8][1]] < 0)
			{
					var jsonString = JSON.stringify(B);
			   		$.ajax	(	{
			        type: "POST",
			        url: "Game.php",
			        data: {data : jsonString}, 
			        cache: false,
			
			        success: function(msg)	{
			        	B = JSON.parse(msg);
			        	drawPion(B);
			        	
						if(B[8][4] == 1) message = 'White Turn';
						
						document.getElementById("Pos").innerHTML = message;
			        	}
			    				}
			    			);
			   	}
    			}

		  
		

}

	
 
 
   draw();
   drawPion(B);
   } 


 