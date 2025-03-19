const selectId = document.getElementById("id-child");
const formChild = document.getElementById("child");

selectId.addEventListener("change", (e) => {
    formChild.submit();
});

