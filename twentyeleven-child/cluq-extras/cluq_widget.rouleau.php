
<?php

	/*
		widget use for the content menu management
	*/

	//	add the widget to the back office

	add_action( 'widgets_init', 'register_menu_cluq_widget' );
	
	function register_menu_cluq_widget() {
		register_widget( 'menu_cluq_widget' );
	}
	
	//define a class for the widget content
	class menu_cluq_widget extends WP_Widget {
		private $widget_fields = [];
		
		function __construct() {
			parent::__construct(
				'menu-union',
				esc_html__( 'menu des unions', 'textdomain' ),
				array( 'description' => esc_html__( 'Affiche le menu des unions', 'textdomain' ), )
			);
			
			
			$args = array(
				'orderby' => 'name',
				'parent'=> '60', //id of Actualités des Quartiers which is the parent of all Union de quartier
			);
			
			$categories = get_categories($args);
			foreach ($categories as $subCat){
				
				if(strcmp($subCat->cat_name, "Union de Quartier") >0)
				{
					$this->setWidgetFields([
								'label' =>  substr ($subCat->cat_name,17),//suppress union de quartier in all name
								'id' =>  $subCat->cat_ID,
								'on' =>'',
								]);
				}
			}
			
		}
		
	//display the content in the target page
	public function widget( $args, $instance ) {
        echo $args['before_widget'];
		$menuContent='';
      //	$menuContent.='<ul>';
		$tab=[];
        foreach($this->getWidgetFields() as $field){
			
				if(isset($instance[$field['id']])&& $instance[$field['id']]=='on'){
					
				//$menuContent.='<li>'.$field['label'];
					$menuContent='<ul>';
					$subcats = get_categories('child_of=' . $field['id']);
					$tabSubCat=[];
					foreach($subcats as $subcat) {
						//check the 4 categories here
				//		$menuContent.='<li><a href="?uID='.$field['id'].'&sID='.$subcat->cat_ID.'" rel="child category">'.$subcat->cat_name.'</a></li>';
						$menuContent.='<li><a href="?uID='.$field['id'].'&sID='.$subcat->cat_ID.'" rel="child category">'.$subcat->cat_name.'</a></li>';;
					}
				$menuContent.='</ul>';
				//$menuContent.='</li>';
					$tab[]=[$field['label'],$menuContent];
				}
		}
		//$menuContent.='</ul>';
		//; 
		echo '<script> var data_menu='.json_encode($tab).';</script>';	
		echo '<div class="menu_uq">
			<button id="up" onClick="up();">u</button>
			<ul class="polygone">
				
			</ul>
			<button id="down" onClick="down();">d</button>
		</div>';
		echo $args['after_widget'];
		
    }
	//display fields in the back-end
	public function field_generator( $instance ) {
       $output = '';
       foreach ($this->getWidgetFields() as $widget_field ) {
            $isCheckedField = $instance[$widget_field['id']] ;
			$label = $widget_field['label'] ;
					$output .= '<p>';
					$output .= '<input class="checkbox" id="'.$this->get_field_id($widget_field['id']).'" name="'.$this->get_field_name( $widget_field['id']) .'" type="checkbox" '.checked($isCheckedField , 'on' ,false);
                    $output .= '<label for="'.$this->get_field_id( $widget_field['id'] ).'">'.$widget_field['label'].'</label> ';
					$output .= '</p>';
       } 
        echo $output;
	   
    }
	
	public function form( $instance ) {
        $this->field_generator( $instance );
    }
	
    function getWidgetFields(){
		return $this->widget_fields;
	}
	
	function setWidgetFields($elem){
		$this->widget_fields[]=$elem;
	}
	function setWidgetField($key,$value){
		$this->widget_fields[$key]=$value;
	}
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        foreach ( $this->widget_fields as $widget_field ) {
            
                    $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? $new_instance[$widget_field['id']]  : '';
					
        }
        return $instance;
    }
	

}
	
?>