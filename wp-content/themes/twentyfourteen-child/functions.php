<?php 

/* remove parent sidebars */
function aquatify_remove_fourteen_sidebars() {
  unregister_sidebar( 'sidebar-1' ); // primary on left
  unregister_sidebar( 'sidebar-2' ); // secondary on right
}
add_action( 'widgets_init', 'aquatify_remove_fourteen_sidebars', 11 );


function fetch_all($query)
{
 $data = array();

 $result = mysql_query($query);
 while($row = mysql_fetch_assoc($result))
 {
  $data[] = $row;
 }
 return $data;
}
 ?>