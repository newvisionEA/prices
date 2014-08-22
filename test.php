<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

  <title>HTML Treetable - Example 1</title>

  <script type="text/javascript" src="js/treetable.js"></script>

</head>

<body>   

<table id="table1">

    <colgroup>

      <col width="200" />

      <col width="0*"/>

    </colgroup>

    <tr>

      <th>Title</th>

      <th>Population (in millions)</th>

      <th>Area km<sup>2</sup></th>

      <th>People / km<sup>2</sup></th>

    </tr>
<?php
require 'db.php';

// Fetch all the roles
$result = mysql_query("select * from category");
$roles = array();
while( $role = mysql_fetch_assoc($result) ) {
	$roles[] = $role;
//     echo $role['id'];
//     echo $role['name'];
//     echo $role['parent_id'];
}

// Function that builds a tree
function build_tree($roles, $parent_id=0) {
	$tree = array();
	foreach ($roles as $role) {

		if ($role['parent_id'] == $parent_id) {
			//echo $role['name'];
			$tree[] = array(
					'role' => $role,
					'children' => build_tree($roles, $role['id'])
			);
		}
	}

	return $tree;
}

// Function that walks and outputs the tree
function print_tree($tree) {
	if (count($tree) > 0) {
		print("<ul>");
		foreach($tree as $node ) {
			print("<li>");
			print(htmlspecialchars($node['role']['name']));
			print_tree($node['children']);
			print("</li>");
		}
		print("</ul>");
	}
}

// Function that walks and outputs the tree
function print_tree2($tree, $prefix, $spaces) {
	if (count($tree) > 0) {
		$index=0;
		foreach($tree as $node ) {
?>
<tr id="table1<?php echo $prefix?>_<?php echo $index ?>">

<td><?php echo $spaces ?><a href="#" onclick="treetable_toggleRow('table1<?php echo $prefix?>_<?php echo $index ?>');"><?php print(htmlspecialchars($node['role']['name'])); ?></a></td>

<td>454.9</td>

<td>3 976 952</td>

<td>115</td>

</tr>
<?php 
			print_tree2($node['children'], '_'.$index, $spaces.'&nbsp;&nbsp;&nbsp;&nbsp;');
			$index++;
		}

	}
}
$tree = build_tree($roles);
print_tree2($tree, '', '');
?>

</table>
</body>