<?php

//helper function

function redirect($location)
{
	header("LOCATION: $location");
}

function query($sql)
{
	global $connection;
	
	return mysqli_query($connection,$sql);
}

function confirm($result)
{
	global $connection;
	
	if(!$result)
	{
		die("QUERY FAILED" . mysqli_error($connection));
	}
}

function escape_string($string)
{
	global $connection;
	
	return mysqli_real_escape_string($connection,$string);
}


function fetch_array($result)
{
	return mysqli_fetch_array($result);
}

//get products 

 function get_products()
 {
	$result = query("SELECT * FROM products");
	
	confirm($result);
	
	while($row = fetch_array($result))
	{
		$product = <<<DELIMETER

		<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
			<!-- actual image tag -->
			<a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
			<!-- future image tag -->
			<!-- <img src="/resources/...?add={$row['product_id']}" alt=""> -->
			
				<div class="caption">
					<h4 class="pull-right">&#36;{$row['product_price']}</h4>
					<h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h4>
					<p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
					<a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>
				</div>
			</div>
		</div>

DELIMETER;

		echo $product;

	}
	
	
 }












?>