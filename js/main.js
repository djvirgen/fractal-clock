var processingInstance,
    canvas,
    isFullScreen = false,
    holdingShift = false,
    captureId = 0,
    prevScrollPosition = null;

var handleKeys = function(event)
{
    switch(event.keyCode) {
        // ESC
        case 27:
            if (isFullScreen) toggleFullScreen();
            break;
            
        // A
        case 65:
            userSaturation = (userSaturation >= 255) ? 0 : userSaturation + 1;
            document.getElementById('saturation').value = userSaturation;
            break;
            
        // C
        case 67:
            captureCanvas();
            break;
            
        // F
        case 70:
            toggleFullScreen();
            break;
            
        // H
        case 72:
            userHue = (userHue >= 255) ? 0 : userHue + 1;
            document.getElementById('hue').value = userHue;
            break;
            
        // I
        case 73:
            userLightness = (userLightness >= 255) ? 0 : userLightness + 1;
            document.getElementById('lightness').value = userLightness;
            break;
            
        // L
        case 76:
            userLength = (userLength >= 100) ? 6 : userLength + 1;
            document.getElementById('length').value = userLength;
            break;
            
        // M
        case 77:
            userTimeShift = (userTimeShift >= 12) ? 0 : userTimeShift + 0.01;
            document.getElementById('timeshift').value = userTimeShift;
            break;
            
        // O
        case 79:
            userOpacity = (userOpacity >= 255) ? 0 : userOpacity + 1;
            document.getElementById('opacity').value = userOpacity;
            break;
            
        // P
        case 80:
            userPhase = (userPhase >= (Math.PI * 2)) ? 0 : userPhase + 0.01;
            document.getElementById('phase').value = userPhase;
            break;
            
        // R
        case 82:
            showFps = !showFps;
            break;
            
        // S
        case 83:
            userSpeed = (userSpeed >= 50) ? -50 : userSpeed + 1;
            document.getElementById('speed').value = userSpeed;
            break;
            
        // T
        case 84:
            userTrails = (userTrails == 100) ? 6 : userTrails + 1;
            document.getElementById('trails').value = userTrails;
            break;
            
        // U
        case 85:
            userHueShifting = (userHueShifting >= 255) ? 0 : userHueShifting + 1;
            document.getElementById('hueshifting').value = userHueShifting;
            break;
        
        // Z
        case 90:
            userZoom = (userZoom >= 250) ? 3 : userZoom + 1;
            document.getElementById('zoom').value = userZoom;
            break;
            
        // +
        case 187:
            if (userZoom < 250) userZoom++;
            document.getElementById('zoom').value = userZoom;
            break;
            
        // -
        case 189:
            if (userZoom > 3) userZoom--;
            document.getElementById('zoom').value = userZoom;
            break;
            
        // ?
        case 191:
            toggleHelp();
            return false;
            break;
    }
    return true;
};

window.onload = function() {
    document.addEventListener('keydown', handleKeys, false);
};

var captureCanvas = function()
{
    captureId++;
    var canvas = getCanvas(),
        context = canvas.getContext('2d'),
        img = canvas.toDataURL('image/png');

    window.open(img, 'fractal-clock-' + captureId);
};

var toggleFullScreen = function()
{
    var p = getProcessingInstance(),
        canvas = getCanvas();
    if (isFullScreen) {
        p.size(400, 400);
        canvas.style.position = 'inherit';
        nx = nx / window.innerWidth * 400;
        x = nx;
        ny = ny / window.innerHeight * 400;
        y = ny;
        userZoom /= 2;
        
        // Re-enable scrolling
        document.body.style.overflow = 'auto';
        
        // Scroll to previous position
        if (null !== prevScrollPosition) window.scrollTo(prevScrollPosition.x, prevScrollPosition.y);
        
        // Hide help if it's shown
        if (document.getElementById('help').style.display == 'block') toggleHelp();
    } else {
        p.size(window.innerWidth, window.innerHeight);
        canvas.style.position = 'fixed';
        canvas.style.top = 0;
        canvas.style.left = 0;
        canvas.style.zIndex = 5000;
        nx = nx / 400 * window.innerWidth;
        x = nx;
        ny = ny / 400 * window.innerHeight;
        y = ny;
        userZoom *= 2;
        
        // Prevent scrolling
        document.body.style.overflow = 'hidden';
        
        // Keep track of current scrolling position
        prevScrollPosition = {
            x: window.pageXOffset,
            y: window.pageYOffset
        }
        
        // Scroll to top to prevent Processing glitch
        window.scrollTo(0, 0);
        
        // Show help if it's not already shown
        if (document.getElementById('help').style.display != 'block') toggleHelp();
    }
    isFullScreen = !isFullScreen;
};

window.onscroll = function() {
    // When full screen prevent scrolling
    if (isFullScreen) {
        window.scrollTo(0,0);
    }
}

var toggleHelp = function()
{
    var help = document.getElementById('help');
    help.style.display = (help.style.display == 'block') ? 'none' : 'block';
};

var getProcessingInstance = function()
{
    if (!processingInstance) {
        processingInstance = Processing.getInstanceById('fractal-clock');
    }
    return processingInstance;
};

var getCanvas = function()
{
    if (!canvas) {
        canvas = document.getElementById('fractal-clock');
    }
    return canvas;
};