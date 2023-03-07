/* 
<script>
const togglePopup = (id) => {
    let target = document.getElementById(id);

    let popups = document.getElementsByClassName("service-popup show");
    for(popup of popups) {
        popup.classList.remove("show");
    }
    target.classList.add("show");
    console.log("toggle");
}

const closePopups = () => {
    let popups = document.getElementsByClassName("service-popup show");
    for(popup of popups) {
        popup.classList.remove("show");
    }
    console.log("close");
}
</script>
 */
