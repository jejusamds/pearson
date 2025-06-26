<script>
$(function(){
	if($("#saveInnerHTML").length > 0){
		var inner_html = $("#saveInnerHTML").html();

		console.log(inner_html);

		$.post("save_inner_html.php", {
			"mode": "save", 
			"parent_v": "<?=$_GET['no']?>",
			"inner_html": inner_html
		});
	}
});
</script>