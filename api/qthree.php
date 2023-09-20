<?php

$connect = new mysqli("localhost","root","","assessment_database");

$columns = array('user_id', 'servicename', 'servicetype', 'transamt', 'chargeamt','req_dt');

$query = "SELECT * FROM assdt_service_consumption_table WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'req_dt BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (user_id LIKE "%'.$_POST["search"]["value"].'%" 
  OR servicename LIKE "%'.$_POST["search"]["value"].'%" 
  OR servicetype LIKE "%'.$_POST["search"]["value"].'%" 
  OR transamt LIKE "%'.$_POST["search"]["value"].'%"
  OR chargeamt LIKE "%'.$_POST["search"]["value"].'%"
  OR req_dt LIKE "%'.$_POST["search"]["value"].'%"
  )
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY user_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["user_id"];
 $sub_array[] = $row["servicename"];
 $sub_array[] = $row["servicetype"];
 $sub_array[] = $row["transamt"];
 $sub_array[] = $row["chargeamt"];
 $sub_array[] = $row["req_dt"];

 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM assdt_service_consumption_table";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);
?>