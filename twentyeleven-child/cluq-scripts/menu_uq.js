var acc = document.getElementsByClassName("uq_menu_accordion");
var list = document.getElementsByClassName("uq_drop_list")[0];
var i;
$jQ(list).change(function() {
   
    var id =this.value;
	var panels =acc[id].getElementsByClassName("uq_menu_panel");
	var container = document.getElementsByClassName("uq_menu_tab")[0];
	while (container.firstChild) { 
		container.removeChild(container.firstChild); 
	}
	for(var j=0;j<panels.length;j++){
		p=panels[j].cloneNode(true);
		container.appendChild(p);
	}
 });
  
