document.addEventListener("DOMContentLoaded", function() {

    const urlParams = new URLSearchParams(window.location.search);
    const errorsParam = urlParams.get('errors');
    
    if (errorsParam) {
        const errors = JSON.parse(decodeURIComponent(errorsParam));
        

        const errorList = document.querySelector(".error-list");
        errorList.innerHTML = errors.map(error => `<li>${error}</li>`).join('');
        
    
        document.getElementById("error-popup").classList.add("show");
        

        history.replaceState({}, document.title, window.location.pathname);
    }
    else{
        document.getElementById("error-popup").classList.remove("show");
    }
});