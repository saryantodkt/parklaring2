<!-- Function to create the watermark -->
<script>
const text = "CONFIDENTIAL";
const svgString = `
<svg xmlns='http://www.w3.org/2000/svg' width='150' height='150'>
  <text x='50%' y='50%' 
        fill='rgba(253, 233, 233, 0.52)' 
        font-size='16' 
        font-family='Arial' 
        text-anchor='middle' 
        dominant-baseline='middle' 
        transform='rotate(-45, 75, 75)'>
    ${text}
  </text>
</svg>`;

const encodedData = window.btoa(svgString);
document.getElementById("content").style.backgroundImage = `url("data:image/svg+xml;base64,${encodedData}")`;

</script>
