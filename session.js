document.addEventListener("DOMContentLoaded", function () {
  // Get the textarea elements
  var textarea1 = document.getElementById("query");
  var textarea2 = document.getElementById("query_input");

  // Load the saved values from local storage
  if (localStorage.getItem("savedText1")) {
    textarea1.value = localStorage.getItem("savedText1");
  }
  if (localStorage.getItem("savedText2")) {
    textarea2.value = localStorage.getItem("savedText2");
  }

  // Save the values to local storage 
  textarea1.addEventListener("input", function () {
    localStorage.setItem("savedText1", textarea1.value);
  });
  textarea2.addEventListener("input", function () {
    localStorage.setItem("savedText2", textarea2.value);
  });

});
