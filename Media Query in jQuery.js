if(window.matchMedia("(max-width: 767px)").matches){
    // The viewport is less than 768 pixels wide
    alert("This is a mobile device.");
} else{
    // The viewport is at least 768 pixels wide
    alert("This is a tablet or desktop.");
}