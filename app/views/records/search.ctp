<div class="search_records">
	<?
	$num = count($results);

	if($num > 0){
	?>
	<div class="searchBox" style="margin: 0 auto; text-align: center;">
		<h1>Find something. <font color="#666666">Anything.</font></h1>
		<p>
			<form action="/records/search" method="post">
			<input type="textbox" class="search-box" value="Search..." name="data[Record][q]" size="20" onClick="this.value=''"> <input type="submit" value="Go!" class="search-go">
			</form>
		</p>
	</div>
	<div class="records_results rounded {5px;}">
		<h1>Found stuff...</h1>
		<ul>
			<?php foreach ($results as $record): ?>
			<li>
				<?php echo $html->link($record['Record']['name']." - ".$record['Record']['short_description'],'/records/view/'.$record['Record']['id']);?>
			</li>
			<? endforeach; ?>
		</ul>
	</div>
	<?
	}else{
		
	?>
		<h1 style="text-align: center;">We were unable to find anything.</h1>
		<div class="redo">
			<div class="searchBox">
				<h1>Try a new search...</h1>
				<p>
					<form action="/records/search" method="post">
					<input type="textbox" class="search-box" value="Search..." name="data[Record][q]" size="20" onClick="this.value=''"> <input type="submit" value="Go!" class="search-go">
					</form>
				</p>
			</div>
		</div>
		<div class="or">
			or
		</div>
		<div class="add">
			<h1>The item you searched for may not exist yet. <font color="#666666">Create it.</font></h1>
			<p>Get started now. It is easy.</p>
		</div>
	<?
	}
	?>
</div>