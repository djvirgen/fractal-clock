<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Fractal Clock</title>
<link href="css/main.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://www.virgentech.com/library/syntaxhighlighter/styles/shCore.css" media="screen" rel="stylesheet" type="text/css"> 
<link href="css/shFractalClock.css" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/processing.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="http://www.virgentech.com/library/syntaxhighlighter/scripts/shCore.js"></script> 
<script type="text/javascript" src="http://www.virgentech.com/library/syntaxhighlighter/scripts/shBrushJava.js"></script> 
</head>
<body>
    <h1>Fractal Clock</h1>
    <p>Eye Candy by <a href="http://www.virgentech.com">Hector Virgen</a> <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.virgentech.com%2Fdemos%2Ffractal-clock%2F&amp;layout=button_count&amp;show_faces=false&amp;width=300&amp;action=like&amp;colorscheme=dark&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></p>
    
    <div id="canvas-container">
        <canvas id="fractal-clock" data-processing-sources="js/clock.pjs" width="400" height="400">
            <span class="error">Sorry, your browser does not support canvas! Try Chrome, Safari or FireFox instead!</span>
        </canvas>
        <div id="canvas-controls">
            <a href="#" id="capture" onclick="captureCanvas(); return false;"><img src="http://www.virgentech.com/images/icons/fatcow/small/camera.png" alt="" class="icon">Capture Screenshot</a>
            <a href="#" id="full-screen" onclick="toggleFullScreen(); return false;"><img src="http://www.virgentech.com/images/icons/fatcow/small/monitor.png" alt="" class="icon">Full Screen</a>
        </div>
    </div>
    
    <dl id="fractal-controls">
        <dt>Mode</dt>
        <dd>
            <ul>
                <li><label><input type="radio" id="mode-normal" name="mode" value="normal" checked onclick="userMode = this.value; speedFactor = 1;">Normal</label></li>
                <li><label><input type="radio" id="mode-blackhole" name="mode" value="blackhole" onclick="userMode = this.value; speedFactor = 1;">Black Hole</label></li>
                <li><label><input type="radio" id="mode-spirograph-clockwise" name="mode" value="spirograph-clockwise" onclick="userMode = this.value; speedFactor = 1/6;">Spirograph Clockwise</label></li>
                <li><label><input type="radio" id="mode-spirograph-counterclockwise" name="mode" value="spirograph-counterclockwise" onclick="userMode = this.value; speedFactor = 1/6;">Spirograph Counter-Clockwise</label></li>
                <li><label><input type="radio" id="mode-spirograph-twist" name="mode" value="spirograph-twist" onclick="userMode = this.value; speedFactor = 1/6;">Spirograph Twist</label></li>
            </ul>
        </dd>
        
        <dt><label><input type="checkbox" id="types-lines" checked onclick="types.lines = this.checked; document.getElementById('linesize').disabled = !this.checked;">Lines:</label></dt>
        <dd><input type="range" id="linesize" min="1" max="100" value="2" step="0.01" onchange="userLineSize = parseFloat(this.value);"></dd>
        
        <dt><label><input type="checkbox" id="types-dots" onclick="types.dots = this.checked; document.getElementById('dotsize').disabled = !this.checked;">Dots:</label></dt>
        <dd><input type="range" id="dotsize" min="1" max="100" value="15" step="0.01" disabled onchange="userDotSize = parseFloat(this.value);"></dd>
        
        <dt>Length:</dt>
        <dd><input type="range" id="length" min="1" max="100" value="6" onchange="userLength = parseInt(this.value);"></dd>
        
        <dt>Trails:</dt>
        <dd><input type="range" id="trails" min="1" max="100" value="30" onchange="userTrails = parseInt(this.value);"></dd>
        
        <dt>Zoom:</dt>
        <dd><input type="range" id="zoom" min="3" max="250" value="50" onchange="userZoom = parseInt(this.value);"></dd>
        
        <dt>Phase:</dt>
        <dd><input type="range" id="phase" min="0" max="6.283185307179586" value="0" step="0.01" onchange="userPhase = parseFloat(this.value);"></dd>
        
        <dt>Speed:</dt>
        <dd><input type="range" id="speed" min="-50" max="50" value="1" step="0.01" onchange="userSpeed = parseFloat(this.value);"></dd>
        
        <dt>Hue:</dt>
        <dd><input type="range" id="hue" min="0" max="255" value="180" onchange="userHue = parseInt(this.value);"></dd>
        
        <dt>Saturation:</dt>
        <dd><input type="range" id="saturation" min="0" max="255" value="255" onchange="userSaturation = parseInt(this.value);"></dd>
        
        <dt>Lightness:</dt>
        <dd><input type="range" id="lightness" min="0" max="255" value="255" onchange="userLightness = parseInt(this.value);"></dd>
        
        <dt>Hue Shifting:</dt>
        <dd><input type="range" id="hueshifting" min="-500" max="500" value="255" onchange="userHueShifting = parseInt(this.value);"></dd>

        <dt>Opacity:</dt>
        <dd><input type="range" id="opacity" min="0" max="255" value="200" onchange="userOpacity = parseInt(this.value);"></dd>
        
        <dt>Time Shift:</dt>
        <dd><input type="range" id="timeshift" min="0" max="12" value="0" step="0.01" onchange="userTimeShift = parseFloat(this.value);"></dd>
    </dl>
    
    <div id="help">
        <h3>Keyboard Shortcuts</h3>
        <dl>
            <dt>ESC</dt>
            <dd>Quit Full Screen</dd>
            
            <dt>+, -, Z</dt>
            <dd>Zoom</dd>
            
            <dt>L</dt>
            <dd>Length</dd>
            
            <dt>T</dt>
            <dd>Trails</dd>
            
            <dt>P</dt>
            <dd>Phase</dd>
            
            <dt>S</dt>
            <dd>Speed</dd>
            
            <dt>H</dt>
            <dd>Hue</dd>
            
            <dt>A</dt>
            <dd>Saturation</dd>
            
            <dt>I</dt>
            <dd>Lightness</dd>
            
            <dt>U</dt>
            <dd>Hue Shifting</dd>
            
            <dt>O</dt>
            <dd>Opacity</dd>
            
            <dt>M</dt>
            <dd>Time Shift</dd>
            
            <dt>C</dt>
            <dd>Capture ScreenShot</dd>
            
            <dt>?</dt>
            <dd>Toggle Help</dt>
        </dl>
    </div>
    
    <br style="clear:both;">
    
    <h3>Source</h3>
    <pre class="brush:java"><?php echo htmlentities(file_get_contents('js/clock.pjs')); ?></pre>
    
    <div class="footer">Copyright &copy; 2011 <a href="http://www.virgentech.com">Hector Virgen</a></div>
    
    <script type="text/javascript">
    SyntaxHighlighter.config.clipboardSwf = 'http://www.virgentech.com/library/syntaxhighlighter/scripts/clipboard.swf';
    SyntaxHighlighter.all();
    </script>
</body>
</html>