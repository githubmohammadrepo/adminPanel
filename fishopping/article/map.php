{source}

 <head>

<meta charset="utf-8" />
<title>Marker</title>
<script src="http://tabatabaee.info/scripts/map.js"></script>
<link href="http://tabatabaee.info/scripts/mapbox-gl.css" rel="stylesheet" />
<style>
body { margin: 0; padding: 0; }

#map{position: absolut;top:0;bottom:0;

width:100%;

height:600px;}

 


</style>
</head>
<body>

<div id="map" />

<script>
var map = initMap('map');

// Change Center
map.setCenter([51.39, 35.70]); 

//Add Custom Marker
var icon = createIcon('http://tabatabaee.info/images/marker/marker-48.png',48,48);
AddMarker(map,[<?=$_GET["lng"]?>, <?=$_GET["lat"]?>],icon);

</script>

</body>

 

{/source}