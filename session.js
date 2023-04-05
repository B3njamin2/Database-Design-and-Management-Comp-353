document.addEventListener("DOMContentLoaded", function () {
  // Get the textarea elements
  var textarea1 = document.getElementById("query");
  var textarea2 = document.getElementById("query_input");

  // Load the saved values from local storage, if any
  if (localStorage.getItem("savedText1")) {
    textarea1.value = localStorage.getItem("savedText1");
  }
  if (localStorage.getItem("savedText2")) {
    textarea2.value = localStorage.getItem("savedText2");
  }

  var clearButton1 = document.getElementById("clearButton1");
  var clearButton2 = document.getElementById("clearButton2");

  var toggleButton = document.getElementById("toggleButton");
});

var clearEnabled = false;

// Add click event listener to the toggle button
toggleButton.addEventListener("click", function() {
    clearEnabled = !clearEnabled; // Toggle the flag
    if (clearEnabled) {
      toggleButton.textContent = "On"; // Change the text content of the button
      clearButton.disabled = false; // Enable the clear button
    } else {
      toggleButton.textContent = "Off"; // Change the text content of the button
      clearButton.disabled = true; // Disable the clear button
    }
  });

// Save the values to local storage whenever they change
textarea1.addEventListener("input", function () {
  localStorage.setItem("savedText1", textarea1.value);
});
textarea2.addEventListener("input", function () {
  localStorage.setItem("savedText2", textarea2.value);
});

clearButton1.addEventListener("click", function () {
    if (clearEnabled1) {
        textarea1.value = "";
        localStorage.removeItem("savedText1");
    }
});

clearButton2.addEventListener("click", function () {
    if (clearEnabled1) {
        textarea2.value = "";
        localStorage.removeItem("savedText2");
    }
});

