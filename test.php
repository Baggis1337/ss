<!DOCTYPE html>
<html lang="en">
<head>
<meta name="format-detection" content="address=no">  <!-- gör inte länkar av adresser -->
    <meta charset="UTF-8">
<!-- Lägg till i <head> -->
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https://*.mapbox.com https://*.tiles.mapbox.com data: blob: 'unsafe-inline' 'unsafe-eval' https://unpkg.com https://events.mapbox.com; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://*.mapbox.com https://unpkg.com blob:; img-src 'self' data: blob: https://*.mapbox.com https://unpkg.com;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapbox Integration</title>
    
    <!-- External CSS Links -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.9.4/mapbox-gl.css" rel="stylesheet">  <!-- Uppdaterad 2025-02-12 -->
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.5.0/mapbox-gl-draw.css" type="text/css"> <!-- Uppdaterad 2025-02-12 -->
<script type="module">
    import * as turf from 'https://cdn.skypack.dev/@turf/turf';
    window.turf = turf; // Gör tillgänglig globalt om behövs
</script>
    <style>
/* Base Styles */
body, html {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: #333;
}

/* Map Container */
#map {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    transition: width 0.3s, height 0.3s;
}

/* Map Controls */
.mapboxgl-control-container .mapboxgl-ctrl-top-right {
    right: auto;
    left: 10px;
}

#distance-container {
    position: absolute;
    top: 119px;
    left: 8px;
    z-index: 1;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 5px 12px;
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-weight: bold;
    display: none;
    color: #333;
    border: 1px solid #ccc;
    height: 30px;
    align-items: center;
    box-sizing: border-box;
}

/* Measure Tool Styles */
.measure-active {
    background-color: #00b4ff !important;
}

.measure-active svg path {
    fill: white !important;
}

.mapbox-gl-draw_line {
    background-color: transparent;
    border: 0;
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 30px;
    outline: none;
    overflow: hidden;
    padding: 0;
    width: 30px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: 22px 22px;
    background-image: url(data:image/svg+xml;utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="22" height="22"%3E%3Cpath d="m13.5 3.5c-1.4 0-2.5 1.1-2.5 2.5 0 .3 0 .6.2.9l-3.8 3.8c-.3-.1-.6-.2-.9-.2-1.4 0-2.5 1.1-2.5 2.5s1.1 2.5 2.5 2.5 2.5-1.1 2.5-2.5c0-.3 0-.6-.2-.9l3.8-3.8c.3.1.6.2.9.2 1.4 0 2.5-1.1 2.5-2.5s-1.1-2.5-2.5-2.5z"/%3E%3C/svg%3E);
}

/* Map Controls Positioning */
.mapboxgl-ctrl-top-left .mapboxgl-ctrl {
    float: left;
    margin: 7px 0 0 10px !important;
}

.mapboxgl-ctrl-top-left .mapboxgl-ctrl:first-child {
    margin-top: 10px !important;
}

.mapboxgl-ctrl-geolocate,
.mapboxgl-ctrl-geolocate button,
.mapboxgl-ctrl-compass,
.mapboxgl-ctrl-compass button,
.mapboxgl-ctrl-group > button {
    width: 30px;
    height: 30px;
}

/* Sidebar Styles */
#sidebar {
    position: absolute;
    right: 0;
    top: 0;
    width: 20%;
    height: 100%;
    background-color: #333;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    transition: transform 0.3s, width 0.3s;
    transform: translateX(100%);
}

#sidebar.open {
    transform: translateX(0);
}

#sidebar-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    width: 100%;
    padding-top: 60px;
    flex: 1;
}

#button-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    width: 100%;
    flex-grow: 1;
    margin-top: 30%;
}

#sidebar button {
    background-color: #444;
    border: none;
    color: white;
    padding: 15px;
    margin: 10px;
    width: 90%;
    max-width: 200px;
    cursor: pointer;
    font-size: 16px;
}

#sidebar button:hover {
    background-color: #555;
}

#sidebar img {
    width: 80%;
    margin: 20px auto;
    display: block;
}

/* Menu Toggle Button */
.menu-toggle {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #333;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    z-index: 2;
    border-radius: 5px;
    font-size: 30px;
    line-height: 1;
}

/* Bottom Menu */
#bottom-menu {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 40%;
    background-color: #333;
    color: white;
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* Popup Styles */
.mapboxgl-popup {
    max-width: none !important;
    transform-origin: 50% 50% !important;
}

.mapboxgl-popup-content {
    width: 220px !important;
    padding: 20px !important;
    border-radius: 12px !important;
    background: linear-gradient(145deg, #2c2c2c, #383838) !important;
    color: white !important;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    position: relative;
    z-index: 2;
}

.popup-title {
    /* Grundläggande stilar */
    font-family: 'Oswald', sans-serif;
    font-size: 18px;
    margin-bottom: 16px;
    font-weight: bold;
    color: white;
    border-bottom: 2px solid #4a4a4a;
    padding-bottom: 12px;
    position: relative !important;
    z-index: 0 !important;
    padding-right: 25px !important;
	word-wrap: break-word !important;
}
.popup-description {
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 15px;
    color: #e0e0e0;
	word-wrap: break-word !important;
}

.popup-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-top: 20px;
}

.popup-action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(145deg, #383838, #2c2c2c);
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 13px;
}

.popup-action-btn:hover {
    background: linear-gradient(145deg, #404040, #343434);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.popup-action-btn i {
    margin-right: 6px;
    font-size: 16px;
}

.mapboxgl-popup-close-button {
    font-size: 24px !important;
    color: #fff !important;
    background-color: transparent !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    border-radius: 0 12px 0 0 !important;
    position: absolute !important;
    right: 0 !important;
    top: 0 !important;
    z-index: 1 !important;
    height: 40px !important;
    width: 40px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 !important;
    line-height: 1 !important;
}

.mapboxgl-popup-close-button:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: #ff4444 !important;
}

/* Popup-tip (pilen) styling - grundläggande */
.mapboxgl-popup-tip {
    border-style: solid !important;
    border-width: 10px !important;
}

/* Standard riktningar - behåll dessa som de är */
.mapboxgl-popup-anchor-top .mapboxgl-popup-tip {
    border-top-color: transparent !important;
    border-right-color: transparent !important;
    border-bottom-color: #2c2c2c !important;
    border-left-color: transparent !important;
}

.mapboxgl-popup-anchor-bottom .mapboxgl-popup-tip {
    border-top-color: #2c2c2c !important;
    border-right-color: transparent !important;
    border-bottom-color: transparent !important;
    border-left-color: transparent !important;
}

.mapboxgl-popup-anchor-left .mapboxgl-popup-tip {
    border-top-color: transparent !important;
    border-right-color: #2c2c2c !important;
    border-bottom-color: transparent !important;
    border-left-color: transparent !important;
}

.mapboxgl-popup-anchor-right .mapboxgl-popup-tip {
    border-top-color: transparent !important;
    border-right-color: transparent !important;
    border-bottom-color: transparent !important;
    border-left-color: #2c2c2c !important;
}

/* Uppdaterade hörnpositioner med justerade marginaler */
.mapboxgl-popup-anchor-top-left .mapboxgl-popup-tip {
    border-top-color: transparent !important;
    border-right-color: transparent !important;
    border-bottom-color: #2c2c2c !important;
    border-left-color: transparent !important;
    transform: rotate(-45deg) !important;
    position: relative !important;
    left: -8px !important;
    top: -8px !important;
}

.mapboxgl-popup-anchor-top-right .mapboxgl-popup-tip {
    border-top-color: transparent !important;
    border-right-color: transparent !important;
    border-bottom-color: #2c2c2c !important;
    border-left-color: transparent !important;
    transform: rotate(45deg) !important;
    position: relative !important;
    right: -8px !important;
    top: -8px !important;
}

.mapboxgl-popup-anchor-bottom-left .mapboxgl-popup-tip {
    border-top-color: #2c2c2c !important;
    border-right-color: transparent !important;
    border-bottom-color: transparent !important;
    border-left-color: transparent !important;
    transform: rotate(45deg) !important;
    position: relative !important;
    left: -8px !important;
    bottom: -8px !important;
}

.mapboxgl-popup-anchor-bottom-right .mapboxgl-popup-tip {
    border-top-color: #2c2c2c !important;
    border-right-color: transparent !important;
    border-bottom-color: transparent !important;
    border-left-color: transparent !important;
    transform: rotate(-45deg) !important;
    position: relative !important;
    right: -8px !important;
    bottom: -8px !important;
}

/* Custom Scrollbar */


.popup-description::-webkit-scrollbar {
    width: 6px;
}

.popup-description::-webkit-scrollbar-track {
    background: #2c2c2c;
}

.popup-description::-webkit-scrollbar-thumb {
    background: #4a4a4a;
    border-radius: 3px;
}

/* Ny styling för sociala medier ikoner */
.icon-container {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap; /* Lägg till denna */
    max-width: 180px; /* Lägg till denna */
    margin-left: auto; /* Lägg till denna */
    margin-right: auto; /* Lägg till denna */
}


.icon-container a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    color: #fff;
    transition: color 0.3s ease;
}

.icon-container a:hover {
    color: #00b4ff;
}

.icon-container svg {
    width: 100%;
    height: 100%;
}

.search-container {
    position: absolute;
    top: 10px;
    right: 60px; /* Placerar sökrutan till vänster om hamburgarmenyn */
    z-index: 2;
    width: 300px;
}

#search-box {
    width: 100%;
    height: 40px;
    background-color: #333333;
    border: 1px solid #444444;
    border-radius: 6px;
    padding: 0 15px;
    color: #ffffff;
    font-size: 14px;
    outline: none;
    transition: all 0.3s ease;
}

#search-box:focus {
    border-color: #666666;
    box-shadow: 0 0 0 2px rgba(68, 68, 68, 0.3);
}

#search-box::placeholder {
    color: #888888;
}

/* Search Results Container */
.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    margin-top: 5px;
    background-color: #333333;
    border: 1px solid #444444;
    border-radius: 6px;
    max-height: 400px;
    overflow-y: auto;
    display: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

    .result-badge {
        display: inline-block;
        background-color: #4a4a4a;
        color: #ffffff;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 11px;
        margin-top: 4px;
    }

.search-result-item {
    padding: 12px 15px;
    cursor: pointer;
    border-bottom: 1px solid #444444;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    gap: 4px;
}


.search-result-item:last-child {
    border-bottom: none;
}

.search-result-item:hover {
    background-color: #444444;
}

.result-title {
    color: #ffffff;
    font-size: 14px;
    margin-bottom: 4px;
}

.result-description {
    color: #888888;
    font-size: 12px;
}

/* Custom Scrollbar för sökresultat */
.search-results::-webkit-scrollbar {
    width: 6px;
}

.search-results::-webkit-scrollbar-track {
    background: #333333;
}

.search-results::-webkit-scrollbar-thumb {
    background: #444444;
    border-radius: 3px;
}

.search-results::-webkit-scrollbar-thumb:hover {
    background: #555555;
}


.highlight {
    background-color: rgba(49, 109, 202, 0.2);
    padding: 0 2px;
    border-radius: 2px;
}

/* Responsive Design */
@media (max-width: 768px) {
    /* Sidebar responsiveness */
    #sidebar {
        width: 50%;
    }
    #map {
        width: 100%;
    }
    #sidebar.open #map {
        width: 50%;
    }

    /* Icon container responsiveness */
    .icon-container {
        gap: 15px;
        max-width: 160px;
        padding: 0 10px;
    }

    .icon-container a {
        width: 28px;
        height: 28px;
    }
}
    </style>
</head>
<body>
    <div id="map"></div>
	<div class="search-container">
    <input type="text" id="search-box" placeholder="Search..." />
    <div id="search-results" class="search-results"></div>
</div>
    <button class="menu-toggle" onclick="toggleMenu()">☰</button>
    <div id="distance-container">Distance: <span id="calculated-distance">0</span> km (<span id="calculated-distance-miles">0</span> mi)</div>
<div id="sidebar">
    <div id="sidebar-content">
        <div id="button-container">
            <button onclick="selectTab('tab1')">Filter & Style</button>
            <button onclick="selectTab('tab2')">List Attractions</button>
            <button onclick="selectTab('tab3')">Saved Attractions</button>
            <button onclick="selectTab('tab4')">Help</button>
			   <div class="icon-container">
        <a href="https://www.facebook.com/resekartan" target="_blank" rel="noreferrer noopener" title="Facebook">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 2C6.5 2 2 6.5 2 12c0 5 3.7 9.1 8.4 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.3v7C18.3 21.1 22 17 22 12c0-5.5-4.5-10-10-10z" fill="currentColor"></path>
          </svg>
        </a>
        <a href="https://discord.gg/cyMWsETwvF" target="_blank" rel="noreferrer noopener" title="Discord">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M20.317 4.37a19.8 19.8 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.3 18.3 0 0 0-5.487 0a13 13 0 0 0-.617-1.25a.08.08 0 0 0-.079-.037A19.7 19.7 0 0 0 3.677 4.37a.1.1 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.08.08 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.08.08 0 0 0 .084-.028a14 14 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13 13 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10 10 0 0 0 .372-.292a.07.07 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.07.07 0 0 1 .078.01q.181.149.373.292a.077.077 0 0 1-.006.127a12.3 12.3 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.08.08 0 0 0 .084.028a19.8 19.8 0 0 0 6.002-3.03a.08.08 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.06.06 0 0 0-.031-.03M8.02 15.33c-1.182 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418m7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418" fill="currentColor"></path>
          </svg>
        </a>
        <a href="https://www.instagram.com/resekartan/" target="_blank" rel="noreferrer noopener" title="Instagram">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12,4.622c2.403,0,2.688,0.009,3.637,0.052c0.877,0.04,1.354,0.187,1.671,0.31c0.42,0.163,0.72,0.358,1.035,0.673 c0.315,0.315,0.51,0.615,0.673,1.035c0.123,0.317,0.27,0.794,0.31,1.671c0.043,0.949,0.052,1.234,0.052,3.637 s-0.009,2.688-0.052,3.637c-0.04,0.877-0.187,1.354-0.31,1.671c-0.163,0.42-0.358,0.72-0.673,1.035 c-0.315,0.315-0.615,0.51-1.035,0.673c-0.317,0.123-0.794,0.27-1.671,0.31c-0.949,0.043-1.233,0.052-3.637,0.052 s-2.688-0.009-3.637-0.052c-0.877-0.04-1.354-0.187-1.671-0.31c-0.42-0.163-0.72-0.358-1.035-0.673 c-0.315-0.315-0.51-0.615-0.673-1.035c-0.123-0.317-0.27-0.794-0.31-1.671C4.631,14.688,4.622,14.403,4.622,12 s0.009-2.688,0.052-3.637c0.04-0.877,0.187-1.354,0.31-1.671c0.163-0.42,0.358-0.72,0.673-1.035 c0.315-0.315,0.615-0.51,1.035-0.673c0.317-0.123,0.794-0.27,1.671-0.31C9.312,4.631,9.597,4.622,12,4.622 M12,3 C9.556,3,9.249,3.01,8.289,3.054C7.331,3.098,6.677,3.25,6.105,3.472C5.513,3.702,5.011,4.01,4.511,4.511 c-0.5,0.5-0.808,1.002-1.038,1.594C3.25,6.677,3.098,7.331,3.054,8.289C3.01,9.249,3,9.556,3,12c0,2.444,0.01,2.751,0.054,3.711 c0.044,0.958,0.196,1.612,0.418,2.185c0.23,0.592,0.538,1.094,1.038,1.594c0.5,0.5,1.002,0.808,1.594,1.038 c0.572,0.222,1.227,0.375,2.185,0.418C9.249,20.99,9.556,21,12,21s2.751-0.01,3.711-0.054c0.958-0.044,1.612-0.196,2.185-0.418 c0.592-0.23,1.094-0.538,1.594-1.038c0.5-0.5,0.808-1.002,1.038-1.594c0.222-0.572,0.375-1.227,0.418-2.185 C20.99,14.751,21,14.444,21,12s-0.01-2.751-0.054-3.711c-0.044-0.958-0.196-1.612-0.418-2.185c-0.23-0.592-0.538-1.094-1.038-1.594 c-0.5-0.5-1.002-0.808-1.594-1.038c-0.572-0.222-1.227-0.375-2.185-0.418C14.751,3.01,14.444,3,12,3L12,3z M12,7.378 c-2.552,0-4.622,2.069-4.622,4.622S9.448,16.622,12,16.622s4.622-2.069,4.622-4.622S14.552,7.378,12,7.378z M12,15 c-1.657,0-3-1.343-3-3s1.343-3,3-3s3,1.343,3,3S13.657,15,12,15z M16.804,6.116c-0.596,0-1.08,0.484-1.08,1.08 s0.484,1.08,1.08,1.08c0.596,0,1.08-0.484,1.08-1.08S17.401,6.116,16.804,6.116z" fill="currentColor"></path>
          </svg>
        </a>
        <a href="https://www.youtube.com/channel/UCjkKTWl9rXE6nHpqB80igmA" target="_blank" rel="noreferrer noopener" title="YouTube">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M21.8,8.001c0,0-0.195-1.378-0.795-1.985c-0.76-0.797-1.613-0.801-2.004-0.847c-2.799-0.202-6.997-0.202-6.997-0.202 h-0.009c0,0-4.198,0-6.997,0.202C4.608,5.216,3.756,5.22,2.995,6.016C2.395,6.623,2.2,8.001,2.2,8.001S2,9.62,2,11.238v1.517 c0,1.618,0.2,3.237,0.2,3.237s0.195,1.378,0.795,1.985c0.761,0.797,1.76,0.771,2.205,0.855c1.6,0.153,6.8,0.201,6.8,0.201 s4.203-0.006,7.001-0.209c0.391-0.047,1.243-0.051,2.004-0.847c0.6-0.607,0.795-1.985,0.795-1.985s0.2-1.618,0.2-3.237v-1.517 C22,9.62,21.8,8.001,21.8,8.001z M9.935,14.594l-0.001-5.62l5.404,2.82L9.935,14.594z" fill="currentColor"></path>
          </svg>
        </a>
        <a href="https://www.snapchat.com/add/resekartan" target="_blank" rel="noreferrer noopener" title="Snapchat">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12.065,2a5.526,5.526,0,0,1,3.132.892A5.854,5.854,0,0,1,17.326,5.4a5.821,5.821,0,0,1,.351,2.33q0,.612-.117,2.487a.809.809,0,0,0,.365.091,1.93,1.93,0,0,0,.664-.176,1.93,1.93,0,0,1,.664-.176,1.3,1.3,0,0,1,.729.234.7.7,0,0,1,.351.6.839.839,0,0,1-.41.7,2.732,2.732,0,0,1-.9.41,3.192,3.192,0,0,0-.9.378.728.728,0,0,0-.41.618,1.575,1.575,0,0,0,.156.56,6.9,6.9,0,0,0,1.334,1.953,5.6,5.6,0,0,0,1.881,1.315,5.875,5.875,0,0,0,1.042.3.42.42,0,0,1,.365.456q0,.911-2.852,1.341a1.379,1.379,0,0,0-.143.507,1.8,1.8,0,0,1-.182.605.451.451,0,0,1-.429.241,5.878,5.878,0,0,1-.807-.085,5.917,5.917,0,0,0-.833-.085,4.217,4.217,0,0,0-.807.065,2.42,2.42,0,0,0-.82.293,6.682,6.682,0,0,0-.755.5q-.351.267-.755.527a3.886,3.886,0,0,1-.989.436A4.471,4.471,0,0,1,11.831,22a4.307,4.307,0,0,1-1.256-.176,3.784,3.784,0,0,1-.976-.436q-.4-.26-.749-.527a6.682,6.682,0,0,0-.755-.5,2.422,2.422,0,0,0-.807-.293,4.432,4.432,0,0,0-.82-.065,5.089,5.089,0,0,0-.853.1,5,5,0,0,1-.762.1.474.474,0,0,1-.456-.241,1.819,1.819,0,0,1-.182-.618,1.411,1.411,0,0,0-.143-.521q-2.852-.429-2.852-1.341a.42.42,0,0,1,.365-.456,5.793,5.793,0,0,0,1.042-.3,5.524,5.524,0,0,0,1.881-1.315,6.789,6.789,0,0,0,1.334-1.953A1.575,1.575,0,0,0,6,12.9a.728.728,0,0,0-.41-.618,3.323,3.323,0,0,0-.9-.384,2.912,2.912,0,0,1-.9-.41.814.814,0,0,1-.41-.684.71.71,0,0,1,.338-.593,1.208,1.208,0,0,1,.716-.241,1.976,1.976,0,0,1,.625.169,2.008,2.008,0,0,0,.69.169.919.919,0,0,0,.416-.091q-.117-1.849-.117-2.474A5.861,5.861,0,0,1,6.385,5.4,5.516,5.516,0,0,1,8.625,2.819A7.075,7.075,0,0,1,12.062,2Z" fill="currentColor"></path>
          </svg>
        </a>
        <a href="https://www.tiktok.com/@resekartan" target="_blank" rel="noreferrer noopener" title="TikTok">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
            <path d="M16.708 0.027c1.745-0.027 3.48-0.011 5.213-0.027 0.105 2.041 0.839 4.12 2.333 5.563 1.491 1.479 3.6 2.156 5.652 2.385v5.369c-1.923-0.063-3.855-0.463-5.6-1.291-0.76-0.344-1.468-0.787-2.161-1.24-0.009 3.896 0.016 7.787-0.025 11.667-0.104 1.864-0.719 3.719-1.803 5.255-1.744 2.557-4.771 4.224-7.88 4.276-1.907 0.109-3.812-0.411-5.437-1.369-2.693-1.588-4.588-4.495-4.864-7.615-0.032-0.667-0.043-1.333-0.016-1.984 0.24-2.537 1.495-4.964 3.443-6.615 2.208-1.923 5.301-2.839 8.197-2.297 0.027 1.975-0.052 3.948-0.052 5.923-1.323-0.428-2.869-0.308-4.025 0.495-0.844 0.547-1.485 1.385-1.819 2.333-0.276 0.676-0.197 1.427-0.181 2.145 0.317 2.188 2.421 4.027 4.667 3.828 1.489-0.016 2.916-0.88 3.692-2.145 0.251-0.443 0.532-0.896 0.547-1.417 0.131-2.385 0.079-4.76 0.095-7.145 0.011-5.375-0.016-10.735 0.025-16.093z" fill="currentColor"></path>
          </svg>
        </a>
        <a href="https://resekartan.se/kontakt" target="_blank" rel="noreferrer noopener" title="Mejla mig">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M20,4H4C2.895,4,2,4.895,2,6v12c0,1.105,0.895,2,2,2h16c1.105,0,2-0.895,2-2V6C22,4.895,21.105,4,20,4z M20,8.236l-8,4.882 L4,8.236V6h16V8.236z" fill="currentColor"></path>
          </svg>
        </a>
      </div>
        </div>
        <div id="tab-content"></div>
        <!-- Flyttad hit inuti sidebar-content -->
		
		
        <img src="map-images/resekartan-logo.png" alt="Resekartan Logo">
		
		
    </div>
</div>
    <div id="bottom-menu">
        <h2>List Attractions</h2>
    </div>

    <!-- Scripts -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.9.4/mapbox-gl.js"></script> <!-- Uppdaterad 2025-02-12 -->
    <script src='https://unpkg.com/@turf/turf@7.2.0/turf.min.js'></script> <!-- Uppdaterad 2025-02-12 -->

<script>
  // Mapbox configuration
mapboxgl.accessToken = 'pk.eyJ1IjoicmVzZWthcnRhbiIsImEiOiJjanVoYW5jdWkwNGF1M3ptb3hoYnJkbTkzIn0.Yt_FQx_n7KKwitn6cH487w';

// Konfigurera offline-hantering
mapboxgl.setOffline(true);

// Lägg till detta före map.on('load')
if (!('geolocation' in navigator)) {
    console.warn('Geolocation is not supported by this browser');
} else {
    map.on('load', () => {
        const geolocateControl = new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true,
                timeout: 6000
            },
            trackUserLocation: true,
            showUserLocation: true
        });
        map.addControl(geolocateControl, 'top-left');
    });
}

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/resekartan/cm1qnu6vm00uj01r22s66aywt',
    center: [18.0686, 59.3293],
    zoom: 9,
    minZoom: 3,
    maxZoom: 18,
    attributionControl: false,
    preserveDrawingBuffer: true,
    localIdeographFontFamily: "'Noto Sans', 'Noto Sans CJK SC', sans-serif",
    transformRequest: (url, resourceType) => {
        // Hantera events.mapbox.com fel
        if (url.includes('events.mapbox.com')) {
            return { url: 'about:blank' };
        }
        return { url };
    }
});

// Lägg till felhantering
map.on('error', (e) => {
    if (e.error && (e.error.status === 'ErrorEvent' || e.error.message.includes('events.mapbox.com'))) {
        console.warn('Mapbox event logging failed - continuing without logging');
        return;
    }
    console.error('Mapbox error:', e.error);
});

// Hantera expression-utvärderingsfel
map.on('style.load', () => {
    map.setFilter('road-label', ['all',
        ['has', 'name'],
        ['case',
            ['has', 'len'],
            ['>', ['number', ['get', 'len']], 0],
            true
        ]
    ]);
});

const searchBox = document.getElementById('search-box');

    // Sökkonfiguration
    const SEARCH_CONFIG = {
        types: [
            'country',
            'region',
            'postcode',
            'district',
            'place',
            'locality',
            'neighborhood',
            'address',
            'poi'
        ],
        customTileset: 'resekartan.cm1mwsfmz0ssz1mmxjutycoso-2uzy7'
    };

    // Measurement variables
    let measurementActive = false;
    let points = [];
    let measureButton = null;

    // Initialize map controls and layers
  map.on('load', () => {
    // Add Navigation Control
const navControl = new mapboxgl.NavigationControl({
    showCompass: true,
    showZoom: false,
    visualizePitch: true
});

// Lägg till passive event listeners
document.addEventListener('touchmove', () => {}, { passive: true });
    map.addControl(navControl, 'top-left');

    // Kontrollera om geolocation stöds innan vi lägger till kontrollen
    if ("geolocation" in navigator) {
        const geolocateControl = new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true,
                timeout: 6000
            },
            trackUserLocation: true,
            showUserLocation: true,
            showUserHeading: true
        });
        map.addControl(geolocateControl, 'top-left');
    } else {
        console.warn('Geolocation is not supported by this browser');
    }

        // Add Measurement Line Source
        map.addSource('measure-line', {
            type: 'geojson',
            data: {
                type: 'Feature',
                properties: {},
                geometry: {
                    type: 'LineString',
                    coordinates: []
                }
            }
        });

        // Add Measurement Line Layer
        map.addLayer({
            id: 'measure-line',
            type: 'line',
            source: 'measure-line',
            paint: {
                'line-color': '#438EE4',
                'line-width': 2
            }
        });

        // Add Measurement Points Source
        map.addSource('measure-points', {
            type: 'geojson',
            data: {
                type: 'FeatureCollection',
                features: []
            }
        });

        // Add Measurement Points Layer
        map.addLayer({
            id: 'measure-points',
            type: 'circle',
            source: 'measure-points',
            paint: {
                'circle-radius': 5,
                'circle-color': '#438EE4'
            }
        });

        // Add Measure Control
        const measureControl = document.createElement('div');
        measureControl.className = 'mapboxgl-ctrl mapboxgl-ctrl-group';
        measureButton = document.createElement('button');
        measureButton.className = 'mapbox-gl-draw_line';
        measureButton.title = 'Draw Line';
        measureControl.appendChild(measureButton);
        document.querySelector('.mapboxgl-ctrl-top-left').appendChild(measureControl);

        measureButton.addEventListener('click', toggleMeasurement);

        // Initialize clickable points and lines
        addClickablePointsAndLines();
    });
	
	// Lägg till throttling för map.triggerRepaint
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

const throttledRepaint = throttle(() => {
    map.triggerRepaint();
}, 16); // ~60fps

// Använd throttledRepaint istället för direkt triggerRepaint
map.on('move', throttledRepaint);
	function addClickablePointsAndLines() {
        let currentPopup = null;

        const allLayers = [
            'yellow_markers', 
            'green_markers', 
            'blue_markers', 
            'darkred_markers', 
            'red_markers', 
            'grey_markers', 
            'white_markers', 
            'riskyarea_markers', 
            'nightlife_markers', 
            'restaurant_markers', 
            'accommodation_markers',
            'line_red_markers', 
            'line_yellow_markers', 
            'line_grey_markers'
        ];

        // Close popup on map click
        map.on('click', () => {
            if (currentPopup) {
                currentPopup.remove();
                currentPopup = null;
            }
        });

        // Sökfunktionalitet
        const searchBox = document.getElementById('search-box');

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        const debouncedSearch = debounce((query) => {
            performSearch(query);
        }, 300);

        searchBox.addEventListener('input', (e) => {
            const query = e.target.value.trim();
            if (query.length < 2) {
                document.getElementById('search-results').style.display = 'none';
                return;
            }
            debouncedSearch(query);
        });

        // Stäng sökresultat när man klickar utanför
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-container')) {
                document.getElementById('search-results').style.display = 'none';
            }
        });
		allLayers.forEach(layerId => {
            map.on('click', layerId, (e) => {
                e.originalEvent.stopPropagation();

                if (currentPopup) {
                    currentPopup.remove();
                }

                const feature = e.features[0];
                const coordinates = feature.geometry.type === 'Point' 
                    ? feature.geometry.coordinates.slice()
                    : e.lngLat;

                if (feature.geometry.type === 'Point') {
                    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                    }
                }

                const description = `
                    <div class="popup-title">${feature.properties.Name || 'N/A'}</div> 
                    <div class="popup-description">${feature.properties.Description}</div>
                    <div class="popup-actions">
                        <button class="popup-action-btn" onclick="navigateToLocation([${coordinates}])">
                            <i class="fas fa-directions"></i> Navigate
                        </button>
                        <button class="popup-action-btn" onclick="saveAttraction('${feature.properties.Name?.replace(/'/g, "\\'")}')">
                            <i class="fas fa-bookmark"></i> Save
                        </button>
                        <button class="popup-action-btn" onclick="searchGoogleImages('${feature.properties.Name?.replace(/'/g, "\\'")}')">
                            <i class="fas fa-images"></i> Images
                        </button>
                        <button class="popup-action-btn" onclick="searchGoogle('${feature.properties.Name?.replace(/'/g, "\\'")}')">
                            <i class="fas fa-search"></i> Info
                        </button>
                    </div>
                `;

                currentPopup = new mapboxgl.Popup({
                    closeButton: true,
                    closeOnClick: false
                })
                .setLngLat(coordinates)
                .setHTML(description)
                .addTo(map);

                currentPopup.on('close', () => {
                    currentPopup = null;
                });
            });

            map.on('mouseenter', layerId, () => {
                map.getCanvas().style.cursor = 'pointer';
            });

            map.on('mouseleave', layerId, () => {
                map.getCanvas().style.cursor = '';
            });
        });
    }

    // Sökfunktioner
    async function performSearch(query) {
        try {
            const [tilesetResults, geocodingResults] = await Promise.all([
                searchCustomTileset(query),
                searchMapboxGeocoding(query)
            ]);
            displayResults([...tilesetResults, ...geocodingResults], query);
        } catch (error) {
            console.error('Search error:', error);
        }
    }

    async function searchCustomTileset(query) {
        const params = new URLSearchParams({
            access_token: mapboxgl.accessToken,
            tilesets: SEARCH_CONFIG.customTileset,
            limit: 5,
            types: 'poi',
            fuzzyMatch: 'true',
            language: 'sv',
            proximity: `${map.getCenter().lng},${map.getCenter().lat}`,
            bbox: '10.5,55.0,24.5,69.5'
        });

        try {
            const response = await fetch(
                `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(query)}.json?${params}`
            );
            const data = await response.json();
            const features = data.features || [];
            return features.filter(feature => 
                feature.id?.startsWith(SEARCH_CONFIG.customTileset)
            );
        } catch (error) {
            console.error('Tileset search error:', error);
            return [];
        }
    }
	async function searchMapboxGeocoding(query) {
        const params = new URLSearchParams({
            access_token: mapboxgl.accessToken,
            types: SEARCH_CONFIG.types.join(','),
            country: 'se',
            language: 'sv',
            limit: 5,
            proximity: `${map.getCenter().lng},${map.getCenter().lat}`,
            fuzzyMatch: 'true',
            bbox: '10.5,55.0,24.5,69.5'
        });

        try {
            const response = await fetch(
                `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(query)}.json?${params}`
            );
            const data = await response.json();
            const features = data.features || [];
            return features.filter(feature => 
                !feature.id?.startsWith(SEARCH_CONFIG.customTileset)
            );
        } catch (error) {
            console.error('Geocoding search error:', error);
            return [];
        }
    }

    function highlightMatch(text, query) {
        if (!text || !query) return text;
        try {
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<span class="highlight">$1</span>');
        } catch (e) {
            return text;
        }
    }

    function displayResults(results, query) {
        const searchResults = document.getElementById('search-results');
        
        if (!results.length) {
            searchResults.style.display = 'none';
            return;
        }

        searchResults.innerHTML = '';
        searchResults.style.display = 'block';

        const sortedResults = results.sort((a, b) => {
            if (a.properties && a.properties.Name) return -1;
            if (b.properties && b.properties.Name) return 1;
            return 0;
        });

        sortedResults.forEach(result => {
            const resultItem = document.createElement('div');
            resultItem.className = 'search-result-item';
            
            const isCustomPoint = result.properties && result.properties.Name;
            const title = isCustomPoint ? result.properties.Name : result.place_name;
            const description = isCustomPoint ? 
                result.properties.Description : 
                (result.place_type ? result.place_type.join(', ') : '');

            resultItem.innerHTML = `
                <div class="result-title">${highlightMatch(title, query)}</div>
                ${description ? `<div class="result-description">${description}</div>` : ''}
                ${isCustomPoint ? '<div class="result-badge">Resekartan Point</div>' : ''}
            `;

            resultItem.addEventListener('click', () => {
                const coordinates = result.geometry.coordinates;
                
                map.flyTo({
                    center: coordinates,
                    zoom: 15,
                    essential: true
                });
                
                if (isCustomPoint) {
                    new mapboxgl.Popup()
                        .setLngLat(coordinates)
                        .setHTML(`
                            <div class="popup-title">${result.properties.Name}</div>
                            <div class="popup-description">${result.properties.Description || ''}</div>
                            <div class="popup-actions">
                                <button class="popup-action-btn" onclick="navigateToLocation([${coordinates}])">
                                    <i class="fas fa-directions"></i> Navigate
                                </button>
                                <button class="popup-action-btn" onclick="saveAttraction('${result.properties.Name?.replace(/'/g, "\\'")}')">
                                    <i class="fas fa-bookmark"></i> Save
                                </button>
                            </div>
                        `)
                        .addTo(map);
                }
                
                searchResults.style.display = 'none';
                searchBox.value = title;
            });

            searchResults.appendChild(resultItem);
        });
    }

    // Measurement functionality
    function toggleMeasurement() {
        measurementActive = !measurementActive;

        if (measurementActive) {
            measureButton.classList.add('measure-active');
            map.getCanvas().style.cursor = 'crosshair';
        } else {
            measureButton.classList.remove('measure-active');
            map.getCanvas().style.cursor = '';
            points = [];
            updateLine();
            updatePoints();
            document.getElementById('distance-container').style.display = 'none';
        }
    }
	map.on('click', (e) => {
        if (!measurementActive) return;

        points.push([e.lngLat.lng, e.lngLat.lat]);
        updateLine();
        updatePoints();

        if (points.length > 0) {
            const distanceContainer = document.getElementById('distance-container');
            distanceContainer.style.display = 'flex';

            if (points.length >= 2) {
                const lengthKm = turf.length(turf.lineString(points), {units: 'kilometers'});
                const lengthMi = lengthKm * 0.621371;
                document.getElementById('calculated-distance').textContent = Math.round(lengthKm * 100) / 100;
                document.getElementById('calculated-distance-miles').textContent = Math.round(lengthMi * 100) / 100;
            }
        }
    });

    map.on('mousemove', (e) => {
        if (!measurementActive || points.length === 0) return;

        const currentPoints = [...points, [e.lngLat.lng, e.lngLat.lat]];
        updateLine(currentPoints);

        if (points.length >= 1) {
            const lengthKm = turf.length(turf.lineString(currentPoints), {units: 'kilometers'});
            const lengthMi = lengthKm * 0.621371;
            document.getElementById('calculated-distance').textContent = Math.round(lengthKm * 100) / 100;
            document.getElementById('calculated-distance-miles').textContent = Math.round(lengthMi * 100) / 100;
        }
    });

    function updateLine(coords = points) {
        map.getSource('measure-line').setData({
            type: 'Feature',
            properties: {},
            geometry: {
                type: 'LineString',
                coordinates: coords
            }
        });
    }

    function updatePoints() {
        const features = points.map(point => ({
            type: 'Feature',
            properties: {},
            geometry: {
                type: 'Point',
                coordinates: point
            }
        }));
        map.getSource('measure-points').setData({
            type: 'FeatureCollection',
            features: features
        });
    }

    // Helper functions for buttons
    function navigateToLocation(coords) {
        const url = `https://www.google.com/maps/dir/?api=1&destination=${coords[1]},${coords[0]}`;
        window.open(url, '_blank');
    }

    function searchGoogle(name) {
        const url = `https://www.google.com/search?q=${encodeURIComponent(name)}`;
        window.open(url, '_blank');
    }

    function searchGoogleImages(name) {
        const url = `https://www.google.com/search?q=${encodeURIComponent(name)}&tbm=isch`;
        window.open(url, '_blank');
    }

    function saveAttraction(name) {
        try {
            const saved = localStorage.getItem('savedAttractions') || '[]';
            const attractions = JSON.parse(saved);
            if (!attractions.includes(name)) {
                attractions.push(name);
                localStorage.setItem('savedAttractions', JSON.stringify(attractions));
                alert(`${name} har sparats till dina favoriter!`);
            } else {
                alert(`${name} finns redan i dina favoriter!`);
            }
        } catch (error) {
            console.error('Fel vid sparande av attraktion:', error);
            alert('Ett fel uppstod när attraktionen skulle sparas');
        }
    }
	
	// UI functionality
    function toggleMenu() {
        const sidebar = document.getElementById('sidebar');
        const mapElement = document.getElementById('map');
        const bottomMenu = document.getElementById('bottom-menu');
        const buttonContainer = document.getElementById('button-container');
        const tabContent = document.getElementById('tab-content');

        if (bottomMenu.style.display === 'flex') {
            bottomMenu.style.display = 'none';
            mapElement.style.width = '100%';
            mapElement.style.height = '100%';
            buttonContainer.style.display = 'flex';
            tabContent.style.display = 'none';
        } else {
            if (sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
                mapElement.style.width = '100%';
                mapElement.style.height = '100%';
                buttonContainer.style.display = 'flex';
                tabContent.style.display = 'none';
            } else {
                sidebar.classList.add('open');
                mapElement.style.width = window.innerWidth <= 768 ? '50%' : '80%';
            }
        }

        setTimeout(() => {
            map.resize();
        }, 300);
    }

    function selectTab(tabId) {
        const buttonContainer = document.getElementById('button-container');
        const tabContent = document.getElementById('tab-content');
        const bottomMenu = document.getElementById('bottom-menu');
        const mapElement = document.getElementById('map');
        const sidebar = document.getElementById('sidebar');

        buttonContainer.style.display = 'none';
        tabContent.innerHTML = '';
        tabContent.style.display = 'none';
        bottomMenu.style.display = 'none';

        switch (tabId) {
            case 'tab1':
                tabContent.innerHTML = '<h2>Filter & Style</h2><p>Innehåll för Filter & Style</p>';
                tabContent.className = 'tab1';
                tabContent.style.display = 'block';
                break;
            case 'tab3':
                tabContent.innerHTML = '<h2>Saved Attractions</h2><p>Innehåll för Saved Attractions</p>';
                tabContent.className = 'tab3';
                tabContent.style.display = 'block';
                break;
            case 'tab4':
                tabContent.innerHTML = '<h2>Help</h2><p>Innehåll för Help</p>';
                tabContent.className = 'tab4';
                tabContent.style.display = 'block';
                break;
            case 'tab2':
                sidebar.classList.remove('open');
                mapElement.style.width = '100%';
                mapElement.style.height = '60%';
                bottomMenu.style.display = 'flex';
                break;
        }

        setTimeout(() => {
            map.resize();
        }, 300);
    }

    function navigateToLocation(coords) {
        const lat = coords[1];
        const lng = coords[0];
        
        const isAppleDevice = /iPhone|iPad|iPod|Mac/i.test(navigator.userAgent);
        
        const navigationUrls = {
            googleMaps: `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`,
            appleMaps: isAppleDevice ? 
                `http://maps.apple.com/?daddr=${lat},${lng}&dirflg=d` : 
                `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`,
            waze: `https://www.waze.com/live-map/directions?to=ll.${lat}%2C${lng}`
        };

        const toggleBodyScroll = (disable) => {
            document.body.style.overflow = disable ? 'hidden' : '';
            document.body.style.position = disable ? 'fixed' : '';
            document.body.style.width = disable ? '100%' : '';
        };

        const mapChoice = document.createElement('div');
        mapChoice.className = 'map-choice-dialog';
        mapChoice.innerHTML = `
            <div class="map-choice-content">
                <h3>Navigation App</h3>
                <button onclick="window.open('${navigationUrls.googleMaps}', '_blank')" class="google-maps-btn">
                    <svg class="nav-icon google-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 232597 333333">
                        <path d="M151444 5419C140355 1916 128560 0 116311 0 80573 0 48591 16155 27269 41534l54942 46222 69232-82338z" fill="#1a73e8"/>
                        <path d="M27244 41534C10257 61747 0 87832 0 116286c0 21876 4360 39594 11517 55472l70669-84002-54942-46222z" fill="#ea4335"/>
                        <path d="M116311 71828c24573 0 44483 19910 44483 44483 0 10938-3957 20969-10509 28706 0 0 35133-41786 69232-82313-14089-27093-38510-47936-68048-57286L82186 87756c8166-9753 20415-15928 34125-15928z" fill="#4285f4"/>
                        <path d="M116311 160769c-24573 0-44483-19910-44483-44483 0-10863 3906-20818 10358-28555l-70669 84027c12072 26791 32159 48289 52851 75381l85891-102122c-8141 9628-20339 15752-33948 15752z" fill="#fbbc04"/>
                        <path d="M148571 275014c38787-60663 84026-88210 84026-158728 0-19331-4738-37552-13080-53581L64393 247140c6578 8620 13206 17793 19683 27900 23590 36444 17037 58294 32260 58294 15172 0 8644-21876 32235-58320z" fill="#34a853"/>
                    </svg>
                    Google Maps
                </button>
                <button onclick="window.open('${navigationUrls.appleMaps}', '_blank')" class="apple-maps-btn">
                    <svg class="nav-icon apple-icon" viewBox="0 0 814 1000">
                        <path d="M788.1 340.9c-5.8 4.5-108.2 62.2-108.2 190.5 0 148.4 130.3 200.9 134.2 202.2-.6 3.2-20.7 71.9-68.7 141.9-42.8 61.6-87.5 123.1-155.5 123.1s-85.5-39.5-164-39.5c-76.5 0-103.7 40.8-165.9 40.8s-105.6-57-155.5-127C46.7 790.7 0 663 0 541.8c0-194.4 126.4-297.5 250.8-297.5 66.1 0 121.2 43.4 162.7 43.4 39.5 0 101.1-46 176.3-46 28.5 0 130.9 2.6 198.3 99.2zm-234-181.5c31.1-36.9 53.1-88.1 53.1-139.3 0-7.1-.6-14.3-1.9-20.1-50.6 1.9-110.8 33.7-147.1 75.8-28.5 32.4-55.1 83.6-55.1 135.5 0 7.8 1.3 15.6 1.9 18.1 3.2.6 8.4 1.3 13.6 1.3 45.4 0 102.5-30.4 135.5-71.3z" fill="#cccccc"/>
                    </svg>
                    Apple Maps
                </button>
                <button onclick="window.open('${navigationUrls.waze}', '_blank')" class="waze-btn">
                    <svg class="nav-icon waze-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M13.314 1.59c-.225.003-.45.013-.675.03-2.165.155-4.295.924-6.069 2.327-2.194 1.732-3.296 4.325-3.496 7.05h.002c-.093 1.22-.23 2.15-.469 2.63-.238.479-.42.638-1.24.639C.27 14.259-.4 15.612.266 16.482c1.248 1.657 2.902 2.705 4.72 3.364a2.198 2.198 0 00-.033.367 2.198 2.198 0 002.2 2.197 2.198 2.198 0 002.128-1.668c1.307.12 2.607.14 3.824.1.364-.012.73-.045 1.094-.092a2.198 2.198 0 002.127 1.66 2.198 2.198 0 002.2-2.197 2.198 2.198 0 00-.151-.797 12.155 12.155 0 002.303-1.549c2.094-1.807 3.511-4.399 3.302-7.404-.112-1.723-.761-3.298-1.748-4.608-2.143-2.86-5.53-4.309-8.918-4.265zm.366 1.54c.312.008.623.027.933.063 2.48.288 4.842 1.496 6.4 3.577v.001c.829 1.1 1.355 2.386 1.446 3.792v.003c.173 2.477-.965 4.583-2.777 6.147a10.66 10.66 0 01-2.375 1.535 2.198 2.198 0 00-.98-.234 2.198 2.198 0 00-1.934 1.158 9.894 9.894 0 01-1.338.146 27.323 27.323 0 01-3.971-.148 2.198 2.198 0 00-1.932-1.156 2.198 2.198 0 00-1.347.463c-1.626-.553-3.078-1.422-4.155-2.762 1.052-.096 1.916-.6 2.319-1.408.443-.889.53-1.947.625-3.198v-.002c.175-2.391 1.11-4.536 2.92-5.964h.002c1.77-1.402 3.978-2.061 6.164-2.012zm-3.157 4.638c-.688 0-1.252.579-1.252 1.298 0 .72.564 1.297 1.252 1.297.689 0 1.252-.577 1.252-1.297 0-.711-.563-1.298-1.252-1.298zm5.514 0c-.688 0-1.25.579-1.25 1.298-.008.72.554 1.297 1.25 1.297.688 0 1.252-.577 1.252-1.297 0-.711-.564-1.298-1.252-1.298zM9.641 11.78a.72.72 0 00-.588.32.692.692 0 00-.11.54c.345 1.783 2.175 3.129 4.264 3.129h.125c1.056-.032 2.026-.343 2.816-.922.767-.556 1.29-1.316 1.477-2.137a.746.746 0 00-.094-.547.69.69 0 00-.445-.32.714.714 0 00-.867.539c-.22.93-1.299 1.9-2.934 1.94-1.572.046-2.738-.986-2.926-1.956a.72.72 0 00-.718-.586Z" fill="#33ccff"/>
                    </svg>
                    Waze
                </button>
                <button class="cancel-btn" onclick="this.closest('.map-choice-dialog').remove(); toggleBodyScroll(false)">
                    Cancel
                </button>
            </div>
        `;
        
        if (!document.querySelector('#map-choice-styles')) {
            const style = document.createElement('style');
            style.id = 'map-choice-styles';
            style.textContent = `
                .map-choice-dialog {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.7);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 10000;
                    -webkit-overflow-scrolling: touch;
                }
                .map-choice-content {
                    background: #2d333b;
                    padding: 20px;
                    border-radius: 6px;
                    text-align: center;
                    max-width: 300px;
                    width: 90%;
                    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
                    position: relative;
                    margin: auto;
                }
                .map-choice-content h3 {
                    margin: 0 0 15px 0;
                    color: #FFFAFA;
                    font-size: 16px;
                    font-weight: 600;
                }
                .map-choice-content button {
                    display: block;
                    width: 100%;
                    padding: 12px;
                    margin: 8px 0;
                    border: 1px solid #444c56;
                    border-radius: 6px;
                    background: #22272e;
                    color: #adbac7;
                    font-size: 14px;
                    cursor: pointer;
                    transition: all 0.2s;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .nav-icon {
                    margin-right: 8px;
                    width: 24px;
                    height: 24px;
                }
                .map-choice-content button:hover {
                    background: #316dca;
                    border-color: #316dca;
                    color: #ffffff;
                }
                .map-choice-content button:hover svg path {
                    fill: #ffffff;
                }
                .map-choice-content .cancel-btn {
                    background: #2d333b;
                    border-color: #444c56;
                    margin-top: 16px;
                    color: #FFFAFA;
                }
                .map-choice-content .cancel-btn:hover {
                    background: #444c56;
                    border-color: #444c56;
                    color: #ffffff;
                }
				.map-choice-content button:active {
                    transform: scale(0.98);
                }
            `;
            document.head.appendChild(style);
        }

        // Ta bort eventuell existerande dialog först
        const existingDialog = document.querySelector('.map-choice-dialog');
        if (existingDialog) {
            existingDialog.remove();
        }

        // Lägg till dialog och lås scroll
        document.body.appendChild(mapChoice);
        toggleBodyScroll(true);

        // Stäng dialog när man klickar utanför
        mapChoice.addEventListener('click', (e) => {
            if (e.target === mapChoice) {
                mapChoice.remove();
                toggleBodyScroll(false);
            }
        });

        // Städa upp vid eventuell programmatisk borttagning
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        for (const node of mutation.removedNodes) {
            if (node === mapChoice) {
                toggleBodyScroll(false);
                observer.disconnect();
                break;
            }
        }
    });
});
        observer.observe(document.body, {
            childList: true
        });
    }
	map.on('error', (e) => {
    if (e.error && e.error.status === 'ErrorEvent') {
        console.warn('Mapbox event logging failed - continuing without logging');
        return; // Ignorera felet och fortsätt
    }
    console.error('Mapbox error:', e.error);
});

    // Window resize handler
    window.addEventListener('resize', () => {
        const sidebar = document.getElementById('sidebar');
        const mapElement = document.getElementById('map');

        if (sidebar.classList.contains('open')) {
            mapElement.style.width = window.innerWidth <= 768 ? '50%' : '80%';
        } else {
            mapElement.style.width = '100%';
            mapElement.style.height = '100%';
        }

        map.resize();
    });
</script>
</body>
</html>