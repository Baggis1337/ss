<!DOCTYPE html>
<html>
	<head>
		<title>Map of world's attractions</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="robots" content="index, follow" />
		<meta name="description" content="An awesome map to find and locate all the world's best attractions." />
		<meta name="keywords" content="Map, travel planner, attractions, must see, world, travel">
		<meta property="og:url" content="https://resekartan.se/map.php" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="Map of world's attractions" />
		<meta property="og:description" content="An awesome map to find and locate all the world's best attractions." />
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald" />
		<link rel="shortcut icon" href="/map-images/favicon.ico" type="image/x-icon">
		<meta property="og:image" content="/map-images/map-image.jpg" /> <!--Keep Updated!!!2024!!!-->
		<link href="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css" rel="stylesheet" /> <!--Keep Updated!!!2024!!!-->
		<script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script> <!--Keep Updated!!!2024!!!-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!--Keep Updated!!!2024!!!-->

		<style>
		
		     /* unvisited link */
			a:link 
			{
				color: #0000dd;
				text-decoration: none;
			}
			
			/* visited link */
			a:visited 
			{
				color: #0000dd;
				text-decoration: none;
			}
			
			/* mouse over link */
			a:hover 
			{
				color: #79ba01;
				text-decoration: underline;
			}
			
			/* selected link */
			a:active 
			{
				color: #0000dd;
				text-decoration: none;
			}
	
			body
			{
				margin:0; padding:0;
				overflow-x: hidden;
			}

			#map
			{
				position:absolute;
				top:0; 
				bottom:0;
				width:100%;
				height: 100%;
				overflow-x: hidden;
			}

			#menu
			{
				background: #fafafa;
				position: absolute;
				float:right;
				top: 105px;
				bottom:0px;
				height: calc(100% - 105px);
				right: 0px;
				border-radius: 1px;
				width: 280px;
				display: none;
				border-left:solid 1px;
				border-right:solid 0px;
				border-top:solid 0px;
				border-bottom:solid 0px;		
				box-sizing:border-box;
				font-family: 'Open Sans', sans-serif;
				margin:0;
				padding:0;
				overflow: auto;
			}

			#menu_shop
			{
				background: #fafafa;
				position: absolute;
				float:right;
				top: 105px;
				bottom:0px;
				height: calc(100% - 105px);
				right: 0px;
				border-radius: 1px;
				width: 280px;
				display: none;
				border-left:solid 1px;
				border-right:solid 0px;
				border-top:solid 0px;
				border-bottom:solid 0px;		
				box-sizing:border-box;
				font-family: 'Open Sans', sans-serif;
				margin:0;
				padding:0;
				overflow: auto;
			}

			#menupadding
			{
				background: #fafafa;
				position: absolute;
				float:right;
				top: 0px;
				bottom:0px;
				height:105px;
				right: 0px;
				border-radius: 1px;
				width: 280px;
				display: none;
				border-left:solid 1px;
				border-right:solid 0px;
				border-top:solid 0px;
				border-bottom:solid 0px;
				box-sizing:border-box;
				font-family: 'Open Sans', sans-serif;
				z-index: 4;
			}

			.mapboxgl-popup /*Här ställer man in hur pop up rutan ska se ut.. Font osv!*/
			{
				max-width: 400px;
			}

			#openbtn a
			{
				text-decoration: none;
				color: #FFFFFF;
			}

			#openbtn
			{
				background: #0073e6;
				color: #404040;
				padding: 4px;
				position: relative;
				float:left;
				text-decoration: none;
				border-top-left-radius: 7px;
				border-bottom-left-radius: 7px;
				width: 95px;
				font-size: 20px;
				border: 0px 0 0 0 solid rgba(0,0,0); 
				font-family: Adamina;
				display: inline;
				z-index: 4;
			}

			#openbtnshop a
			{
				text-decoration: none;
				color: #FFFFFF;
			}

			#openbtnshop
			{
				background: #0073e6;
				color: #404040;
				padding: 4px;
				position: relative;
				top:5px;
				float:left;
				text-decoration: none;
				border-top-left-radius: 7px;
				border-bottom-left-radius: 7px;
				width: 95px;
				font-size: 20px;
				border: 0px 0 0 0 solid rgba(0,0,0); 
				font-family: Adamina;
				display: inline;
				z-index: 4;
			}
			
			#entire_thing
			{
				height:100px;
				position:absolute;
				top:0px;
				bottom:0px;
				right:0px;
				width: 96px;
				
			}

			#entire_thing_shop
			{
				height:100px;
				position:absolute;
				top:0px;
				bottom:0px;
				right:0px;
				width: 90px;
			}
			
			.checkbox_heading
			{
				font-size: 15px;
				font-family: Georgia, serif;
				font-weight:bold;
				padding-bottom:8px;
				padding-left:10px;
			}

			.checkbox_style
			{
				padding-top:2px;
				text-align:left;
				vertical-align:middle;
				font-family: Georgia, serif;
			}

			.strike
			{
				display: block;
				text-align: center;
				overflow: hidden;
				white-space: nowrap; 
				font-family: Oswald;
				padding-bottom: 18px;
				font-weight: bold;
			}

			.strike > span
			{
				position: relative;
				display: inline-block;
			}

			.strike > span:before,
			.strike > span:after
			{
				content: "";
				position: absolute;
				top: 50%;
				width: 9999px;
				height: 1px;
				background: #383232;
			}

			.strike > span:before 
			{
				right: 100%;
				margin-right: 10px;
			}

			.strike > span:after 
			{
				left: 100%;
				margin-left: 10px;
			}

			.geocoder
			{
				width:240px;
				margin: 0 auto;
			}

			.mapboxgl-ctrl-geocoder
			{
				margin: 0 auto;
				width:240px;
			}

			.mapboxgl-ctrl-group > .mapboxgl-ctrl-icon > button 
			{
				width: 24px !important;
				height: 24px !important;
				border-radius: 2px !important;
			}
			
			.mapboxgl-ctrl-compass-arrow 
			{
				margin: 0.1em 2px !important;
			}
			
			.dropdown
			{
				position: relative;
				display: inline-block;
			}

			.dropdown-content
			{
				display: none;
				position: absolute;
				background-color: #f9f9f9;
				min-width: 120px;
				box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
				padding: 14px 14px 14px 14px;
				z-index: 5;
			}

			.dropdown:hover .dropdown-content
			{
				display: block;
			}

			.desc
			{
				padding: 15px;
				text-align: center;
			}

			.distance-container
			{
				position: absolute;
				top: 13px;
				left: 50px;
				z-index: 1;
			}
			
			#lineiconcolor
			{
				margin-top: 4px;
			}
			
			.distance-container > * 
			{
				background-color: rgba(0, 0, 0, 0.5);
				color: #fff;
				font-size: 11px;
				line-height: 18px;
				display: block;
				margin: 0;
				padding: 5px 10px;
				border-radius: 3px;
			}
			
			.btn 
			{
				border: none;
				outline: none;
				display: inline-block;
				text-decoration: none;
				width:70px;
				height:70px;
				cursor: pointer;
				font-weight: bold;
				color: #ffffff;
				text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
			}

			.btn1 {background-image: url("map-images/streets.png"); border-radius: 50%; }
			.btn2 {background-image: url("map-images/outdoors.png"); border-radius: 50%;}
			.btn3 {background-image: url("map-images/satellite.png"); border-radius: 50%;}

			.active, .btn:hover 
			{
				color: #ffffff;
				opacity: 0.7;
				border-style: solid;
				border-width:2px;
				border-color:#000000;
			}
			
			.item_popup 
			{
				vertical-align: top;
				display: inline-block;
				text-align: center;
				width: 45px;
				margin-left: 4px;
				margin-right: 4px;
			}
			
			.img_popup 
			{
				width: 40px;
				height: 40px;
				margin-left:5px;
				margin-right:5px;
			}
			
			.caption_popup 
			{
				display: block;
			}
			
			.wordWrap 
			{
				word-wrap: break-word;      /* IE 5.5-7 */
				white-space: -moz-pre-wrap; /* Firefox 1.0-2.0 */
				white-space: pre-wrap;      /* current browsers */
			}
			
			.mapboxgl-popup-close-button
			{
				Font:35px/25px Helvetica Neue,Arial,Helvetica,sans-serif;
			}
			
			@media only screen and (max-width: 1024px)
			{
				.mapboxgl-popup-close-button
				{
					visibility: hidden;
				}
				
				.wordWrap
				{
					margin-top: 0px !important;
				}
			}

			
		</style>
	</head>

	<body>
	
		<div id="map">
		<div id="distance" class="distance-container"></div>
		<script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script> <!--Keep Updated!!!2024!!!-->
		</div>
<div style="z-index: 1;" class="mapboxgl-control-container"><div style="z-index: 1;" class="mapboxgl-ctrl-top-left"><div style="z-index: 1;" class="mapboxgl-ctrl mapboxgl-ctrl-group">

<button  style="z-index: 5;" class="mapbox-gl-draw_ctrl-draw-btn mapbox-gl-draw_line" title="LineString tool (l)"></button>
<button onclick="EnableLine()" style="z-index: 5;" class="mapbox-gl-draw_ctrl-draw-btn mapbox-gl-draw_line" title="LineString tool (l)">

<center><div id="lineiconcolor"><img alt="" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIgICB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiICAgeG1sbnM6aW5rc2NhcGU9Imh0dHA6Ly93d3cuaW5rc2NhcGUub3JnL25hbWVzcGFjZXMvaW5rc2NhcGUiICAgd2lkdGg9IjIwIiAgIGhlaWdodD0iMjAiICAgdmlld0JveD0iMCAwIDIwIDIwIiAgIGlkPSJzdmcxOTE2NyIgICB2ZXJzaW9uPSIxLjEiICAgaW5rc2NhcGU6dmVyc2lvbj0iMC45MStkZXZlbCtvc3htZW51IHIxMjkxMSIgICBzb2RpcG9kaTpkb2NuYW1lPSJsaW5lLnN2ZyI+ICA8ZGVmcyAgICAgaWQ9ImRlZnMxOTE2OSIgLz4gIDxzb2RpcG9kaTpuYW1lZHZpZXcgICAgIGlkPSJiYXNlIiAgICAgcGFnZWNvbG9yPSIjZmZmZmZmIiAgICAgYm9yZGVyY29sb3I9IiM2NjY2NjYiICAgICBib3JkZXJvcGFjaXR5PSIxLjAiICAgICBpbmtzY2FwZTpwYWdlb3BhY2l0eT0iMC4wIiAgICAgaW5rc2NhcGU6cGFnZXNoYWRvdz0iMiIgICAgIGlua3NjYXBlOnpvb209IjE2IiAgICAgaW5rc2NhcGU6Y3g9IjEyLjg5ODc3NSIgICAgIGlua3NjYXBlOmN5PSI5LjU4OTAxNTIiICAgICBpbmtzY2FwZTpkb2N1bWVudC11bml0cz0icHgiICAgICBpbmtzY2FwZTpjdXJyZW50LWxheWVyPSJsYXllcjEiICAgICBzaG93Z3JpZD0idHJ1ZSIgICAgIHVuaXRzPSJweCIgICAgIGlua3NjYXBlOndpbmRvdy13aWR0aD0iMTI4MCIgICAgIGlua3NjYXBlOndpbmRvdy1oZWlnaHQ9Ijc1MSIgICAgIGlua3NjYXBlOndpbmRvdy14PSIwIiAgICAgaW5rc2NhcGU6d2luZG93LXk9IjIzIiAgICAgaW5rc2NhcGU6d2luZG93LW1heGltaXplZD0iMCIgICAgIGlua3NjYXBlOm9iamVjdC1ub2Rlcz0idHJ1ZSI+ICAgIDxpbmtzY2FwZTpncmlkICAgICAgIHR5cGU9Inh5Z3JpZCIgICAgICAgaWQ9ImdyaWQxOTcxNSIgLz4gIDwvc29kaXBvZGk6bmFtZWR2aWV3PiAgPG1ldGFkYXRhICAgICBpZD0ibWV0YWRhdGExOTE3MiI+ICAgIDxyZGY6UkRGPiAgICAgIDxjYzpXb3JrICAgICAgICAgcmRmOmFib3V0PSIiPiAgICAgICAgPGRjOmZvcm1hdD5pbWFnZS9zdmcreG1sPC9kYzpmb3JtYXQ+ICAgICAgICA8ZGM6dHlwZSAgICAgICAgICAgcmRmOnJlc291cmNlPSJodHRwOi8vcHVybC5vcmcvZGMvZGNtaXR5cGUvU3RpbGxJbWFnZSIgLz4gICAgICAgIDxkYzp0aXRsZSAvPiAgICAgIDwvY2M6V29yaz4gICAgPC9yZGY6UkRGPiAgPC9tZXRhZGF0YT4gIDxnICAgICBpbmtzY2FwZTpsYWJlbD0iTGF5ZXIgMSIgICAgIGlua3NjYXBlOmdyb3VwbW9kZT0ibGF5ZXIiICAgICBpZD0ibGF5ZXIxIiAgICAgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCwtMTAzMi4zNjIyKSI+ICAgIDxwYXRoICAgICAgIHN0eWxlPSJjb2xvcjojMDAwMDAwO2Rpc3BsYXk6aW5saW5lO292ZXJmbG93OnZpc2libGU7dmlzaWJpbGl0eTp2aXNpYmxlO2ZpbGw6IzAwMDAwMDtmaWxsLW9wYWNpdHk6MTtmaWxsLXJ1bGU6bm9uemVybztzdHJva2U6bm9uZTtzdHJva2Utd2lkdGg6MzttYXJrZXI6bm9uZTtlbmFibGUtYmFja2dyb3VuZDphY2N1bXVsYXRlIiAgICAgICBkPSJtIDEzLjUsMTAzNS44NjIyIGMgLTEuMzgwNzEyLDAgLTIuNSwxLjExOTMgLTIuNSwyLjUgMCwwLjMyMDggMC4wNDYxNCwwLjYyNDQgMC4xNTYyNSwwLjkwNjMgbCAtMy43NSwzLjc1IGMgLTAuMjgxODM2LC0wLjExMDIgLTAuNTg1NDIxLC0wLjE1NjMgLTAuOTA2MjUsLTAuMTU2MyAtMS4zODA3MTIsMCAtMi41LDEuMTE5MyAtMi41LDIuNSAwLDEuMzgwNyAxLjExOTI4OCwyLjUgMi41LDIuNSAxLjM4MDcxMiwwIDIuNSwtMS4xMTkzIDIuNSwtMi41IDAsLTAuMzIwOCAtMC4wNDYxNCwtMC42MjQ0IC0wLjE1NjI1LC0wLjkwNjIgbCAzLjc1LC0zLjc1IGMgMC4yODE4MzYsMC4xMTAxIDAuNTg1NDIxLDAuMTU2MiAwLjkwNjI1LDAuMTU2MiAxLjM4MDcxMiwwIDIuNSwtMS4xMTkzIDIuNSwtMi41IDAsLTEuMzgwNyAtMS4xMTkyODgsLTIuNSAtMi41LC0yLjUgeiIgICAgICAgaWQ9InJlY3Q2NDY3IiAgICAgICBpbmtzY2FwZTpjb25uZWN0b3ItY3VydmF0dXJlPSIwIiAvPiAgPC9nPjwvc3ZnPg=="></center></button>
</div></div></div></div>
		
		<div id="entire_thing_shop">
			<nav id="menu_shop">
				<div class="strike">
					<span>ATTRACTIONS CART</span>
					<br />
				</div>
				<div style="text-align:center">
					Your cart contains:<br />

						<span id="cart"></span>
					
					<br />
					Empty cart <a onclick="ClearShop()" href="#">here</a>.

					<br /><br />
				</div>
				<br /><br />
				<div class="strike">
					<span>EXPORT CART</span>
				</div>
				<div style="padding-left:10px;">
					Export to a <a onclick='JSONToKMLConvertor(localStorage.getItem("titelSave"), "markers-kml-resekartan")' href='javascript:void(0)'>.kml file.</a> (Can be open in Google Earth/My Maps)
					<br /><br /> Export to a <a onclick='JSONToCSVConvertor(localStorage.getItem("titelSave"), "markers-csv-resekartan", true);' href='javascript:void(0)'>.csv file.</a> (Can be open in Sheets/Excel/Calc)
				</div>
				<br /><br /><br /><center>Read <a href="https://resekartan.se/kartan/" target="_blank">more</a> how to handle the cart and how the files can be used.<center><br /><br />
			</nav>
		</div>

		<div id="entire_thing">
			<div id="menupadding">
				<div style="display: flex; justify-content: center; align-items: center; padding-top:6px; padding-bottom:6px;">

					<div class="dropdown">
						<img src="/map-images/facebook.png" width="30px" border="0" alt="Share to Facebook" title="Share to Facebook" style="padding-right:11px;">
						<div class="dropdown-content">
							<a class="facebook customer share" href="https://www.facebook.com/sharer/sharer.php?u=https://resekartan.se/map.php" target="_blank">Share to FB</a>
							<br />
							<a href="https://www.facebook.com/resekartan" target="_blank">Visit FB-page</a>
						</div>
					</div>
					<a class="twitter customer share" href="https://twitter.com/share?url=https://resekartan.se/map.php" target="_blank"><img alt="Share to Twitter" title="Share to Twitter" src="/map-images/twitter.png" width="30px" style="padding-right:11px;"></a>
					<a href="https://www.instagram.com/resekartan/" target="_blank"><img alt="Visit Instagram page" title="Visit Instagram page" src="/map-images/instagram.png" width="30px" style="padding-right:11px;"></a>
					<a href="http://www.youtube.com/channel/UCjkKTWl9rXE6nHpqB80igmA" target="_blank"><img alt="Visit YouTube page" title="Visit YouTube page" src="/map-images/youtube.png" width="30px"></a>
				</div>

				<div id='geocoder' class='geocoder'>
				</div>
			</div>
			
			<nav id="menu">
			
				<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js'></script>                        <!--Keep Updated!!!2024!!!-->
				<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css' type='text/css' />  <!--Keep Updated!!!2024!!!-->

				<div class="strike">
					<span>FILTERS</span>
				</div>

				<div class="checkbox_heading">Attractions:</div>

				<table style="border: 0px; padding-left:5px;">
					<tr>
						<td class="checkbox_style"><input onclick="show_green(this)" type="checkbox" id="Check_green" name="green" value="green" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/green.png" alt="Green" height="13" width="13"></td>
						<td class="checkbox_style">Recommend to see</td>		
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_yellow(this)" type="checkbox" id="Check_yellow" name="yellow" value="yellow" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/yellow.png" alt="Yellow" height="13" width="13"></td>
						<td class="checkbox_style">Just an "ok" attraction</td>		
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_blue(this)" type="checkbox" id="Check_blue" name="blue" value="blue" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/blue.png" alt="Blue" height="13" width="13"></td>
						<td class="checkbox_style">Not "fully" rated</td>		
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_red(this)" type="checkbox" id="Check_red" name="red" value="red" checked="checked"/></td>
						<td class="checkbox_style"><img src="/map-images/red.png" alt="Red" height="13" width="13"></td>
						<td class="checkbox_style">Not yet rated, a priority</td>
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_darkred(this)" type="checkbox" id="Check_darkred" name="darkred" value="darkred" checked="checked"/></td>
						<td class="checkbox_style"><img src="/map-images/darkred.png" alt="Darkred" height="13" width="13"></td>
						<td class="checkbox_style">Missed to see, not rated</td>
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_grey(this)" type="checkbox" id="Check_grey" name="grey" value="grey" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/grey.png" alt="Grey" height="13" width="13"></td>
						<td class="checkbox_style">Not yet rated, not a priority</td>
					</tr>
				</table>

				<div class="checkbox_heading" style="padding-top:18px;">Others:</div>

				<table style="border: 0px; padding-left:5px;">
					<tr>
						<td class="checkbox_style"><input onclick="show_white(this)" type="checkbox" id="Check_white" name="white" value="white" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/white.png" alt="White" height="13" width="13"></td>
						<td class="checkbox_style">No attraction, but a reminder</td>
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_riskyarea(this)" type="checkbox" id="Check_riskyarea" name="riskyarea" value="riskyarea" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/riskyarea.png" alt="Risky area" height="15" width="15"></td>
						<td class="checkbox_style">Known to be a risky area</td>
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_hotel(this)" type="checkbox" id="Check_hotel" name="hotel" value="hotel" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/accommodation.png" alt="Accommodation" height="13" width="13"></td>
						<td class="checkbox_style">Accommodation</td>
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_nightlife(this)" type="checkbox" id="Check_nightlife" name="nightlife" value="nightlife" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/nightlife.png" alt="Nightlife" height="13" width="13"></td>
						<td class="checkbox_style">Nightlife area/spot</td>
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_dinner(this)" type="checkbox" id="Check_dinner" name="dinner" value="dinner" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/restaurant.png" alt="Restaurant" height="13" width="13"></td>
						<td class="checkbox_style">Restaurant/café area/spot</td>
					</tr>
				</table>

				<div class="checkbox_heading" style="padding-top:18px;">Routes:</div>

				<table style="border: 0px; padding-left:5px; padding-bottom:18px;">	
					<tr>
						<td class="checkbox_style"><input onclick="show_yellow_line(this)" type="checkbox" id="Check_yellow_line" name="yellow_line" value="yellow_line" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/yellow-route.png" alt="Routes" height="13" width="13"></td>
						<td class="checkbox_style">Already taken</td>
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_red_line(this)" type="checkbox" id="Check_red_line" name="red_line" value="red_line" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/red-route.png" alt="Routes" height="13" width="13"></td>
						<td class="checkbox_style">Not taken, a priority</td>
					</tr>

					<tr>
						<td class="checkbox_style"><input onclick="show_grey_line(this)" type="checkbox" id="Check_grey_line" name="grey_line" value="grey_line" checked="checked" /></td>
						<td class="checkbox_style"><img src="/map-images/grey-route.png" alt="Routes" height="13" width="13"></td>
						<td class="checkbox_style">Not taken, not a priority</td>
					</tr>	  
				</table>

				<br />
				
				<div class="strike">
					<span>MAP STYLE</span>
				</div>

				<div id="buttonDIV">
				<center>
					<button id="resekartan/ckess08ix3fh219p36i5z1wtf" name="rtoggle" value="resekartan/ckess08ix3fh219p36i5z1wtf" class="btn btn1 active" title="Street" alt="Street">Street</button>
					<button id="resekartan/ckcnxs41412x01iroejv3994s" name="rtoggle" value="resekartan/ckcnxs41412x01iroejv3994s" class="btn btn2" title="Outdoor" alt="Outdoor">Outdoor</button>
					<button id="resekartan/ckcnxs41412x01iroejv3994s" name="rtoggle" value="resekartan/ckcnxs41412x01iroejv3994s" class="btn btn3" title="Satellite" alt="Satellite">Satellite</button>
				</center>
				</div>

				<br />
				<br />

				<div class="strike">
					<span>INFORMATION</span>
				</div>

				<div style="text-align:center">
					Click <a href="https://resekartan.se/kartan/" target="_blank">here</a> for more information about the map and the markers.
				</div>
				
				<br />
				<br />

			</nav>
	  
			<div id="openbtn">
				<a href="javascript:void(0)" onclick="openNav()">☰&nbsp; Filters</a>
			</div>

			<div id="openbtnshop">
				<a href="javascript:void(0)" onclick="openNavShop()">☰&nbsp; Cart</a> 
			</div>

			<script>
				<?php
					function isValidLatitude($latitude)
					{
						if (preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/", $latitude)) 
						{
							return true;
						}
						else 
						{
							return false;
						}
					}
					
					function isValidLongitude($longitude)
					{
						if(preg_match("/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/", $longitude)) 
						{
							return true;
						} 
						else 
						{
							return false;
						}
					}
					echo 'console.log("lat: '.isValidLatitude($_GET['lat']).'");';
					echo 'console.log("lng: '.isValidLongitude($_GET['lng']).'");';
					echo 'console.log("Zoom: '.is_numeric($_GET['zoom']).'");';
				?>	  
				var titelSave = [];
				var descriptionSave = [];
				var coordinatesSave = [];
				var CartString;
				var ShopOpen = false;
				var customData = [];
				var customData2;
				var customData3;
				var customData4;
				var customData5;
				var customData6;
				var customData7;
				var ActivateDistance = false;
			
				if(localStorage.getItem("titelSave") == null)
				{
					CartString = [];
				}
				else
				{
					CartString = JSON.parse(localStorage.getItem("titelSave"));
				}

				function show_green(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('green_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('green_markers', 'visibility', 'visible');
					}
				}

				function show_yellow(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('yellow_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('yellow_markers', 'visibility', 'visible');
					}
				}

				function show_blue(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('blue_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('blue_markers', 'visibility', 'visible');
					}
				}

				function show_red(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('red_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('red_markers', 'visibility', 'visible');
					}
				}

				function show_darkred(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('darkred_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('darkred_markers', 'visibility', 'visible');
					}
				}

				function show_grey(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('grey_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('grey_markers', 'visibility', 'visible');
					}
				}

				function show_white(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('white_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('white_markers', 'visibility', 'visible');
					}
				}

				function show_riskyarea(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('riskyarea_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('riskyarea_markers', 'visibility', 'visible');
					}
				}

				function show_nightlife(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('nightlife_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('nightlife_markers', 'visibility', 'visible');
					}
				}

				function show_dinner(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('restaurant_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('restaurant_markers', 'visibility', 'visible');
					}
				}

				function show_hotel(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('accommodation_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('accommodation_markers', 'visibility', 'visible');
					}
				}

				function show_red_line(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('line_red_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('line_red_markers', 'visibility', 'visible');
					}
				}

				function show_yellow_line(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('line_yellow_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('line_yellow_markers', 'visibility', 'visible');
					}
				}
			
				function show_grey_line(checkbox)
				{
					if (!checkbox.checked)
					{
						map.setLayoutProperty('line_grey_markers', 'visibility', 'none');
						this.className = '';
					}
					else
					{
						this.className = 'active';
						map.setLayoutProperty('line_grey_markers', 'visibility', 'visible');
					}
				}
				
				function openNav() 
				{
					document.getElementById("menu").style.display = "inline";
					document.getElementById("menupadding").style.display = "inline";
					//document.getElementById("map").style.width = "50%";
					document.getElementById("entire_thing").style.width = "304px";
					document.getElementById("entire_thing").style.height = "100%";
					document.getElementById('openbtn').innerHTML = '<a href="javascript:void(0)" onclick="closeNav()"><center>&#10006;</center></a>';
					document.getElementById("openbtn").style.width = "30px";
					document.getElementById("openbtn").style.left = "-14px";
					document.getElementById('openbtnshop').style.display = "none";
					var all = document.getElementsByClassName('mapboxgl-ctrl-geocoder');
					for (var i = 0; i < all.length; i++)
					{
						all[i].style.display = 'block';
					}
				}

				function closeNav() 
				{
					document.getElementById("menu").style.display = "none";
					document.getElementById("menupadding").style.display = "none";
					document.getElementById("entire_thing").style.width = "96px";
					document.getElementById("entire_thing").style.height = "100px";
					document.getElementById('openbtn').innerHTML = '<a href="javascript:void(0)" onclick="openNav()">☰&nbsp; Filters</a>';
					document.getElementById("openbtn").style.width = "95px";
					document.getElementById("openbtn").style.left = "0px";
					document.getElementById('openbtnshop').style.display = "inline";				
					var all = document.getElementsByClassName('mapboxgl-ctrl-geocoder');
					for (var i = 0; i < all.length; i++)
					{
						all[i].style.display = 'none';
					}
					//document.getElementById("map").style.width = "100%";
				}

				function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel)
				{
					//If JSONData is not an object then JSON.parse will parse the JSON string in an Object
					var arrData = JSON.parse(localStorage.getItem("titelSave"));
					var CSV = '';    

					if (ShowLabel == true) 
					{
						CSV += '- Presented by Resekartan -' + '\r\n';
						CSV += '' + '\r\n';
						CSV += 'Attraction;Comment;Coordinates' + '\r\n';
					}

					var newline = 0;

					//1st loop is to extract each row
					for (var i = 0; i < arrData.length; i++)
					{
						var row = "";

						//2nd loop will extract each column and convert it in string comma-seprated
						for (var index in arrData[i])
						{
							row += arrData[i][index];
						}

						row.slice(0, row.length - 1);

						if(newline == 2) //Yes this shit is needed here
						{
							var tempcord = row.split(", ");
							CSV += tempcord[1] + ', ' + tempcord[0] + '\r\n';
							newline = 0;
						}
						else
						{
							CSV += row + ';';
							newline++;
						}
					}

					if (CSV == '') 
					{
						alert("Invalid data");
						return;
					}   

					//Generate a file name
					var fileName = "exported-";
					//this will remove the blank-spaces from the title and replace it with an underscore
					fileName += ReportTitle.replace(/ /g,"_");   

					//Initialize file format you want csv or xls
					var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

					// Now the little tricky part.
					// you can use either>> window.open(uri);
					// but this will not work in some browsers
					// or you will not get the correct file extension    

					//this trick will generate a temp <a /> tag
					var link = document.createElement("a");    
					link.href = uri;

					//set the visibility hidden so it will not effect on your web-layout
					link.style = "visibility:hidden";
					link.download = fileName + ".csv";

					//this part will append the anchor tag and remove it after automatic click
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
				}
				
				function JSONToKMLConvertor(JSONData, ReportTitle)
				{
					//If JSONData is not an object then JSON.parse will parse the JSON string in an Object
					var arrData = JSON.parse(localStorage.getItem("titelSave"));
					var KML = '';    


					KML += '<' + '?xml version="1.0" encoding="UTF-8"?' + '>' + '\r\n';
					KML += '<kml xmlns="http://www.opengis.net/kml/2.2">' + '\r\n';
					KML += '<Document>' + '\r\n';
					KML += '<name>attractions_kml_resekartan</name>' + '\r\n';
					KML += '<description>Exported attractions by Resekartan</description>' + '\r\n';
					KML += '<Style id="icon-1899-FF5252-nodesc-normal">' + '\r\n';
					KML += '<IconStyle>' + '\r\n';
					KML += '<color>ff5252ff</color>' + '\r\n';
					KML += '<scale>1</scale>' + '\r\n';
					KML += '<Icon>' + '\r\n';
					KML += '<href>https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png</href>' + '\r\n';
					KML += '</Icon>' + '\r\n';
					KML += '<hotSpot x="32" xunits="pixels" y="64" yunits="insetPixels"/>' + '\r\n';
					KML += '</IconStyle>' + '\r\n';
					KML += '<LabelStyle>' + '\r\n';
					KML += '<scale>0</scale>' + '\r\n';
					KML += '</LabelStyle>' + '\r\n';
					KML += '</Style>' + '\r\n';	
					KML += '<Style id="icon-1899-FF5252-nodesc-highlight">' + '\r\n';
					KML += '<IconStyle>' + '\r\n';
					KML += '<color>ff5252ff</color>' + '\r\n';
					KML += '<scale>1</scale>' + '\r\n';
					KML += '<Icon>' + '\r\n';
					KML += '<href>https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png</href>' + '\r\n';
					KML += '</Icon>' + '\r\n';
					KML += '<hotSpot x="32" xunits="pixels" y="64" yunits="insetPixels"/>' + '\r\n';
					KML += '</IconStyle>' + '\r\n';
					KML += '<LabelStyle>' + '\r\n';
					KML += '<scale>1</scale>' + '\r\n';
					KML += '</LabelStyle>' + '\r\n';
					KML += '</Style>' + '\r\n';		
					KML += '<StyleMap id="icon-1899-FF5252-nodesc">' + '\r\n';
					KML += '<Pair>' + '\r\n';
					KML += '<key>normal</key>' + '\r\n';
					KML += '<styleUrl>#icon-1899-FF5252-nodesc-normal</styleUrl>' + '\r\n';
					KML += '</Pair>' + '\r\n';
					KML += '<Pair>' + '\r\n';
					KML += '<key>highlight</key>' + '\r\n';
					KML += '<styleUrl>#icon-1899-FF5252-nodesc-highlight</styleUrl>' + '\r\n';
					KML += '</Pair>' + '\r\n';
					KML += '</StyleMap>' + '\r\n';	
					KML += '<Folder>' + '\r\n';
					KML += '<name>Resekartan Layer 1</name>' + '\r\n';
					

					var newline = 0;

					//1st loop is to extract each row
					for (var i = 0; i < arrData.length; i++)
					{
						var row = "";

						//2nd loop will extract each column and convert it in string comma-seprated
						for (var index in arrData[i])
						{
							row += arrData[i][index];
						}

						row.slice(0, row.length - 1);

						if(newline == 2) //Yes this shit is needed here
						{
							KML += '<Point>' + '\r\n';
							KML += '<coordinates>' + '\r\n';
							var tempcord = row.split(", ");
							KML += tempcord[0] + ', ' + tempcord[1] + '\r\n';
							KML += '</coordinates>' + '\r\n';
							KML += '</Point>' + '\r\n';
							KML += '</Placemark>' + '\r\n';
							newline = 0;
						}
						else
						{
							if(newline == 0)
							{
								KML += '<Placemark>' + '\r\n' + '<name><![CDATA[';
								KML += row;
								KML += ']]></name>' + '\r\n';
								newline++;
							}
							else
							{
								KML += '<description><![CDATA[';
								KML += row;
								KML += ']]></description>' + '\r\n';
								KML += '<styleUrl>#icon-1899-FF5252-nodesc</styleUrl>' + '\r\n';
								newline++;
							}
						}
					}

					KML += '</Folder>' + '\r\n';
					KML += '</Document>' + '\r\n';
					KML += '</kml>' + '\r\n';
					
					if (KML == '') 
					{
						alert("Invalid data");
						return;
					}
					

					//Generate a file name
					var fileName = "exported-";
					//this will remove the blank-spaces from the title and replace it with an underscore
					fileName += ReportTitle.replace(/ /g,"_");   

					//Initialize file format you want csv or xls
					var uri = 'data:application/vnd.google-earth.kml+xml;charset=UTF-8,' + escape(KML);

					// Now the little tricky part.
					// you can use either>> window.open(uri);
					// but this will not work in some browsers
					// or you will not get the correct file extension    

					//this trick will generate a temp <a /> tag
					var link = document.createElement("a");    
					link.href = uri;

					//set the visibility hidden so it will not effect on your web-layout
					link.style = "visibility:hidden";
					link.download = fileName + ".kml";

					//this part will append the anchor tag and remove it after automatic click
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
				}
				
				function ClearShop()
				{
					localStorage.clear();
					CartString = [];

					document.getElementById("cart").innerHTML = '<select name="attractions_cart" size="15" width="210" style="width: 210px"><option hidden selected> - Click to see -</option></select>';

				}
				
				function openNavShop() 
				{
					var arrData = JSON.parse(localStorage.getItem("titelSave"));
					var CSV = '';    
					ShopOpen = true;
					var newline = 0;


					CSV += '<select name="attractions_cart" size="15" width="210" style="width: 210px"><option hidden selected> - Click to see -</option>';
					
					if(arrData != null)	
					{
						//1st loop is to extract each row
						for (var i = 0; i < arrData.length; i++)
						{
							var row = "";

							//2nd loop will extract each column and convert it in string comma-seprated
							for (var index in arrData[i])
							{
								row += arrData[i][index];
							}

							row.slice(0, row.length - 1);

							if(newline == 2) //Yes this shit is needed here
							{
								newline = 0;
							}
							else
							{
								if(newline == 0) //Yes this shit is needed here
								{
									CSV += '<option>'+ row + '</option>';
								}
								newline++;
							}
						}
					}
					CSV += '</select>';
					document.getElementById("cart").innerHTML = CSV;

					//alert(CartString);

					document.getElementById("menu_shop").style.display = "inline";
					document.getElementById("menupadding").style.display = "inline";
					//document.getElementById("map").style.width = "50%";
					document.getElementById("entire_thing_shop").style.width = "304px";
					document.getElementById("entire_thing_shop").style.height = "100%";
					document.getElementById('openbtnshop').innerHTML = '<a href="javascript:void(0)" onclick="closeNavShop()"><center>&#10006;</center></a>';
					document.getElementById("openbtnshop").style.width = "30px";
					document.getElementById("openbtnshop").style.left = "-222px";
					document.getElementById("openbtnshop").style.top = "0px";
					document.getElementById('openbtn').style.display = "none";
					var all = document.getElementsByClassName('mapboxgl-ctrl-geocoder');
					//var all = document.getElementsByClassName('mapboxgl-ctrl-icon.mapboxgl-ctrl-zoom-out');
					for (var i = 0; i < all.length; i++)
					{
						all[i].style.display = 'block';
					}
				}
				function closeNavShop() 
				{
					document.getElementById("menu_shop").style.display = "none";
					document.getElementById("menupadding").style.display = "none";
					document.getElementById("entire_thing_shop").style.width = "96px";
					document.getElementById("entire_thing_shop").style.height = "100px";
					document.getElementById('openbtnshop').innerHTML = '<a href="javascript:void(0)" onclick="openNavShop()">☰&nbsp; Cart</a>';
					document.getElementById("openbtnshop").style.width = "95px";
					document.getElementById("openbtnshop").style.left = "0px";
					document.getElementById("openbtnshop").style.top = "5px";
					document.getElementById('openbtn').style.display = "inline";				
					var all = document.getElementsByClassName('mapboxgl-ctrl-geocoder');
					//var all = document.getElementsByClassName('mapboxgl-ctrl-icon.mapboxgl-ctrl-zoom-out');
					ShopOpen = false;
					for (var i = 0; i < all.length; i++)
					{
						all[i].style.display = 'none';
					}
					//document.getElementById("map").style.width = "100%";
				}
		
				var getJSON = function(url, successHandler, errorHandler) {
				  var xhr = typeof XMLHttpRequest != 'undefined'
					? new XMLHttpRequest()
					: new ActiveXObject('Microsoft.XMLHTTP');
				  xhr.open('get', url, true);
				  xhr.onreadystatechange = function() {
					var status;
					var data;
					// https://xhr.spec.whatwg.org/#dom-xmlhttprequest-readystate
					if (xhr.readyState == 4) { // `DONE`
					  status = xhr.status;
					  if (status == 200) {
						data = JSON.parse(xhr.responseText);
						successHandler && successHandler(data);
					  } else {
						errorHandler && errorHandler(status);
					  }
					}
				  };
				  xhr.send();
				};	
										
				getJSON("https://api.mapbox.com/datasets/v1/resekartan/cm1mwsfmz0ssz1mmxjutycoso/features?limit=3000&access_token=pk.eyJ1IjoicmVzZWthcnRhbiIsImEiOiJjanZjbGdxMTExamxsNGRwZjQ1N3ZzOWlnIn0.Dhc7zI5xgvFB18J4eZn8iA", function(data) { // Replace <URL> With your URL
				
				//getJSON("https://resekartan.se/features.geojson", function(data) { //LOKAL SERVER KOPIA AV JSON!!!!!!!!!!!!!
				
				
				customData[0] = data; //store result in variable

	
	
				// Your code here....///
				///  Now you can access the json's data using customData variable:  //
				// customData[0].year will have the value of year key, customData[0].month will have month key and so on.... //
				console.log("Funkar???????????????????????????");
				console.log(customData[0]);

				}, function(status) { //error detection....
				  alert('Something went wrong.');
				});
				
				
				
				getJSON("https://api.mapbox.com/datasets/v1/resekartan/cm1mwsfmz0ssz1mmxjutycoso/features?limit=3000&start=26a5&access_token=pk.eyJ1IjoicmVzZWthcnRhbiIsImEiOiJjanZjbGdxMTExamxsNGRwZjQ1N3ZzOWlnIn0.Dhc7zI5xgvFB18J4eZn8iA", function(data) { // Replace <URL> With your URL
				
				//getJSON("https://resekartan.se/features.geojson", function(data) { //LOKAL SERVER KOPIA AV JSON!!!!!!!!!!!!!
				
				
				
				//Object.assign(customData, data);
				//customData = customData.concat(data);
				customData[1] = data;
				console.log(customData[1]);
	
				// Your code here....///
				///  Now you can access the json's data using customData variable:  //
				// customData[0].year will have the value of year key, customData[0].month will have month key and so on.... //
				console.log("Funkar???????????????????????????");

				}, function(status) { //error detection....
				  alert('Something went wrong.');
				});				


				getJSON("https://api.mapbox.com/datasets/v1/resekartan/cm1mwsfmz0ssz1mmxjutycoso/features?limit=3000&start=4e96&access_token=pk.eyJ1IjoicmVzZWthcnRhbiIsImEiOiJjanZjbGdxMTExamxsNGRwZjQ1N3ZzOWlnIn0.Dhc7zI5xgvFB18J4eZn8iA", function(data) { // Replace <URL> With your URL
				
				//getJSON("https://resekartan.se/features.geojson", function(data) { //LOKAL SERVER KOPIA AV JSON!!!!!!!!!!!!!
				
				
				
				customData[2] = data; //store result in variable
				console.log("Before Customdata33333333");
				console.log(customData[2]);
				console.log("After Customdata33333333");

				}, function(status) { //error detection....
				  alert('Something went wrong.');
				});			

				
				getJSON("https://api.mapbox.com/datasets/v1/resekartan/cm1mwsfmz0ssz1mmxjutycoso/features?limit=3000&start=7577&access_token=pk.eyJ1IjoicmVzZWthcnRhbiIsImEiOiJjanZjbGdxMTExamxsNGRwZjQ1N3ZzOWlnIn0.Dhc7zI5xgvFB18J4eZn8iA", function(data) { // Replace <URL> With your URL
				
				//getJSON("https://resekartan.se/features.geojson", function(data) { //LOKAL SERVER KOPIA AV JSON!!!!!!!!!!!!!
				
				
				
				customData[3] = data;   //store result in variable
				console.log(customData[3]);

	
				// Your code here....///
				///  Now you can access the json's data using customData variable:  //
				// customData[0].year will have the value of year key, customData[0].month will have month key and so on.... //
				console.log("Funkar???????????????????????????");

				}, function(status) { //error detection....
				  alert('Something went wrong.');
				});		
				
				getJSON("https://api.mapbox.com/datasets/v1/resekartan/cm1mwsfmz0ssz1mmxjutycoso/features?limit=3000&start=9c2c&access_token=pk.eyJ1IjoicmVzZWthcnRhbiIsImEiOiJjanZjbGdxMTExamxsNGRwZjQ1N3ZzOWlnIn0.Dhc7zI5xgvFB18J4eZn8iA", function(data) { // Replace <URL> With your URL
				
				//getJSON("https://resekartan.se/features.geojson", function(data) { //LOKAL SERVER KOPIA AV JSON!!!!!!!!!!!!!
				
				
				
				customData[4] = data;   //store result in variable
				console.log(customData[4]);

	
				// Your code here....///
				///  Now you can access the json's data using customData variable:  //
				// customData[0].year will have the value of year key, customData[0].month will have month key and so on.... //
				console.log("Funkar???????????????????????????");

				}, function(status) { //error detection....
				  alert('Something went wrong.');
				});		
								
				getJSON("https://api.mapbox.com/datasets/v1/resekartan/cm1mwsfmz0ssz1mmxjutycoso/features?limit=3000&start=c442&access_token=pk.eyJ1IjoicmVzZWthcnRhbiIsImEiOiJjanZjbGdxMTExamxsNGRwZjQ1N3ZzOWlnIn0.Dhc7zI5xgvFB18J4eZn8iA", function(data) { // Replace <URL> With your URL
				
				//getJSON("https://resekartan.se/features.geojson", function(data) { //LOKAL SERVER KOPIA AV JSON!!!!!!!!!!!!!
				
				
				
				customData[5] = data;  //store result in variable
				console.log(customData[5]);

				// Your code here....///
				///  Now you can access the json's data using customData variable:  //
				// customData[0].year will have the value of year key, customData[0].month will have month key and so on.... //
				console.log("Funkar???????????????????????????");

				}, function(status) { //error detection....
				  alert('Something went wrong.');
				});

				getJSON("https://api.mapbox.com/datasets/v1/resekartan/cm1mwsfmz0ssz1mmxjutycoso/features?limit=3000&start=e9fc&access_token=pk.eyJ1IjoicmVzZWthcnRhbiIsImEiOiJjanZjbGdxMTExamxsNGRwZjQ1N3ZzOWlnIn0.Dhc7zI5xgvFB18J4eZn8iA", function(data) { // Replace <URL> With your URL

				//getJSON("https://resekartan.se/features.geojson", function(data) { //LOKAL SERVER KOPIA AV JSON!!!!!!!!!!!!!
				
				
				
				customData[6] = data;  //store result in variable
				console.log(customData[6]);

	
				// Your code here....///
				///  Now you can access the json's data using customData variable:  //
				// customData[0].year will have the value of year key, customData[0].month will have month key and so on.... //
				console.log("Funkar???????????????????????????");

				}, function(status) { //error detection....
				  alert('Something went wrong.');
				});	

				
				mapboxgl.accessToken = 'pk.eyJ1IjoicmVzZWthcnRhbiIsImEiOiJjanVoYW5jdWkwNGF1M3ptb3hoYnJkbTkzIn0.Yt_FQx_n7KKwitn6cH487w';
				var alreadyopen = false;
			
				var map = new mapboxgl.Map(
				{
					container: 'map',
					style: 'mapbox://styles/resekartan/cm1qnu6vm00uj01r22s66aywt', //This is the theme. The one under "Styles" at studio.mapbox.

					<?php

						if (isValidLatitude($_GET['lat']) && isValidLongitude($_GET['lng'])&& is_numeric($_GET['zoom']))
						{
						echo "center: [" . $_GET['lng'] . ", " . $_GET['lat'] . "],";
							echo "zoom: " . (int)$_GET['zoom'] . ",";
						}
						else
						{
							echo "center: [26.483708, 36.077061],";
							echo "zoom: 1.5,";
						}
					?>
				});
				
				
				var distanceContainer = document.getElementById('distance');
 
				// GeoJSON object to hold our measurement features
				var geojson = [];
				 
				// Used to draw a line between points
				var linestring = [];
							
				var layerList = document.getElementById('menu');
				var inputs = layerList.getElementsByTagName('button');
				
				function switchLayer(layer)
				{
					var layerId = layer.target.id;
					map.setStyle('mapbox://styles/' + layerId);
				}
			
				for (var i = 0; i < inputs.length; i++)
				{
					inputs[i].onclick = switchLayer;
				}

				map.on('load', function ()
				{

					map.on('click', function(e) {
					if(ActivateDistance == true)
					{

					var features = map.queryRenderedFeatures(e.point, {
					layers: ['measure-points']
					});
					 
					// Remove the linestring from the group
					// So we can redraw it based on the points collection
					if (geojson.features.length > 1) geojson.features.pop();
					 
					// Clear the Distance container to populate it with a new value
					distanceContainer.innerHTML = '';
					 
					// If a feature was clicked, remove it from the map
					if (features.length) {
					var id = features[0].properties.id;
					geojson.features = geojson.features.filter(function(point) {
					return point.properties.id !== id;
					});
					} else {
					var point = {
					'type': 'Feature',
					'geometry': {
					'type': 'Point',
					'coordinates': [e.lngLat.lng, e.lngLat.lat]
					},
					'properties': {
					'id': String(new Date().getTime())
					}
					};
					 
					geojson.features.push(point);
					}
					 
					if (geojson.features.length > 1) {
					linestring.geometry.coordinates = geojson.features.map(function(
					point
					) {
					return point.geometry.coordinates;
					});
					 
					geojson.features.push(linestring);
					 
					// Populate the distanceContainer with total distance
					var value = document.createElement('pre');
					value.textContent =
					'Total distance: ' +
					turf.length(linestring).toLocaleString() +
					'km';
					distanceContainer.appendChild(value);
					}
					 
					map.getSource('geojson').setData(geojson);
					}
					});
					
					
					map.on('mousemove', function(e) 
					{
						if(ActivateDistance == true)
						{
							var features = map.queryRenderedFeatures(e.point, 
							{
								layers: ['measure-points']
							});
							// UI indicator for clicking/hovering a point on the map
							map.getCanvas().style.cursor = features.length
							? 'pointer'
							: 'crosshair';
						}
					});					
					document.getElementById("Check_green").checked = true;
					document.getElementById("Check_red").checked = true;
					document.getElementById("Check_yellow").checked = true;
					document.getElementById("Check_grey").checked = true;
					document.getElementById("Check_white").checked = true;
					document.getElementById("Check_blue").checked = true;
					document.getElementById("Check_darkred").checked = true;
					document.getElementById("Check_grey").checked = true;
					document.getElementById("Check_riskyarea").checked = true;
					document.getElementById("Check_nightlife").checked = true;
					document.getElementById("Check_dinner").checked = true;
					document.getElementById("Check_hotel").checked = true;
					document.getElementById("Check_red_line").checked = true;
					document.getElementById("Check_yellow_line").checked = true;
					document.getElementById("Check_grey_line").checked = true;
				});
				
				function EnableLine() 
				{
					if(ActivateDistance == false)
					{
						
						document.getElementById('lineiconcolor').innerHTML = '<img alt="" src="data:image/png;base64,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">';
						// GeoJSON object to hold our measurement features
						geojson = {
						'type': 'FeatureCollection',
						'features': []
						};
						 
						// Used to draw a line between points
						linestring = {
						'type': 'Feature',
						'geometry': {
						'type': 'LineString',
						'coordinates': []
						}
						};
						// Add styles to the map
						map.addSource('geojson', {
							'type': 'geojson',
							'data': geojson
						});
						map.addLayer({
						id: 'measure-points',
						type: 'circle',
						source: 'geojson',
						paint: {
						'circle-radius': 5,
						'circle-color': '#000'
						},
						filter: ['in', '$type', 'Point']
						});
						map.addLayer({
						id: 'measure-lines',
						type: 'line',
						source: 'geojson',
						layout: {
						'line-cap': 'square',
						'line-join': 'square'
						},
						paint: {
						'line-color': '#000',
						'line-width': 2.5
						},
						filter: ['in', '$type', 'LineString']
						});
						ActivateDistance = true;
					}
					else
					{
						document.getElementById('lineiconcolor').innerHTML = '<img alt="" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIgICB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiICAgeG1sbnM6aW5rc2NhcGU9Imh0dHA6Ly93d3cuaW5rc2NhcGUub3JnL25hbWVzcGFjZXMvaW5rc2NhcGUiICAgd2lkdGg9IjIwIiAgIGhlaWdodD0iMjAiICAgdmlld0JveD0iMCAwIDIwIDIwIiAgIGlkPSJzdmcxOTE2NyIgICB2ZXJzaW9uPSIxLjEiICAgaW5rc2NhcGU6dmVyc2lvbj0iMC45MStkZXZlbCtvc3htZW51IHIxMjkxMSIgICBzb2RpcG9kaTpkb2NuYW1lPSJsaW5lLnN2ZyI+ICA8ZGVmcyAgICAgaWQ9ImRlZnMxOTE2OSIgLz4gIDxzb2RpcG9kaTpuYW1lZHZpZXcgICAgIGlkPSJiYXNlIiAgICAgcGFnZWNvbG9yPSIjZmZmZmZmIiAgICAgYm9yZGVyY29sb3I9IiM2NjY2NjYiICAgICBib3JkZXJvcGFjaXR5PSIxLjAiICAgICBpbmtzY2FwZTpwYWdlb3BhY2l0eT0iMC4wIiAgICAgaW5rc2NhcGU6cGFnZXNoYWRvdz0iMiIgICAgIGlua3NjYXBlOnpvb209IjE2IiAgICAgaW5rc2NhcGU6Y3g9IjEyLjg5ODc3NSIgICAgIGlua3NjYXBlOmN5PSI5LjU4OTAxNTIiICAgICBpbmtzY2FwZTpkb2N1bWVudC11bml0cz0icHgiICAgICBpbmtzY2FwZTpjdXJyZW50LWxheWVyPSJsYXllcjEiICAgICBzaG93Z3JpZD0idHJ1ZSIgICAgIHVuaXRzPSJweCIgICAgIGlua3NjYXBlOndpbmRvdy13aWR0aD0iMTI4MCIgICAgIGlua3NjYXBlOndpbmRvdy1oZWlnaHQ9Ijc1MSIgICAgIGlua3NjYXBlOndpbmRvdy14PSIwIiAgICAgaW5rc2NhcGU6d2luZG93LXk9IjIzIiAgICAgaW5rc2NhcGU6d2luZG93LW1heGltaXplZD0iMCIgICAgIGlua3NjYXBlOm9iamVjdC1ub2Rlcz0idHJ1ZSI+ICAgIDxpbmtzY2FwZTpncmlkICAgICAgIHR5cGU9Inh5Z3JpZCIgICAgICAgaWQ9ImdyaWQxOTcxNSIgLz4gIDwvc29kaXBvZGk6bmFtZWR2aWV3PiAgPG1ldGFkYXRhICAgICBpZD0ibWV0YWRhdGExOTE3MiI+ICAgIDxyZGY6UkRGPiAgICAgIDxjYzpXb3JrICAgICAgICAgcmRmOmFib3V0PSIiPiAgICAgICAgPGRjOmZvcm1hdD5pbWFnZS9zdmcreG1sPC9kYzpmb3JtYXQ+ICAgICAgICA8ZGM6dHlwZSAgICAgICAgICAgcmRmOnJlc291cmNlPSJodHRwOi8vcHVybC5vcmcvZGMvZGNtaXR5cGUvU3RpbGxJbWFnZSIgLz4gICAgICAgIDxkYzp0aXRsZSAvPiAgICAgIDwvY2M6V29yaz4gICAgPC9yZGY6UkRGPiAgPC9tZXRhZGF0YT4gIDxnICAgICBpbmtzY2FwZTpsYWJlbD0iTGF5ZXIgMSIgICAgIGlua3NjYXBlOmdyb3VwbW9kZT0ibGF5ZXIiICAgICBpZD0ibGF5ZXIxIiAgICAgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCwtMTAzMi4zNjIyKSI+ICAgIDxwYXRoICAgICAgIHN0eWxlPSJjb2xvcjojMDAwMDAwO2Rpc3BsYXk6aW5saW5lO292ZXJmbG93OnZpc2libGU7dmlzaWJpbGl0eTp2aXNpYmxlO2ZpbGw6IzAwMDAwMDtmaWxsLW9wYWNpdHk6MTtmaWxsLXJ1bGU6bm9uemVybztzdHJva2U6bm9uZTtzdHJva2Utd2lkdGg6MzttYXJrZXI6bm9uZTtlbmFibGUtYmFja2dyb3VuZDphY2N1bXVsYXRlIiAgICAgICBkPSJtIDEzLjUsMTAzNS44NjIyIGMgLTEuMzgwNzEyLDAgLTIuNSwxLjExOTMgLTIuNSwyLjUgMCwwLjMyMDggMC4wNDYxNCwwLjYyNDQgMC4xNTYyNSwwLjkwNjMgbCAtMy43NSwzLjc1IGMgLTAuMjgxODM2LC0wLjExMDIgLTAuNTg1NDIxLC0wLjE1NjMgLTAuOTA2MjUsLTAuMTU2MyAtMS4zODA3MTIsMCAtMi41LDEuMTE5MyAtMi41LDIuNSAwLDEuMzgwNyAxLjExOTI4OCwyLjUgMi41LDIuNSAxLjM4MDcxMiwwIDIuNSwtMS4xMTkzIDIuNSwtMi41IDAsLTAuMzIwOCAtMC4wNDYxNCwtMC42MjQ0IC0wLjE1NjI1LC0wLjkwNjIgbCAzLjc1LC0zLjc1IGMgMC4yODE4MzYsMC4xMTAxIDAuNTg1NDIxLDAuMTU2MiAwLjkwNjI1LDAuMTU2MiAxLjM4MDcxMiwwIDIuNSwtMS4xMTkzIDIuNSwtMi41IDAsLTEuMzgwNyAtMS4xMTkyODgsLTIuNSAtMi41LC0yLjUgeiIgICAgICAgaWQ9InJlY3Q2NDY3IiAgICAgICBpbmtzY2FwZTpjb25uZWN0b3ItY3VydmF0dXJlPSIwIiAvPiAgPC9nPjwvc3ZnPg==">';
						ActivateDistance = false;
						map.removeLayer('measure-points');
						map.removeLayer('measure-lines');
						map.removeSource('geojson');
						map.getCanvas().style.cursor = '';
						distanceContainer.innerHTML = '';
						geojson = [];
						linestring = [];
					}
				}
				
				var toggleableLayerIds = ['yellow_markers', 'green_markers', 'blue_markers', 'darkred_markers', 'red_markers', 'grey_markers', 'white_markers', 'riskyarea_markers', 'nightlife_markers', 'restaurant_markers', 'accommodation_markers', 'line_red_markers', 'line_yellow_markers', 'line_grey_markers'];
			
				for (var i = 0; i < toggleableLayerIds.length; i++)
				{
					var id = toggleableLayerIds[i];

					map.on('click', id, function (e)
					{
						var coordinates = e.features[0].geometry.coordinates.slice();
						var description = e.features[0].properties.Description;
						var Filter = e.features[0].properties.Filter;
						var name = e.features[0].properties.Name;
						// Ensure that if the map is zoomed out such that multiple
						// copies of the feature are visible, the popup appears
						// over the copy being pointed to.

						while (Math.abs(e.lngLat.lng - coordinates[0]) > 180)
						{
							coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
						}
						var supercordfix = coordinates + ",";
						var cordfixed = supercordfix.split(",");
						var textinbox = ' ';
						if(Filter == 12 || Filter == 13 || Filter == 14)
						{
							textinbox = '<div class="wordWrap" style="font-size: 23px; font-family: Oswald; margin-top:15px; padding-bottom:12px;">' + name + '</div><div class="wordWrap" style="padding-bottom:18px;">' + description + '</div><hr><div style="text-align: center;"><div class="item_popup"><a href="https://www.google.se/search?q=' + encodeURIComponent(name)+ '" target="_blank"><img class="img_popup" alt="Info" src="/map-images/google.png"/></a><span class="caption">Info</span></div><br /><br /></div><hr><div style="text-align: center; font-weight: bold;">Proudly presented by:</div><div style="text-align: center;"><a href="https://resekartan.se/" target="_blank">https://resekartan.se</a></div>' + ''; //This line shows what's inside the infobox 						
						}
						else
						{
							textinbox = '<div class="wordWrap" style="font-size: 23px; font-family: Oswald; margin-top:15px; padding-bottom:12px;">' + name + '</div><div class="wordWrap" style="padding-bottom:18px;">' + description + '</div><hr><div style="text-align: center;"><div class="item_popup"><a href="https://www.google.se/maps/place/'+ cordfixed[1] + ',' + cordfixed[0] +'" target="_blank"><img class="img_popup" alt="Go" src="/map-images/location.png"/></a><span class="caption">Go</span></div><div class="item_popup"><a href="https://www.google.se/search?q=' + encodeURIComponent(name)+ '" target="_blank"><img class="img_popup" alt="Info" src="/map-images/google.png"/></a><span class="caption">Info</span></div><div class="item_popup"><a href="javascript:void(0)" onclick="savecart()"><img class="img_popup" alt="Add" src="/map-images/add.png"/></a><span class="caption_popup">Add</span></div><br /><br /></div><hr><div style="text-align: center; font-weight: bold;">Proudly presented by:</div><div style="text-align: center;"><a href="https://resekartan.se/" target="_blank">https://resekartan.se</a></div>' + ''; //This line shows what's inside the infobox
						}

						if (alreadyopen == false && ActivateDistance == false)
						{
							if(localStorage) 
							{
								$(document).ready(function() 
								{
								// Get input name
								titelSave = name;
								descriptionSave = description;
								coordinatesSave = cordfixed[0] + ', ' + cordfixed[1]; //coordinatesSave = coordinates;
								});
							}
							else 
							{
								alert("Sorry, your browser do not support local storage.");
							}
							alreadyopen = true;
							new mapboxgl.Popup()
							.setLngLat(e.lngLat)
							.setHTML(textinbox)
							.addTo(map);
						}
					});

					map.on('mouseenter', id, function ()
					{
						
						map.getCanvas().style.cursor = 'pointer';
					});

					map.on('mouseleave', id, function ()
					{
						map.getCanvas().style.cursor = '';
						alreadyopen = false;
					});
				}

				var nav = new mapboxgl.GeolocateControl(
				{
					positionOptions:
					{
						enableHighAccuracy: true
					},
					trackUserLocation: true
				});
						

				map.addControl(nav, 'top-left');
				

				function forwardGeocoder(query)
				{
					var matchingFeatures = [];
					for (var l = 0; l <= 6; l++)
					{
						console.log("Loop: " + l);
						for (var i = 0; i < customData[l].features.length; i++) 
						{
							var feature = customData[l].features[i];
							// handle queries with different capitalization than the source data by calling toLowerCase()
							if (feature.properties.Name.toLowerCase().search(query.toLowerCase()) !== -1)
							{
								// add a tree emoji as a prefix for custom data results
								// using carmen geojson format: https://github.com/mapbox/carmen/blob/master/carmen-geojson.md
								feature['place_name'] = '⭐ ' + feature.properties.Name;
								feature['center'] = feature.geometry.coordinates;
								feature['place_type'] = ['park'];
								matchingFeatures.push(feature);
							}
						}
					}
					return matchingFeatures;
				}
				
				var coordinatesGeocoder = function(query)
				{
					// match anything which looks like a decimal degrees coordinate pair
					var matches = query.match(
					/^[ ]*(?:Lat: )?(-?\d+\.?\d*)[, ]+(?:Lng: )?(-?\d+\.?\d*)[ ]*$/i
					);
					if (!matches)
					{
						return null;
					}
					 
					function coordinateFeature(lng, lat)
					{
						return {
							center: [lng, lat],
							geometry: {
								type: 'Point',
								coordinates: [lng, lat]
						},
						place_name: 'Lat: ' + lat + ' Lng: ' + lng,
						place_type: ['coordinate'],
						properties: {},
						type: 'Feature'
						};
					}
					 
					var coord1 = Number(matches[1]);
					var coord2 = Number(matches[2]);
					var geocodes = [];
					 
					if (coord1 < -90 || coord1 > 90)
					{
						// must be lng, lat
						geocodes.push(coordinateFeature(coord2, coord1));
					}
					 
					if (coord2 < -90 || coord2 > 90)
					{
						// must be lat, lng
						geocodes.push(coordinateFeature(coord1, coord2));
					}
					 
					if (geocodes.length === 0)
					{
						// else could be either lng, lat or lat, lng
						geocodes.push(coordinateFeature(coord2, coord1));
						geocodes.push(coordinateFeature(coord1, coord2));
					}
					return geocodes;
				};
				
				var geocoder = new MapboxGeocoder(
				{
					accessToken: mapboxgl.accessToken,
					localGeocoder: forwardGeocoder,
					zoom: 14,
					placeholder: "Search location...",
					mapboxgl: mapboxgl
				});

				geocoder.on('result', function (result)
				{
					closeNav();
					closeNavShop();
				});
			
				document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
			
				;(function($)
				{
					/**
					* jQuery function to prevent default anchor event and take the href * and the title to make a share popup
					*
					* @param  {[object]} e           [Mouse event]
					* @param  {[integer]} intWidth   [Popup width defalut 500]
					* @param  {[integer]} intHeight  [Popup height defalut 400]
					* @param  {[boolean]} blnResize  [Is popup resizeabel default true]
					*/
					$.fn.customerPopup = function (e, intWidth, intHeight, blnResize)
					{
						// Prevent default anchor event
						e.preventDefault();

						// Set values for window
						intWidth = intWidth || '500';
						intHeight = intHeight || '400';
						strResize = (blnResize ? 'yes' : 'no');

						// Set title and open popup with focus on it
						var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
						strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
						objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
					}

					/* ================================================== */

					$(document).ready(function ($)
					{
						$('.customer.share').on("click", function(e)
						{
							$(this).customerPopup(e);
						});
					});
				}(jQuery));


				function savecart()
				{
					if(localStorage) 
					{
						var tmpsearch = encodeURIComponent(JSON.stringify(CartString));
						var resdebug = tmpsearch.search(encodeURIComponent(titelSave+'","'+descriptionSave+'","'));
						if(resdebug == -1)
						{
							// Store data
							CartString.push(titelSave,descriptionSave,coordinatesSave);
							localStorage.setItem("titelSave", JSON.stringify(CartString));
							alert('Added to your cart');
							
							if(ShopOpen)
							{
								openNavShop();									
							}					
						}
						else
						{
							alert('This attraction is already in your cart');
						}
							
					}
					else
					{
						alert("Sorry, your browser do not support local storage.");
					}
				}
				
				var header = document.getElementById("buttonDIV");
				var btns = header.getElementsByClassName("btn");
				for (var i = 0; i < btns.length; i++) {
					btns[i].addEventListener("click", function() {
					var current = document.getElementsByClassName("active");
					current[0].className = current[0].className.replace(" active", "");
					this.className += " active";
					});
				}
			</script>
		</div>
	</body>
</html>
