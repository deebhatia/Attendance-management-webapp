<html lang="en">
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
$( "#from" ).datepicker({
defaultDate: "+0w",
changeMonth: true,
numberOfMonths: 2,
onClose: function( selectedDate ) {
$( "#to" ).datepicker(  "option","minDate", selectedDate );
}
});
$( "#to" ).datepicker({
defaultDate: "+0w",
changeMonth: true,
numberOfMonths: 2,
onClose: function( selectedDate ) {
$( "#from" ).datepicker( "option", "maxDate", selectedDate );
}
});
});
</script>
</head>
</html>
