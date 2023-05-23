<div class="recordnav">
		<?php if(!$carmake -> AtfirstPage()){ //If the current page is not the first page
?>
	<!-- PM NOTE: FIRST LINK DISABLED	<a href ="<?php echo $navbase.'/1'; ?>" title="first page" rel="first"> <i class="fas fa-backward-fast"></i> </a> -->
		<a href ="<?php echo $navbase.'/'.$prevPage; ?>" title="previous page" rel="prev"><i class="fas fa-square-caret-left"></i> </a>
	<?php } ?>
	<span><?php echo $fromRecord; ?> - <?php echo $toRecord; ?> of <?php echo $totalRecords; ?> Vehicles</span>
<?php if(!$carmake -> AtlastPage()){ //If the current page is not the last page
?>
		<a href = "<?php echo $navbase.'/'.$nextPage; ?>" title="next page" rel="next"> <i class="fas fa-square-caret-right"></i> </a>
<!--  PM NOTE: LAST LINK DISABLED <a href ="<?php echo $navbase.'/'.$lastPage;?>" title="last page" rel="last"> <i class="fas fa-forward-fast"></i> </a> -->
<?php	} ?>
		</div>
