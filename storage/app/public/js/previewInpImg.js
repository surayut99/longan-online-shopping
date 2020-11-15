$("#inpImg").change(function() {
    const file = document.getElementById('inpImg').files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener('load', function() {
            console.log(this);
            $("#preImg").attr("src", this.result);
        });

        reader.readAsDataURL(file);
    }
})