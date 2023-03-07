/*<script>
    let toggleMap = () => {
        let map = document.getElementById("map");
        let footer = document.getElementById("footer");
        let smallWindow  = window.matchMedia('(max-width: 720px)' )["matches"];
        console.log(smallWindow);
        if(map.style.visibility == "hidden"){
            map.style.visibility = "visible";
            footer.style.height = "70vh";
        }
        else{
            map.style.visibility = "hidden";
            if(smallWindow) footer.style.height = "40vh";
            else footer.style.height = "70vh";
        }
    };
</script>*/