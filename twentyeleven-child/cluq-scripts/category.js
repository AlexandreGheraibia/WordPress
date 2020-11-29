/*var pageX;
var pageY;
var acc = document.getElementsByClassName("cat-item");
var click=false;
var i,j;
for (i = 0; i < acc.length; i++) {
	acc2=acc[i].getElementsByClassName("children");
	for(j=0; j < acc2.length; j++){
		acc2[j].addEventListener("mousemove", function(e) {
			acc3=this.getElementsByClassName("children");
			if(acc3!=null){
				 if(Math.abs(pageY-e.pageY)<2&& e.pageX-pageX>5){
						$jQ(acc3).css('left',e.pageX-400);
						
						
				 }
				 else{
					 
					 if(Math.abs(pageY-e.pageY)>6|| (e.pageX-pageX)<0)
						$jQ(acc3).css('left',350);
					 
				 }
			
			}
			pageX=e.pageX;
			pageY=e.pageY;
		});
	}
 }
*/
if (/Mobi/.test(navigator.userAgent)) {
    var cat = document.getElementById("categories-3");
	anchs=cat.getElementsByTagName("a");
	var j;
		for(j=0; j < anchs.length; j++){
				var pN=anchs[j].parentNode;	
				if(pN.getElementsByClassName("children").length>0)
					anchs[j].removeAttribute("href");
	
		}
}
