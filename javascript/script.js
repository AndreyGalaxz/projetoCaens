
document.addEventListener("keypress", (event) =>  {
    if(event.key === "Enter") {
        console.log("enter pressionado")
        document.getElementById("formAcao").submit();
        }
})


