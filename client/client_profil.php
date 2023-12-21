
<h2 style="display: flex; justify-content: center;">Zone de dessin</h2>
<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <style>
        #canvas {
            border: 1px solid black;
        }
    </style>
    <canvas id="canvas" width="600" height="400"></canvas>
    <button id="clearButton">Clear</button>
</div>

<script>
    
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
let painting = false;

canvas.addEventListener("mousedown", startPainting);
canvas.addEventListener("mouseup", stopPainting);
canvas.addEventListener("mousemove", draw);

canvas.addEventListener("touchstart", startPainting);
canvas.addEventListener("touchend", stopPainting);
canvas.addEventListener("touchmove", draw);

document.getElementById("clearButton").addEventListener("click", clearCanvas);

function startPainting(event) {
    painting = true;
    draw(event);
}

function stopPainting() {
    painting = false;
    ctx.beginPath();
}

function draw(event) {
    if (!painting) return;
    
    const x = event.clientX || event.touches[0].clientX;
    const y = event.clientY || event.touches[0].clientY;
    
    ctx.lineWidth = 2;
    ctx.lineCap = "round";
    ctx.strokeStyle = "black";
    
    ctx.lineTo(x, y);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(x, y);
}

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}
</script>

