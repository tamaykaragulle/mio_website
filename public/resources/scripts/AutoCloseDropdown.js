/*
<script>
document.body.addEventListener('click', (e) => {
    
    let dropdown = document.getElementById('dropdown');
    let rect = dropdown.getBoundingClientRect();
    let mouseX = e.clientX;
    let mouseY = e.clientY;

    // if mouse coordinates are outside the dropdown's bounding rectangle,
    // then set dropdown.display = none;
    if(mouseX < rect.left || mouseX > rect.right ||
       mouseY < rect.top || mouseY > rect.bottom){
            dropdown.classList.remove("show");
    }
})
</script>
*/